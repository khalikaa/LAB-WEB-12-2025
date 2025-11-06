<?php
include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Validasi dasar
if (empty($username) || empty($password)) {
    header("Location: index.php?error=Username dan Password wajib diisi");
    exit();
}

$stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ?");//menyiapkan , plchold, rslt cetk
$stmt->bind_param("s", $username);//ikat
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // User ditemukan
    $user = $result->fetch_assoc(); 

    // Verifikasi password yang di-hash
    if (password_verify($password, $user['password'])) {
        // Password benar! Buat session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Arahkan ke dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Password salah
        header("Location: index.php?error=Password salah");
        exit();
    }
} else {
    // User tidak ditemukan
    header("Location: index.php?error=Username tidak ditemukan");
    exit();
}

$stmt->close();
$koneksi->close();
?>