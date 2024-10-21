<?php
session_start();

$admin_username = 'admin'; // Ganti dengan username admin Anda
$admin_password = 'password'; // Ganti dengan password admin Anda

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === $admin_username && $password === $admin_password) {
    $_SESSION['loggedin'] = true;
    header('Location: admin.php');
} else {
    echo "Login gagal. <a href='login.php'>Coba lagi</a>";
}
?>
