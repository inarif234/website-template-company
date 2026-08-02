<?php

// Database Connection
require_once __DIR__ . '/config/config.php';

// Pagination
$limit = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$category = isset($_GET['category']) ? $_GET['category'] : 'all';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Build Query
$sql_count = "SELECT COUNT(*) FROM posts WHERE 1=1";
$sql_data = "SELECT * FROM posts WHERE 1=1";
$params = [];

// Category Filter
if ($category !== 'all') {
    $sql_count .= " AND type = :category";
    $sql_data .= " AND type = :category";
    $params[':category'] = $category;
}

// Search Filter
if (!empty($search)) {
    $sql_count .= " AND title LIKE :search";
    $sql_data .= " AND title LIKE :search";
    $params[':search'] = '%' . $search . '%';
}

// Count Pagenation
$stmt_count = $pdo->prepare($sql_count);
$stmt_count->execute($params);
$total_posts = $stmt_count->fetchColumn();
$total_pages = ceil($total_posts / $limit);

// Fetch Data
$sql_data .= " ORDER BY id DESC LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
$stmt = $pdo->prepare($sql_data);
$stmt->execute($params);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Render Blog
if ($posts) {
    foreach ($posts as $post) {
        $image_src = $post['image'];
        echo '
        <div class="blog-card flex flex-col rounded-2xl overflow-hidden border border-gray-200 hover:border-orange-500 transition duration-300 h-full">
            <img src="'.$image_src.'" alt="'.htmlspecialchars($post['title']).'" class="w-full h-32 md:h-56 object-cover">
            <div class="p-3 md:p-6 flex flex-col flex-grow">
                <span class="text-orange-600 font-semibold text-xs md:text-base">'.htmlspecialchars($post['type']).'</span>
                <h3 class="text-sm md:text-lg font-bold text-gray-900 mt-1 mb-2 md:mt-2 md:mb-4 line-clamp-2">'.htmlspecialchars($post['title']).'</h3>    
                <p class="text-gray-600 text-xs mb-3 md:mb-6 md:text-sm line-clamp-1 md:line-clamp-2">'.htmlspecialchars($post['description']).'</p>
                <div class="mt-auto">
                    <a href="blog/'.$post['slug'].'" class="w-full py-2 md:py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl transition duration-300 flex items-center justify-center gap-2 text-xs md:text-sm shadow-sm">
                        Read More <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>';
    }
} else {
    echo '<p class="col-span-full text-center py-10">No results found!</p>';
}

// Render Pagenation
if ($total_pages > 1) {
    echo '<div class="flex justify-center py-10 w-full col-span-full gap-2">';
    for ($i = 1; $i <= $total_pages; $i++) {
        $activeClass = ($page == $i) ? 'bg-orange-600 text-white' : 'bg-white border text-gray-700';
        echo '<button onclick="loadBlog('.$i.')" class="px-4 py-2 rounded-lg font-bold transition-all '.$activeClass.'">'.$i.'</button>';
    }
    echo '</div>';
}

// usleep(500000); // Uncomment to loading delay (usleep(500000))
?>