<?php include '../config/db.php'; ?>
<?php include '../session.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>To-Do List Saya</title>
  <style>
    body { font-family: sans-serif; padding: 20px; background: #f8f9fa; }
    .container { max-width: 900px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { margin-top: 0; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
    th { background-color: #007BFF; color: white; }
    form { margin-top: 20px; }
    input, textarea, select, button { padding: 8px; width: 100%; margin-top: 5px; }
    .aksi a { margin-right: 10px; }
  </style>
</head>
<body>
  <div class="container">
    <h2>📝 Daftar Tugas Saya</h2>

    <!-- Form Tambah Tugas -->
    <form action="todo_add.php" method="POST">
      <input type="text" name="title" placeholder="Judul tugas..." required>
      <textarea name="description" placeholder="Deskripsi..."></textarea>
      <select name="priority">
        <option value="low">Prioritas: Rendah</option>
        <option value="medium" selected>Prioritas: Sedang</option>
        <option value="high">Prioritas: Tinggi</option>
      </select>
      <input type="date" name="due_date">
      <button type="submit">Tambah</button>
    </form>

    <!-- Tabel Tugas -->
    <table>
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Deskripsi</th>
        <th>Prioritas</th>
        <th>Status</th>
        <th>Deadline</th>
        <th>File Selesai</th>
        <th>Aksi</th>
      </tr>
      <?php
      $user_id = $_SESSION['user_id'];
      $stmt = $conn->prepare("SELECT * FROM todo_tasks WHERE user_id = ? ORDER BY due_date ASC, id DESC");
      $stmt->bind_param("i", $user_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $no = 1;
      while ($row = $result->fetch_assoc()):
      ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= nl2br(htmlspecialchars($row['description'])) ?></td>
        <td><?= ucfirst($row['priority']) ?></td>
        <td><?= ucfirst(str_replace('_', ' ', $row['status'])) ?></td>
        <td><?= $row['due_date'] ?: '-' ?></td>
        <td>
          <?php if ($row['file_done']): ?>
            <a href="../uploads/<?= $row['file_done'] ?>" download>Download</a>
          <?php else: ?>
            <form action="todo_upload.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <input type="file" name="file" required>
              <button type="submit">Upload</button>
            </form>
          <?php endif; ?>
        </td>
        <td class="aksi">
          <a href="todo_edit.php?id=<?= $row['id'] ?>">Edit</a>
          <a href="todo_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus tugas ini?')">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>
</body>
</html>
