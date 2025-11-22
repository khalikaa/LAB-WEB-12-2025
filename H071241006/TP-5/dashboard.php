<?php
session_start();
require 'data.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial; background: #eef2f3; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #007bff; color: white; }
        .logout { float: right; background: #dc3545; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <a href="logout.php" class="logout">Logout</a>
    <?php if ($user['username'] === 'adminxxx'): ?>
        <h2>Selamat Datang, Admin!</h2>
        <h3>Data Seluruh Pengguna:</h3>
        <table>
            <tr>
                <th>Email</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Gender</th>
                <th>Fakultas</th>
                <th>Angkatan</th>
            </tr>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['username']) ?></td>
                    <td><?= htmlspecialchars($u['name']) ?></td>
                    <td><?= $u['gender'] ?? '-' ?></td>
                    <td><?= $u['faculty'] ?? '-' ?></td>
                    <td><?= $u['batch'] ?? '-' ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <h2>Selamat Datang, <?= htmlspecialchars($user['name']) ?>!</h2>
        <table>
            <tr><th>Field</th><th>Data</th></tr>
            <tr><td>Email</td><td><?= htmlspecialchars($user['email']) ?></td></tr>
            <tr><td>Username</td><td><?= htmlspecialchars($user['username']) ?></td></tr>
            <tr><td>Nama</td><td><?= htmlspecialchars($user['name']) ?></td></tr>
            <tr><td>Gender</td><td><?= $user['gender'] ?? '-' ?></td></tr>
            <tr><td>Fakultas</td><td><?= $user['faculty'] ?? '-' ?></td></tr>
            <tr><td>Angkatan</td><td><?= $user['batch'] ?? '-' ?></td></tr>
        </table>
    <?php endif; ?>
</body>
</html>
