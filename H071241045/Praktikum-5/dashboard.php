<?php
session_start();
require 'data.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Portal Mahasiswa</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ffafbd, #ffc3a0, #fff59d);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 60px auto;
            background: #fffbea;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            position: relative;
        }

        h1, h2 {
            color: #e91e63;
        }

        hr {
            border: 1px solid #ffd54f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            font-size: 15px;
        }

        th, td {
            border: 1px solid #f48fb1;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #f48fb1;
            color: white;
        }

        .bg {
            background-color: #fff3e0;
            font-weight: bold;
        }

        .logout {
            position: absolute;
            top: 20px;
            right: 25px;
            background: linear-gradient(135deg, #ff4081, #fbc02d);
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .logout:hover {
            background: linear-gradient(135deg, #ff80ab, #fff176);
            transform: scale(1.05);
        }

        tr:nth-child(even) td {
            background: #fffde7;
        }
    </style>
</head>
<body>
<div class="container">
    <a class="logout" href="logout.php">Logout</a>
    <?php if ($user['username'] === 'adminxxx'): ?>
        <h2>🌸 Selamat Datang, Admin!</h2>
        <table>
            <tr>
                <th>Email</th>
                <th>Username</th>
                <th>Nama</th>
            </tr>
            <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u['email'] ?></td>
                <td><?= $u['username'] ?></td>
                <td><?= $u['name'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <h1>Hai, <?= htmlspecialchars($user['name']) ?> 🌼</h1>
        <hr>
        <h2>Data Anda</h2>
        <table>
            <tr><td class="bg">Nama</td><td><?= $user['name']?></td></tr>
            <tr><td class="bg">Username</td><td><?= $user['username']?></td></tr>
            <tr><td class="bg">Email</td><td><?= $user['email']?></td></tr>
            <tr><td class="bg">Gender</td><td><?= $user['gender'] ?></td></tr>
            <tr><td class="bg">Fakultas</td><td><?= $user['faculty'] ?></td></tr>
            <tr><td class="bg">Angkatan</td><td><?= $user['batch'] ?></td></tr>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
