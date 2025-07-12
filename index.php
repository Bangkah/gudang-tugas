<?php include "config/db.php"; ?>
<?php include "session.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tugas - Atha</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
            line-height: 1.6;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            color: #667eea;
            font-size: 24px;
            font-weight: 700;
        }

        .logo i {
            margin-right: 10px;
            font-size: 28px;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .welcome-text {
            color: #333;
            font-weight: 500;
        }

        .username {
            color: #667eea;
            font-weight: 700;
        }

        .logout-btn {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .main-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 24px;
            margin-bottom: 10px;
            color: #667eea;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            padding: 25px 25px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .card-header h2 {
            color: #333;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .card-content {
            padding: 25px;
        }

        .upload-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
            width: 100%;
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            left: -9999px;
        }

        .file-input-display {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 2px dashed #667eea;
            border-radius: 10px;
            background: #f8f9ff;
            color: #667eea;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-input-display:hover {
            border-color: #764ba2;
            background: #f0f2ff;
        }

        .file-input-display i {
            margin-right: 10px;
            font-size: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-label {
            font-weight: 500;
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control {
            padding: 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .textarea-control {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .table-container {
            overflow-x: auto;
        }

        .task-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .task-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            border: none;
        }

        .task-table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .task-table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .task-table td {
            padding: 15px 12px;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }

        .task-table tr:hover {
            background: #f8f9ff;
        }

        .file-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .file-link:hover {
            color: #764ba2;
        }

        .delete-btn {
            color: #dc3545;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
        }

        .delete-btn:hover {
            background: #dc3545;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #ccc;
        }

        .footer {
            text-align: center;
            padding: 30px 20px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            margin-top: 50px;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .nav-right {
                flex-direction: column;
                gap: 10px;
            }

            .content-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .task-table {
                font-size: 14px;
            }

            .task-table th,
            .task-table td {
                padding: 10px 8px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <div class="logo">
                <i class="fas fa-tasks"></i>
                <span>Tugas Atha</span>
            </div>
            <div class="nav-right">
                <div class="welcome-text">
                    <i class="fas fa-user"></i>
                    Halo, <span class="username"><?= htmlspecialchars($_SESSION['username']) ?></span>
                </div>
                <a class="logout-btn" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="main-container">
        <!-- Stats Section -->
        <div class="stats-grid">
            <?php
            $user_id = $_SESSION['user_id'];
            $stmt = $conn->prepare("SELECT COUNT(*) as total FROM tugas WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $total_tasks = $stmt->get_result()->fetch_assoc()['total'];
            
            $stmt = $conn->prepare("SELECT COUNT(*) as today FROM tugas WHERE user_id = ? AND DATE(tanggal_upload) = CURDATE()");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $today_tasks = $stmt->get_result()->fetch_assoc()['today'];
            ?>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="stat-number"><?= $total_tasks ?></div>
                <div class="stat-label">Total Tugas</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-number"><?= $today_tasks ?></div>
                <div class="stat-label">Tugas Hari Ini</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="stat-number">1</div>
                <div class="stat-label">Pengguna Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-number">100%</div>
                <div class="stat-label">Produktivitas</div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Upload Form -->
            <div class="card">
                <div class="card-header">
                    <h2>
                        <i class="fas fa-cloud-upload-alt"></i>
                        Upload Tugas Baru
                    </h2>
                </div>
                <div class="card-content">
                    <form class="upload-form" action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-paperclip"></i>
                                Pilih File
                            </label>
                            <div class="file-input-wrapper">
                                <input type="file" name="tugas" id="file-input" required>
                                <div class="file-input-display" onclick="document.getElementById('file-input').click()">
                                    <i class="fas fa-upload"></i>
                                    <span id="file-name">Klik untuk memilih file</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-align-left"></i>
                                Deskripsi Tugas
                            </label>
                            <textarea class="form-control textarea-control" name="deskripsi" placeholder="Masukkan deskripsi tugas Anda di sini..." required></textarea>
                        </div>
                        
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-plus"></i>
                            Upload Tugas
                        </button>
                    </form>
                </div>
            </div>

            <!-- Task List -->
            <div class="card">
                <div class="card-header">
                    <h2>
                        <i class="fas fa-list"></i>
                        Daftar Tugas Saya
                    </h2>
                </div>
                <div class="card-content">
                    <div class="table-container">
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM tugas WHERE user_id = ? ORDER BY id DESC");
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result->num_rows > 0):
                        ?>
                        <table class="task-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama File</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal Upload</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = $result->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <a class="file-link" href="uploads/<?= htmlspecialchars($row['nama_file']) ?>" download>
                                            <i class="fas fa-download"></i>
                                            <?= htmlspecialchars($row['nama_file']) ?>
                                        </a>
                                    </td>
                                    <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                                    <td>
                                        <i class="fas fa-clock"></i>
                                        <?= $row['tanggal_upload'] ?>
                                    </td>
                                    <td>
                                        <a class="delete-btn" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus tugas ini?')">
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <h3>Belum ada tugas</h3>
                            <p>Upload tugas pertama Anda untuk memulai!</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        &copy; <?= date("Y") ?> Atha's Task Manager | Dibuat dengan <i class="fas fa-heart" style="color: #ff6b6b;"></i> oleh <a href="#">Atha</a>
    </footer>

    <script>
        // File input handler
        document.getElementById('file-input').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Klik untuk memilih file';
            document.getElementById('file-name').textContent = fileName;
        });

        // Smooth scrolling for better UX
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>