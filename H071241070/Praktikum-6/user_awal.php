<?php
include 'config.php';

echo "<h1>Membuat User Awal...</h1>";
// Data User
$users = [
    [
        'username' => 'superadmin',
        'password' => '123',
        'role' => 'Super Admin',
        'manager_id' => null
    ],
    [
        'username' => 'manajer1',
        'password' => '123',
        'role' => 'Project Manager',
        'manager_id' => null
    ],
    [
        'username' => 'tim1',
        'password' => '123',
        'role' => 'Team Member',
        'manager_id' => 2 // ID dari manajer1
    ]
];

// Loop dan masukkan data
foreach ($users as $user) {
    // HASH PASSWORD! Ini wajib untuk keamanan
    $hashed_password = password_hash($user['password'], PASSWORD_DEFAULT);
    
    $username = $user['username'];
    $role = $user['role'];
    $manager_id = $user['manager_id'];

    // Gunakan prepared statement
    if ($manager_id === null) {
        $stmt = $koneksi->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $role);
    } else {
        $stmt = $koneksi->prepare("INSERT INTO users (username, password, role, project_manager_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $username, $hashed_password, $role, $manager_id);
    }

    if ($stmt->execute()) {
        echo "User '{$username}' berhasil dibuat.<br>";
    } else {
        echo "Error membuat user '{$username}': " . $stmt->error . "<br>";
    }
    $stmt->close();
}

echo "<h3>Selesai! Hapus file ini dari server Anda.</h3>";
$koneksi->close();
?>