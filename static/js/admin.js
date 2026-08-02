// User Login
async function handleLogin() {
    let fd = new FormData();
    fd.append('username', document.getElementById('login-user').value);
    fd.append('password', document.getElementById('login-pass').value);
    fd.append('csrf_token', document.querySelector('meta[name="csrf-token"]').content);

    let res = await fetch('auth/login.php', { method: 'POST', body: fd });
    let result = await res.text();

    if(result.trim() === 'success') {
        location.reload(); 
    } else {
        alert('Login Failed! Incorrect username or password.');
    }
}

// Submit Login (Enter)
function checkEnter(e) { 
    if (e.key === 'Enter') handleLogin(); 
}

// User Logout
async function handleLogout() {
    await fetch('auth/logout.php');
    location.reload();
}