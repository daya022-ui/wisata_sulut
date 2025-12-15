<?php
require_once 'protect.php';
require_once '../api/db.php';

// Ambil semua data kuliner
$kuliner_list = [];

$result = $conn->query("SELECT * FROM kuliner ORDER BY created_at DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $kuliner_list[] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kuliner - Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .admin-layout { display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 2rem 0; position: fixed; height: 100vh; overflow-y: auto; box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1); }
        .sidebar-header { padding: 0 1.5rem 2rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1); margin-bottom: 2rem; }
        .sidebar-header h2 { font-size: 1.5rem; margin-bottom: 0.5rem; color: white; }
        .sidebar-menu { list-style: none; padding: 0; }
        .sidebar-menu li { margin-bottom: 0.5rem; }
        .sidebar-menu a { display: flex; align-items: center; gap: 1rem; padding: 1rem 1.5rem; color: white; transition: all 0.3s ease; font-weight: 500; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255, 255, 255, 0.1); border-left: 4px solid white; }
        .main-content { flex: 1; margin-left: 280px; background: #f5f7fa; }
        .top-bar { background: white; padding: 1.5rem 2rem; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); display: flex; justify-content: space-between; align-items: center; }
        .user-info { display: flex; align-items: center; gap: 1rem; }
        .user-avatar { width: 45px; height: 45px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.2rem; }
        .logout-btn { padding: 0.7rem 1.5rem; background: #dc3545; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.3s ease; }
        .logout-btn:hover { background: #c82333; transform: translateY(-2px); }
        .content-area { padding: 2rem; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .page-header h1 { color: var(--primary); font-size: 2rem; }
        .btn-add { padding: 1rem 2rem; background: var(--primary); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 0.5rem; }
        .btn-add:hover { background: var(--primary-dark); transform: translateY(-2px); }
        .data-table { background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); overflow: hidden; }
        .table-wrapper { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead { background: var(--primary); color: white; }
        thead th { padding: 1.2rem 1rem; text-align: left; font-weight: 600; font-size: 0.95rem; }
        tbody tr { border-bottom: 1px solid #e0e0e0; transition: background 0.3s ease; }
        tbody tr:hover { background: #f8f9fa; }
        tbody td { padding: 1rem; color: var(--text-dark); }
        .table-img { width: 80px; height: 60px; object-fit: cover; border-radius: 8px; }
        .badge { display: inline-block; padding: 0.4rem 0.8rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600; background: #e8f5e9; color: #2e7d32; }
        .action-buttons { display: flex; gap: 0.5rem; }
        .btn-sm { padding: 0.5rem 1rem; border: none; border-radius: 6px; cursor: pointer; font-size: 0.9rem; font-weight: 600; transition: all 0.3s ease; }
        .btn-edit { background: #ffc107; color: #000; }
        .btn-edit:hover { background: #ffb300; transform: translateY(-2px); }
        .btn-delete { background: #dc3545; color: white; }
        .btn-delete:hover { background: #c82333; transform: translateY(-2px); }
        .btn-gallery { background: #17a2b8; color: white; }
        .btn-gallery:hover { background: #138496; transform: translateY(-2px); }
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); z-index: 9999; }
        .modal.show { display: flex; align-items: center; justify-content: center; }
        .modal-content { background: white; border-radius: 12px; width: 90%; max-width: 700px; max-height: 90vh; overflow-y: auto; }
        .modal-header { padding: 1.5rem 2rem; border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center; background: var(--primary); color: white; }
        .modal-header h2 { font-size: 1.5rem; margin: 0; color: white; }
        .close-modal { background: none; border: none; color: white; font-size: 2rem; cursor: pointer; line-height: 1; }
        .modal-body { padding: 2rem; }
        .form-row { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; margin-bottom: 1.5rem; }
        .form-row.full { grid-template-columns: 1fr; }
        .image-preview { width: 100%; max-height: 200px; object-fit: cover; border-radius: 8px; margin-top: 1rem; display: none; }
        .modal-footer { padding: 1.5rem 2rem; border-top: 1px solid #e0e0e0; display: flex; gap: 1rem; justify-content: flex-end; }
        .btn-cancel { padding: 0.8rem 1.5rem; background: #6c757d; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; }
        .btn-submit { padding: 0.8rem 1.5rem; background: var(--primary); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; }
        .empty-state { text-align: center; padding: 4rem 2rem; color: var(--text-light); }
        .empty-state-icon { font-size: 5rem; margin-bottom: 1rem; opacity: 0.5; }
        .coordinates-input { font-family: monospace; background: #f8f9fa; }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>🏝️ Admin Panel</h2>
                <p>Wisata Sulawesi Utara</p>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php"><span>📊</span> Dashboard</a></li>
                <li><a href="wisata_manage.php"><span>🏖️</span> Kelola Wisata</a></li>
                <li><a href="kuliner_manage.php" class="active"><span>🍽️</span> Kelola Kuliner</a></li>
                <li><a href="budaya_manage.php"><span>🎭</span> Kelola Budaya</a></li>
                <li><a href="../index.php" target="_blank"><span>🌐</span> Lihat Website</a></li>
            </ul>
        </aside>

        <div class="main-content">
            <div class="top-bar">
                <div class="user-info">
                    <div class="user-avatar"><?php echo strtoupper(substr(getLoggedInUserName(), 0, 1)); ?></div>
                    <div>
                        <h4><?php echo htmlspecialchars(getLoggedInUserName()); ?></h4>
                        <p><?php echo htmlspecialchars(ucfirst(getLoggedInUserRole())); ?></p>
                    </div>
                </div>
                <a href="../auth/logout.php" class="logout-btn">Logout</a>
            </div>

            <div class="content-area">
                <div class="page-header">
                    <h1>🍽️ Kelola Kuliner</h1>
                    <button class="btn-add" onclick="openModal('add')">
                        <span>➕</span> Tambah Kuliner
                    </button>
                </div>

                <div class="data-table">
                    <div class="table-wrapper">
                        <?php if (count($kuliner_list) > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Koordinat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kuliner_list as $kuliner): ?>
                                <tr>
                                    <td>
                                        <?php if ($kuliner['image']): ?>
                                        <img src="../img/kuliner/<?php echo htmlspecialchars($kuliner['image']); ?>" alt="" class="table-img">
                                        <?php else: ?>
                                        <div class="table-img" style="background: #e0e0e0; display: flex; align-items: center; justify-content: center;">🍽️</div>
                                        <?php endif; ?>
                                    </td>
                                    <td><strong><?php echo htmlspecialchars($kuliner['name']); ?></strong></td>
                                    <td><span class="badge"><?php echo htmlspecialchars($kuliner['alamat'] ?? '-'); ?></span></td>
                                    <td>
                                        <small>
                                            <?php 
                                            if ($kuliner['latitude'] && $kuliner['longitude']) {
                                                echo number_format($kuliner['latitude'], 6) . ', ' . number_format($kuliner['longitude'], 6);
                                            } else {
                                                echo '-';
                                            }
                                            ?>
                                        </small>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-sm btn-gallery" onclick="manageGallery(<?php echo $kuliner['id']; ?>, '<?php echo htmlspecialchars($kuliner['name']); ?>')">Galeri</button>
                                            <button class="btn-sm btn-edit" onclick='editKuliner(<?php echo json_encode($kuliner); ?>)'>Edit</button>
                                            <button class="btn-sm btn-delete" onclick="deleteKuliner(<?php echo $kuliner['id']; ?>, '<?php echo htmlspecialchars($kuliner['name']); ?>')">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <div class="empty-state">
                            <div class="empty-state-icon">🍽️</div>
                            <h3>Belum ada data kuliner</h3>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalForm" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Tambah Kuliner</h2>
                <button class="close-modal" onclick="closeModal()">&times;</button>
            </div>
            <form id="kulinerForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="kulinerId" name="id">
                    <input type="hidden" id="formAction" name="action" value="add">

                    <div class="form-row full">
                        <div class="form-group">
                            <label for="name">Nama Kuliner *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                    </div>

                    <div class="form-row full">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" id="alamat" name="alamat" placeholder="Alamat lengkap">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="number" id="latitude" name="latitude" step="0.000001" class="coordinates-input">
                        </div>
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="number" id="longitude" name="longitude" step="0.000001" class="coordinates-input">
                        </div>
                    </div>

                    <div class="form-row full">
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea id="description" name="description" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="form-row full">
                        <div class="form-group">
                            <label for="image">Upload Gambar *</label>
                            <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                            <img id="imagePreview" class="image-preview">
                            <input type="hidden" id="oldImage" name="old_image">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(action) {
            const modal = document.getElementById('modalForm');
            const form = document.getElementById('kulinerForm');
            form.reset();
            document.getElementById('formAction').value = action;
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('modalTitle').textContent = action === 'add' ? 'Tambah Kuliner Baru' : 'Edit Kuliner';
            document.getElementById('image').required = action === 'add';
            modal.classList.add('show');
        }

        function closeModal() {
            document.getElementById('modalForm').classList.remove('show');
        }

        function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        function editKuliner(data) {
            openModal('edit');
            document.getElementById('kulinerId').value = data.id;
            document.getElementById('name').value = data.name;
            document.getElementById('alamat').value = data.alamat || '';
            document.getElementById('latitude').value = data.latitude || '';
            document.getElementById('longitude').value = data.longitude || '';
            document.getElementById('description').value = data.description || '';
            document.getElementById('oldImage').value = data.image || '';
            document.getElementById('image').required = false;
            
            if (data.image) {
                const preview = document.getElementById('imagePreview');
                preview.src = '../img/kuliner/' + data.image;
                preview.style.display = 'block';
            }
        }

        function deleteKuliner(id, nama) {
            if (confirm(`Yakin ingin menghapus kuliner "${nama}"?`)) {
                const formData = new FormData();
                formData.append('action', 'delete');
                formData.append('id', id);
                
                fetch('../api/kuliner_action.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Data berhasil dihapus!');
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                });
            }
        }

        function manageGallery(id, nama) {
            window.location.href = `kuliner_gallery.php?id=${id}&name=${encodeURIComponent(nama)}`;
        }

        document.getElementById('kulinerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const submitBtn = this.querySelector('.btn-submit');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Menyimpan...';
            
            fetch('../api/kuliner_action.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Simpan';
                }
            });
        });

        window.onclick = function(event) {
            const modal = document.getElementById('modalForm');
            if (event.target === modal) closeModal();
        };
    </script>
</body>
</html>