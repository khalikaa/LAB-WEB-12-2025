<?php
include 'config.php'; 
include 'includes/header.php'; // Muat tampilan header
$role = $_SESSION['role'];

// Tampilkan halaman partials berdasarkan role
switch ($role) {
    case 'Super Admin':
        include 'partials/superadmin_dashboard.php';
        break;
    case 'Project Manager':
        include 'partials/pm_dashboard.php';
        break;
    case 'Team Member':
        include 'partials/member_dashboard.php';
        break;
    default:
        // Jika role tidak dikenal
        echo '<div class="alert alert-danger">Error: Role pengguna tidak dikenali.</div>';
        break;
}

include 'includes/footer.php';
?>