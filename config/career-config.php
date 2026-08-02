<?php 
// Use Email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// library PHPMailer
require __DIR__ . '/../libraries/PHPMailer/src/Exception.php';
require __DIR__ . '/../libraries/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../libraries/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);
    $uploadDir = __DIR__ . "/../public/uploads/career/";

    try {
        // Backup Files
        if (!file_exists($uploadDir)) mkdir($uploadDir, 0755, true);

        // MIME Types (PDF, DOC, dan DOCX)
        $allowedMimeTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];
        
        // Open Finfo
        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        // CV Validation
        if ($_FILES['cv']['size'] > 2 * 1024 * 1024) throw new Exception("Maximum CV size is 2MB.");
        
        $cvMimeType = finfo_file($finfo, $_FILES['cv']['tmp_name']);
        if (!in_array($cvMimeType, $allowedMimeTypes)) throw new Exception("CV format must be valid PDF, DOC, or DOCX.");
        
        $cvExt = strtolower(pathinfo($_FILES['cv']['name'], PATHINFO_EXTENSION));
        $cvNewName = "CV_" . uniqid() . "_" . time() . "." . $cvExt;
        $cvPath = $uploadDir . $cvNewName;
        if (!move_uploaded_file($_FILES['cv']['tmp_name'], $cvPath)) throw new Exception("Failed to save CV file.");

        // Portfolio Validation
        if (isset($_FILES['portfolio']) && $_FILES['portfolio']['size'] > 0) {
            if ($_FILES['portfolio']['size'] > 10 * 1024 * 1024) throw new Exception("Maximum Portfolio size is 10MB.");
            
            $portMimeType = finfo_file($finfo, $_FILES['portfolio']['tmp_name']);
            if (!in_array($portMimeType, $allowedMimeTypes)) throw new Exception("Portfolio format must be valid PDF, DOC, or DOCX.");
            
            $portExt = strtolower(pathinfo($_FILES['portfolio']['name'], PATHINFO_EXTENSION));
            $portNewName = "Portfolio_" . uniqid() . "_" . time() . "." . $portExt;
            $portPath = $uploadDir . $portNewName;
            if (!move_uploaded_file($_FILES['portfolio']['tmp_name'], $portPath)) throw new Exception("Failed to save Portfolio file.");
        }
        
        // Close Finfo
        finfo_close($finfo);

        // Set target email
        $jobTitle = $_POST['job_title'] ?? '';
        $targetEmail = 'hrd@yourdomain.com';

        if ($jobTitle == 'Graphic Design') {
            $targetEmail = 'graphic@yourdomain.com';
        } elseif ($jobTitle == 'Sales Marketing') {
            $targetEmail = 'sales@yourdomain.com'; 
        }

        // Configure SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'mail.yourdomain.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hrd@yourdomain.com';
        $mail->Password   = 'your_email_password';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Attach applicant files
        $mail->addAttachment($cvPath);
        if (isset($portPath)) $mail->addAttachment($portPath);

        // Send email notification
        $mail->setFrom('no-reply@yourdomain.com', 'Career - Company Name');
        $mail->addAddress($targetEmail);
        $mail->addReplyTo($_POST['email'], $_POST['name']);
        $mail->isHTML(false);
        $mail->Subject = $_POST['job_title'] . " - " . $_POST['name'];
        $mail->Body    = "Applicant Data:\nName: " . $_POST['name'] . "\nEmail: " . $_POST['email'] . "\nPhone: " . $_POST['phone'] . "\nPosition: " . $_POST['job_title'] . "\n\nMessage:\n" . $_POST['message'];

        $mail->send();
        
        // Cleanup folder
        if (file_exists($cvPath)) unlink($cvPath); 
        if (isset($portPath) && file_exists($portPath)) unlink($portPath);
        
        echo "<script>alert('Application sent successfully!'); window.location.href='career.php';</script>";
    
    } catch (Exception $e) {
        // Handle sending errors
        error_log("Failed to send email in career.php: " . $e->getMessage());
        echo "<script>alert('Sorry, sending failed! " . $e->getMessage() . "'); window.location.href='career.php';</script>";
    }
}
?>