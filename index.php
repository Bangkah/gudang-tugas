<?php include "config/db.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Manajemen Tugas Atha</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Upload Tugas</h2>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="tugas" required><br>
    <textarea name="deskripsi" placeholder="Deskripsi tugas..." required></textarea><br>
    <button type="submit">Upload</button>
  </form>

  <hr>
  <h2>Daftar Tugas</h2>
  <table border="1" cellpadding="8">
    <tr>
      <th>No</th>
      <th>Nama File</th>
      <th>Deskripsi</th>
      <th>Tanggal Upload</th>
      <th>Aksi</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM tugas ORDER BY id DESC");
    $no = 1;
    while ($row = $result->fetch_assoc()):
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><a href="uploads/<?= $row['nama_file'] ?>" download><?= $row['nama_file'] ?></a></td>
      <td><?= htmlspecialchars($row['deskripsi']) ?></td>
      <td><?= $row['tanggal_upload'] ?></td>
      <td><a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus tugas ini?')">Hapus</a></td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
