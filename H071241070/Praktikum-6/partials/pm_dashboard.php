<?php
// File ini dipanggil oleh dashboard.php, jadi $koneksi dan $_SESSION sudah ada.
$pm_id = $_SESSION['user_id'];


// Logika Tambah Proyek
if (isset($_POST['add_project'])) {
    $nama_proyek = $_POST['nama_proyek'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];

    $stmt = $koneksi->prepare("INSERT INTO projects (nama_proyek, deskripsi, tanggal_mulai, tanggal_selesai, manager_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $nama_proyek, $deskripsi, $tanggal_mulai, $tanggal_selesai, $pm_id);
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Proyek baru berhasil dibuat.</div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }
    $stmt->close();
}

// Logika Hapus Proyek (Hanya milik sendiri)
if (isset($_GET['delete_project_pm'])) {
    $project_id = $_GET['delete_project_pm'];
    
    // Hapus tugas terkait dulu
    $stmt_tasks = $koneksi->prepare("DELETE FROM tasks WHERE project_id = ?");
    $stmt_tasks->bind_param("i", $project_id);
    $stmt_tasks->execute();
    $stmt_tasks->close();
    
    // Hapus proyek (Cek kepemilikan)
    $stmt = $koneksi->prepare("DELETE FROM projects WHERE id = ? AND manager_id = ?");
    $stmt->bind_param("ii", $project_id, $pm_id);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo '<div class="alert alert-success">Proyek berhasil dihapus.</div>';
        } else {
            echo '<div class="alert alert-danger">Error: Proyek tidak ditemukan atau bukan milik Anda.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }
    $stmt->close();
}

