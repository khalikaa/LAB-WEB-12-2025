<?php
// File: dashboard.php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
$currentUser = $_SESSION['user'];
$isAdmin = ($currentUser['username'] === 'adminxxx');

if ($isAdmin) {
    require_once 'data.php';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Informasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container"> 
    <nav class="navbar">
    <div class="nav-brand">
    <div class="logo-circle-small">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
     <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg> </div>

       <span>Dashboard</span>
            </div>
            <div class="nav-user">
            <span class="user-name"><?php echo htmlspecialchars($currentUser['name']); ?></span>
            <a href="logout.php" class="btn-logout">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </a>
            </div>
        </nav>

        <div class="dashboard-content">
            <div class="welcome-section">
                <h1>
                    <?php if ($isAdmin): ?>
                        Selamat Datang, Admin! 🎉
                    <?php else: ?>
                        Selamat Datang, <?php echo htmlspecialchars($currentUser['name']); ?>! 👋
                    <?php endif; ?>
                </h1>
                <p class="welcome-subtitle">
                    <?php if ($isAdmin): ?>
                        Anda memiliki akses penuh untuk melihat semua data pengguna
                    <?php else: ?>
                        Berikut adalah informasi profil Anda
                    <?php endif; ?>
                </p>
            </div>

<?php if ($isAdmin): ?>
<!-- Tampilan Admin - Tabel Semua User -->
    <div class="card">
         <div class="card-header">
            <h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            Data Semua Pengguna
            </h2>
            <span class="user-count"><?php echo count($users); ?> Users</span> </div>
<div class="table-responsive">
            <table class="data-table">
                <thead>
                <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Fakultas</th>
                <th>Angkatan</th>
                </tr> </thead>
<tbody>
<?php foreach ($users as $index => $user): ?>
    <tr>
    <td><?php echo $index + 1; ?></td>
    <td>
        <span class="username-badge">
        <?php echo htmlspecialchars($user['username']); ?>
        </span>
    </td>
         <td><?php echo htmlspecialchars($user['name']); ?></td>
         <td><?php echo htmlspecialchars($user['email']); ?></td>
         <td>

 <?php if (isset($user['gender'])): ?>
    <span class="gender-badge <?php echo strtolower($user['gender']); ?>">
        <?php echo htmlspecialchars($user['gender']); ?>
         </span>

 <?php else: ?>
     <span class="text-muted">-</span>
      <?php endif; ?>
 </td>
    <td><?php echo isset($user['faculty']) ? htmlspecialchars($user['faculty']) : '-'; ?></td>
    <td><?php echo isset($user['batch']) ? htmlspecialchars($user['batch']) : '-'; ?></td>
 </tr>

<?php endforeach; ?>
     </tbody>
     </table>
  </div>
   </div>

   <?php else: ?>
 <!-- Tampilan User Biasa - Data Pribadi -->
    <div class="card">
        <div class="card-header">
         <h2>
         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
         <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
         <circle cx="12" cy="7" r="4"></circle>
     </svg>
        Informasi Profil
      </h2>
</div>
    <div class="profile-grid">
    <div class="profile-item">
    <div class="profile-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
    <circle cx="12" cy="7" r="4"></circle>
    </svg>
    </div>
    <div class="profile-info">
    <label>Username</label>
    <p><?php echo htmlspecialchars($currentUser['username']); ?></p>
      </div>
  </div>

    <div class="profile-item">
    <div class="profile-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
    <circle cx="12" cy="7" r="4"></circle>
   </svg>
</div>
    <div class="profile-info">
    <label>Nama Lengkap</label>
    <p><?php echo htmlspecialchars($currentUser['name']); ?></p>
    </div>
</div>

 <div class="profile-item">
    <div class="profile-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
    <polyline points="22,6 12,13 2,6"></polyline>
     </svg>
</div>
    <div class="profile-info">
        <label>Email</label>
        <p><?php echo htmlspecialchars($currentUser['email']); ?></p>
        </div>
     </div>
     
    <?php if (isset($currentUser['gender'])): ?>
        <div class="profile-item">
            <div class="profile-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                 </svg>
                </div>
                <div class="profile-info">
                <label>Gender</label>
                <p><?php echo htmlspecialchars($currentUser['gender']); ?></p>
            </div>
        </div>
    <?php endif; ?>


<?php if (isset($currentUser['faculty'])): ?>
    <div class="profile-item">
    <div class="profile-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
        <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
     </svg>
</div>
<div class="profile-info">
 <label>Fakultas</label>
 <p><?php echo htmlspecialchars($currentUser['faculty']); ?></p>
    </div>
    </div>
   <?php endif; ?>
<?php if (isset($currentUser['batch'])): ?>
    <div class="profile-item">
    <div class="profile-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
    <line x1="16" y1="2" x2="16" y2="6"></line>
    <line x1="8" y1="2" x2="8" y2="6"></line>
    <line x1="3" y1="10" x2="21" y2="10"></line>
    </svg>
 </div>
   <div class="profile-info">
    <label>Angkatan</label>
    <p><?php echo htmlspecialchars($currentUser['batch']); ?></p>
    </div>
</div>
  <?php endif; ?>
    </div>
    </div>
    <?php endif; ?>
    </div>
    </div>
</body>
</html>