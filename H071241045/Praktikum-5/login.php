<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Portal Mahasiswa</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ffc3a0, #ffafbd, #fff176);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container {
            width: 360px;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            color: #ff69b4;
            margin-bottom: 20px;
        }

        input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #ffd54f;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #ff80ab;
            box-shadow: 0 0 5px #ffb6c1;
        }

        button {
            width: 100%;
            background: linear-gradient(135deg, #ff80ab, #ffd54f);
            border: none;
            padding: 12px;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s;
        }

        button:hover {
            background: linear-gradient(135deg, #ffb6c1, #fff176);
            transform: scale(1.03);
        }

        .error {
            color: #e91e63;
            background: #ffe6eb;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Login Portal</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <p class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
    <form action="proses_login.php" method="POST">
        <input type="text" name="username" placeholder="Masukkan Username" required>
        <input type="password" name="password" placeholder="Masukkan Password" required>
        <button type="submit">Masuk</button>
    </form>
</div>
</body>
</html>
