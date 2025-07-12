<?php
include "config/db.php";

if (isset($_FILES['tugas']) && isset($_POST['deskripsi'])) {
    $fileName = basename($_FILES['tugas']['name']);
    $targetDir = "uploads/";
    $targetFile = $targetDir . $fileName;
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);

    if (move_uploaded_file($_FILES['tugas']['tmp_name'], $targetFile)) {
        $conn->query("INSERT INTO tugas (nama_file, deskripsi) VALUES ('$fileName', '$deskripsi')");
        header("Location: index.php");
    } else {
        echo "Upload gagal.";
    }
}
?>
