<?php
$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
    [
        'email' => 'seonghyeon13@gmail.com',
        'username' => 'panggilsean',
        'name' => 'Eom Seonghyeon',
        'password' => password_hash('sean', PASSWORD_DEFAULT),
        'gender' => 'male',
        'faculty' => 'teknik',
        'batch' => '2025',0
    ],
    [
        'email' => 'keonho14@gmail.com',
        'username' => 'keonhocakep',
        'name' => 'Ahn Geonho',
        'password' => password_hash('keonho', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'manajemen',
        'batch' => '2025',
    ],
    [
        'email' => 'wonie@gmail.com',
        'username' => 'mochi',
        'name' => 'Lee Wonhee',
        'password' => password_hash('sukamochi', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'kesehatan masyarakat',
        'batch' => '2024',
    ],
    [
        'email' => 'minikecil@gmail.com',
        'username' => 'bubble',
        'name' => 'Park Minju',
        'password' => password_hash('minju', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Ekonomi Bangunan',
        'batch' => '2023',
    ],
    
];
?>
