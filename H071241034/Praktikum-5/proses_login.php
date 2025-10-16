<?php
// File: proses_login.php
session_start();
require_once 'data.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {header('Location: login.php');exit();}
// Ambil data dari form
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// Validasi input tidak boleh kosong
if (empty($username) || empty($password)) {
    $_SESSION['error'] = 'Username dan password harus diisi!';
    header('Location: login.php');  
    exit();}
// Cari user berdasarkan username
$userFound = null;
foreach ($users as $user) {
    if ($user['username'] === $username) {
        $userFound = $user;
        break;}}
// Jika user tidak ditemukan
if ($userFound === null) {
    $_SESSION['error'] = 'Username atau password salah!';
    header('Location: login.php');
    exit();}
// Verifikasi password
if (!password_verify($password, $userFound['password'])) {
    $_SESSION['error'] = 'Username atau password salah!';
    header('Location: login.php');
    exit();}
// Login berhasil - simpan data user ke session
$_SESSION['user'] = ['email' => $userFound['email'],'username' => $userFound['username'],'name' => $userFound['name'],
'gender' => $userFound['gender'] ?? null,'faculty' => $userFound['faculty'] ?? null,'batch' => $userFound['batch'] ?? null,];

// Redirect ke dashboard
header('Location: dashboard.php');exit();?>