// LOGIKA UPDATE PROYEK
if (isset($_POST['update_project'])) {
    $project_id = $_POST['project_id'];
    $nama_proyek = $_POST['nama_proyek'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    
    $stmt = $koneksi->prepare("UPDATE projects SET nama_proyek = ?, deskripsi = ?, tanggal_mulai = ?, tanggal_selesai = ? WHERE id = ? AND manager_id = ?");
    $stmt->bind_param("ssssii", $nama_proyek, $deskripsi, $tanggal_mulai, $tanggal_selesai, $project_id, $pm_id);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo '<div class="alert alert-success">Proyek berhasil diperbarui.</div>';
        } else {
            echo '<div class="alert alert-info">Tidak ada perubahan data.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }
    $stmt->close();
}
// Logika Tambah Tugas
if (isset($_POST['add_task'])) {
    $nama_tugas = $_POST['nama_tugas'];
    $deskripsi_tugas = $_POST['deskripsi_tugas'];
    $project_id = $_POST['project_id'];
    $assigned_to = $_POST['assigned_to'];
    // Status default 'belum' sudah di database

    $stmt = $koneksi->prepare("INSERT INTO tasks (nama_tugas, deskripsi, project_id, assigned_to) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $nama_tugas, $deskripsi_tugas, $project_id, $assigned_to);
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Tugas baru berhasil ditambahkan.</div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }
    $stmt->close();
}

// Logika Hapus Tugas
if (isset($_GET['delete_task_pm'])) {
    $task_id = $_GET['delete_task_pm'];
    // Hapus tugas (Perlu cek apakah tugas ini bagian dari proyek si PM)
    $stmt = $koneksi->prepare("
        DELETE t FROM tasks t
        JOIN projects p ON t.project_id = p.id
        WHERE t.id = ? AND p.manager_id = ?
    ");
    $stmt->bind_param("ii", $task_id, $pm_id);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo '<div class="alert alert-success">Tugas berhasil dihapus.</div>';
        } else {
            echo '<div class="alert alert-danger">Error: Tugas tidak ditemukan atau bukan bagian dari proyek Anda.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }
    $stmt->close();
}

// Ambil data (hanya milik PM ini)
$projects_result = $koneksi->prepare("SELECT * FROM projects WHERE manager_id = ? ORDER BY tanggal_mulai DESC");
$projects_result->bind_param("i", $pm_id);
$projects_result->execute();
$my_projects = $projects_result->get_result();

// Ambil data Team Member (hanya yang di bawah PM ini)
$members_result = $koneksi->prepare("SELECT id, username FROM users WHERE role = 'Team Member' AND project_manager_id = ?");
$members_result->bind_param("i", $pm_id);
$members_result->execute();
$my_members = $members_result->get_result();
?>

<h2>Dashboard Project Manager</h2>
<hr>

<?php
// TAMPILKAN FORM EDIT JIKA DIKLIK
if (isset($_GET['edit_project_pm'])):
    $project_id_to_edit = $_GET['edit_project_pm'];
    
    // Ambil data proyek YANG MAU DIEDIT (pastikan milik PM ini)
    $stmt_edit = $koneksi->prepare("SELECT * FROM projects WHERE id = ? AND manager_id = ?");
    $stmt_edit->bind_param("ii", $project_id_to_edit, $pm_id);
    $stmt_edit->execute();
    $project_data = $stmt_edit->get_result()->fetch_assoc();
    $stmt_edit->close();

    // Jika datanya ditemukan
    if ($project_data): 
?>
    <div class="card mb-4 border-warning">
        <div class="card-header bg-warning">
            <h4>Edit Proyek: <?php echo htmlspecialchars($project_data['nama_proyek']); ?></h4>
        </div>
        <div class="card-body">
            <form action="dashboard.php" method="POST">
                <input type="hidden" name="project_id" value="<?php echo $project_data['id']; ?>">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Proyek</label>
                        <input type="text" name="nama_proyek" class="form-control" value="<?php echo htmlspecialchars($project_data['nama_proyek']); ?>" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control" value="<?php echo $project_data['tanggal_mulai']; ?>" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control" value="<?php echo $project_data['tanggal_selesai']; ?>" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Deskripsi Proyek</label>
                        <textarea name="deskripsi" class="form-control" rows="2"><?php echo htmlspecialchars($project_data['deskripsi']); ?></textarea>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" name="update_project" class="btn btn-success">Simpan Perubahan</button>
                        <a href="dashboard.php" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    else:
        // Jika ID proyek tidak ditemukan atau bukan milik si PM
        echo '<div class="alert alert-danger">Proyek tidak ditemukan atau Anda tidak punya akses.</div>';
    endif;
endif; 
?>


<div class="card mb-4">
    <div class="card-header">
        <h4>Proyek Saya</h4>
    </div>
    <div class="card-body">
        <h5 class="mb-3">Buat Proyek Baru</h5>
        <form action="dashboard.php" method="POST" class="mb-4 p-3 bg-light rounded">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Proyek</label>
                    <input type="text" name="nama_proyek" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Deskripsi Proyek</label>
                    <textarea name="deskripsi" class="form-control" rows="2"></textarea>
                </div>
                <div class="col-md-12">
                    <button type="submit" name="add_project" class="btn btn-primary">Simpan Proyek</button>
                </div>
            </div>
        </form>
        
        <hr>
        
        <h5 class="mb-3">Daftar Proyek Saya</h5>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama Proyek</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($project = $my_projects->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($project['nama_proyek']); ?></td>
                    <td><?php echo htmlspecialchars($project['deskripsi']); ?></td>
                    <td><?php echo $project['tanggal_mulai']; ?> s/d <?php echo $project['tanggal_selesai']; ?></td>
                    <td>
                        <a href="dashboard.php?edit_project_pm=<?php echo $project['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="dashboard.php?delete_project_pm=<?php echo $project['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus proyek ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php $my_projects->data_seek(0); // Reset pointer result set ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h4>Tugas (Tasks)</h4>
    </div>
    <div class="card-body">
        <h5 class="mb-3">Tambah Tugas Baru</h5>
        <form action="dashboard.php" method="POST" class="mb-4 p-3 bg-light rounded">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Tugas</label>
                    <input type="text" name="nama_tugas" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Untuk Proyek</label>
                    <select name="project_id" class="form-select" required>
                        <option value="">-- Pilih Proyek --</option>
                        <?php while ($project = $my_projects->fetch_assoc()): ?>
                        <option value="<?php echo $project['id']; ?>"><?php echo htmlspecialchars($project['nama_proyek']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tugaskan Kepada</label>
                    <select name="assigned_to" class="form-select" required>
                        <option value="">-- Pilih Team Member --</option>
                        <?php while ($member = $my_members->fetch_assoc()): ?>
                        <option value="<?php echo $member['id']; ?>"><?php echo htmlspecialchars($member['username']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Deskripsi Tugas</label>
                    <textarea name="deskripsi_tugas" class="form-control" rows="2"></textarea>
                </div>
                <div class="col-md-12">
                    <button type="submit" name="add_task" class="btn btn-primary">Simpan Tugas</button>
                </div>
            </div>
        </form>

        <hr>

        <h5 class="mb-3">Daftar Semua Tugas di Proyek Saya</h5>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tugas</th>
                    <th>Proyek</th>
                    <th>Ditugaskan Kepada</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tasks_result = $koneksi->prepare("
                    SELECT t.*, p.nama_proyek, u.username AS member_name
                    FROM tasks t
                    JOIN projects p ON t.project_id = p.id
                    LEFT JOIN users u ON t.assigned_to = u.id
                    WHERE p.manager_id = ?
                    ORDER BY p.id, t.id
                ");
                $tasks_result->bind_param("i", $pm_id);
                $tasks_result->execute();
                $all_tasks = $tasks_result->get_result();
                
                while ($task = $all_tasks->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($task['nama_tugas']); ?></td>
                    <td><?php echo htmlspecialchars($task['nama_proyek']); ?></td>
                    <td><?php echo htmlspecialchars($task['member_name'] ?? 'Belum Ditugaskan'); ?></td>
                    <td>
                        <?php
                            $status = htmlspecialchars($task['status']);
                            $badge_class = 'bg-secondary';
                            if ($status == 'proses') $badge_class = 'bg-primary';
                            if ($status == 'selesai') $badge_class = 'bg-success';
                            echo "<span class='badge $badge_class'>$status</span>";
                        ?>
                    </td>
                    <td>
                        <a href="dashboard.php?delete_task_pm=<?php echo $task['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus tugas ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>