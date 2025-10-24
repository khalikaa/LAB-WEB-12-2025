<?php
// File ini dipanggil oleh dashboard.php, jadi $koneksi sudah ada.

// Logika untuk Tambah User
if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $project_manager_id = ($_POST['role'] == 'Team Member') ? $_POST['project_manager_id'] : NULL;

    if ($project_manager_id === NULL && $role == 'Team Member') {
        echo '<div class="alert alert-danger">Error: Team Member harus memiliki Project Manager.</div>';
    } else {
        if ($project_manager_id === NULL) {
            $stmt = $koneksi->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $password, $role);
        } else {
            $stmt = $koneksi->prepare("INSERT INTO users (username, password, role, project_manager_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $username, $password, $role, $project_manager_id);
        }

        if ($stmt->execute()) {
            echo '<div class="alert alert-success">User baru berhasil ditambahkan.</div>';
        } else {
            echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    }
}
if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];
    
    // 1. Cek agar tidak hapus diri sendiri
    if ($user_id == $_SESSION['user_id']) {
        echo '<div class="alert alert-danger">Error: Anda tidak bisa menghapus diri sendiri.</div>';
    } else {
        
        // 2. Ambil role user yg mau dihapus
        $role_stmt = $koneksi->prepare("SELECT role FROM users WHERE id = ?");
        $role_stmt->bind_param("i", $user_id);
        $role_stmt->execute();
        $user_to_delete = $role_stmt->get_result()->fetch_assoc();
        $role_stmt->close();

        if ($user_to_delete) {
            $role = $user_to_delete['role'];

            // 3. JIKA DIA PROJECT MANAGER: Hapus proyek & tugasnya dulu
            if ($role == 'Project Manager') {
                // Ambil dulu ID semua proyeknya
                $proj_stmt = $koneksi->prepare("SELECT id FROM projects WHERE manager_id = ?");
                $proj_stmt->bind_param("i", $user_id);
                $proj_stmt->execute();
                $projects = $proj_stmt->get_result();
                
                $project_ids = [];
                while ($p = $projects->fetch_assoc()) {
                    $project_ids[] = $p['id'];
                }
                $proj_stmt->close();

                if (!empty($project_ids)) {
                    // Buat jadi string '1,2,3' untuk query IN
                    $id_list = implode(',', $project_ids);
                    
                    // Hapus semua tasks dari semua proyeknya (CONSTRAINT ke projects)
                    $koneksi->query("DELETE FROM tasks WHERE project_id IN ($id_list)");
                    
                    // Hapus semua proyeknya (CONSTRAINT ke users)
                    $del_proj_stmt = $koneksi->prepare("DELETE FROM projects WHERE manager_id = ?");
                    $del_proj_stmt->bind_param("i", $user_id);
                    $del_proj_stmt->execute();
                    $del_proj_stmt->close();
                }
            }

            // 4. JIKA DIA TEAM MEMBER: Hapus tugas yg di-assign ke dia
            if ($role == 'Team Member') {
                // Hapus semua tugas yang di-assign ke dia (CONSTRAINT ke users)
                $task_del_stmt = $koneksi->prepare("DELETE FROM tasks WHERE assigned_to = ?");
                $task_del_stmt->bind_param("i", $user_id);
                $task_del_stmt->execute();
                $task_del_stmt->close();
            }

            // 5. JIKA DIA PROJECT MANAGER: Update Team Member di bawahnya
            // Kolom project_manager_id MENGIZINKAN NULL
            if ($role == 'Project Manager') {
                $update_members_stmt = $koneksi->prepare("UPDATE users SET project_manager_id = NULL WHERE project_manager_id = ?");
                $update_members_stmt->bind_param("i", $user_id);
                $update_members_stmt->execute();
                $update_members_stmt->close();
            }


            // 6. AKHIRNYA: Hapus user-nya
            $stmt = $koneksi->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            if ($stmt->execute()) {
                echo '<div class="alert alert-success">User dan semua data terkait berhasil dihapus/dilepaskan.</div>';
            } else {
                echo '<div class="alert alert-danger">Error menghapus user: ' . $stmt->error . '</div>';
            }
            $stmt->close();

        } else {
            echo '<div class="alert alert-danger">Error: User tidak ditemukan.</div>';
        }
    }
}


