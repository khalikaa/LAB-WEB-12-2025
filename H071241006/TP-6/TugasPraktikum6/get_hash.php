<?php
// get_hash.php: Skrip ini menghasilkan hash password untuk 'password123'
$password_asli = 'tmandi123';
$hashed_password = password_hash($password_asli, PASSWORD_DEFAULT);

echo "Password Asli: " . $password_asli . "<br>";
echo "Hash yang benar: <strong>" . $hashed_password . "</strong>";
?>