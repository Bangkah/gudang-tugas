<?php
session_start();
include '../config/db.php';

if (isset($_FILES['file'])) {
  $id = $_POST['id'];
  $user_id = $_SESSION['user_id'];
  $file_name = basename($_FILES['file']['name']);
  $target = "../uploads/" . $file_name;

  if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
    $stmt = $conn->prepare("UPDATE todo_tasks SET file_done=? WHERE id=? AND user_id=?");
    $stmt->bind_param("sii", $file_name, $id, $user_id);
    $stmt->execute();
  }
}

header("Location: todo.php");
exit;
