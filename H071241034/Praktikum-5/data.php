<?php
// File: data.php
// Menyimpan data pengguna dalam array
 
$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
    [  
        'email' => 'dewi9@gmail.com',
        'username' => 'iwed_aja',
        'name' => 'Dewi Astuti Muchtar',
        'password' => password_hash('dewi123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'KEDOKTERAN',
        'batch' => '2024',
    ],
    [
        'email' => 'kiya@gmail.com',
        'username' => 'syahrani',
        'name' => 'Syahrani zakiyah nurfaizah',
        'password' => password_hash('kiya123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => "EKONOMI DAN BISNIS",
        'batch' => '2024',
    ],
    [
        'email' => 'Farhan@gmail.com',
        'username' => 'farhan12',
        'name' => 'Muh farhan kardani ',
        'password' => password_hash('oji123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' =>' TEKNIK INFORMATIKA',
        'batch' => '2022',
    ],
    [
        'email' => 'SABILA@gmail.com',
        'username' => 'elsa23',
        'name' => 'salsabila',
        'password' => password_hash('sabila123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'FISIP',
        'batch' => '2024',
    ],
];
?>