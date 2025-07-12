<?php
include "config/db.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $result = $conn->query("SELECT nama_file FROM tugas WHERE id=$id");
    if ($result->num_rows) {
        $file = $result->fetch_assoc()['nama_file'];
        unlink("uploads/" . $file);
        $conn->query("DELETE FROM tugas WHERE id=$id");
    }
}
header("Location: index.php");
?>
