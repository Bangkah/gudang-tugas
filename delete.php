<?php
session_start();
include 'config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // hanya boleh hapus jika milik user yang login
    $stmt = $conn->prepare("SELECT nama_file FROM tugas WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nama_file);
        $stmt->fetch();
        unlink("uploads/" . $nama_file);

        $delete = $conn->prepare("DELETE FROM tugas WHERE id = ? AND user_id = ?");
        $delete->bind_param("ii", $id, $user_id);
        $delete->execute();
    }
}
header("Location: index.php");
exit;
