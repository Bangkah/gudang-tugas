<?php
session_start();
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['tugas'])) {
    $user_id = $_SESSION['user_id'];
    $nama_file = basename($_FILES['tugas']['name']);
    $deskripsi = $_POST['deskripsi'];
    $target_dir = "uploads/";
    $target_file = $target_dir . $nama_file;

    if (move_uploaded_file($_FILES['tugas']['tmp_name'], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO tugas (user_id, nama_file, deskripsi) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $nama_file, $deskripsi);
        $stmt->execute();
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal upload file.";
    }
}
?>