// Logika untuk Hapus Proyek
if (isset($_GET['delete_project'])) {
    $project_id = $_GET['delete_project'];
    // Hapus dulu tugas-tugas terkait (karena ada FOREIGN KEY)
    $stmt_tasks = $koneksi->prepare("DELETE FROM tasks WHERE project_id = ?");
    $stmt_tasks->bind_param("i", $project_id);
    $stmt_tasks->execute();
    $stmt_tasks->close();

    // Hapus proyeknya
    $stmt = $koneksi->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $project_id);
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Proyek berhasil dihapus.</div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }
    $stmt->close();
}

// Ambil data Manajer Proyek untuk dropdown
$managers_result = $koneksi->query("SELECT id, username FROM users WHERE role = 'Project Manager'");

?>

<h2>Dashboard Super Admin</h2>
<hr>

<div class="card mb-4">
    <div class="card-header">
        <h4>Tambah Pengguna Baru</h4>
    </div>
    <div class="card-body">
        <form action="dashboard.php" method="POST">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" id="roleSelect" required>
                        <option value="Project Manager">Project Manager</option>
                        <option value="Team Member">Team Member</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3" id="managerSelect" style="display:none;">
                    <label class="form-label">Pilih Manajer Proyek</label>
                    <select name="project_manager_id" class="form-select">
                        <option value="">-- Pilih Manajer --</option>
                        <?php while ($manager = $managers_result->fetch_assoc()): ?>
                            <option value="<?php echo $manager['id']; ?>"><?php echo htmlspecialchars($manager['username']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-12">
                    <button type="submit" name="add_user" class="btn btn-primary">Tambah User</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h4>Daftar Semua Pengguna</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Manajer (jika member)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users_result = $koneksi->query("
                    SELECT u.id, u.username, u.role, m.username AS manager_name 
                    FROM users u 
                    LEFT JOIN users m ON u.project_manager_id = m.id
                    ORDER BY u.role, u.username
                ");
                while ($user = $users_result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td><?php echo htmlspecialchars($user['manager_name'] ?? 'N/A'); ?></td>
                    <td>
                        <?php if ($user['id'] != $_SESSION['user_id']): // Super admin tidak bisa hapus diri sendiri ?>
                        <a href="dashboard.php?delete_user=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini? Semua proyek/tugas terkait akan ikut terhapus.')">Hapus</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h4>Daftar Semua Proyek</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Proyek</th>
                    <th>Manajer Proyek</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $projects_result = $koneksi->query("
                    SELECT p.*, u.username AS manager_name 
                    FROM projects p 
                    JOIN users u ON p.manager_id = u.id
                    ORDER BY p.tanggal_mulai DESC
                ");
                while ($project = $projects_result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $project['id']; ?></td>
                    <td><?php echo htmlspecialchars($project['nama_proyek']); ?></td>
                    <td><?php echo htmlspecialchars($project['manager_name']); ?></td>
                    <td><?php echo $project['tanggal_mulai']; ?></td>
                    <td><?php echo $project['tanggal_selesai']; ?></td>
                    <td>
                        <a href="dashboard.php?delete_project=<?php echo $project['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus proyek ini? Semua tugas di dalamnya juga akan terhapus.')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
document.getElementById('roleSelect').addEventListener('change', function() {
    var managerSelect = document.getElementById('managerSelect');
    if (this.value == 'Team Member') {
        managerSelect.style.display = 'block';
    } else {
        managerSelect.style.display = 'none';
    }
});
</script>