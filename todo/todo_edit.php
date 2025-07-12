<?php
session_start();
include '../config/db.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $priority = $_POST['priority'];
  $status = $_POST['status'];
  $due_date = $_POST['due_date'];

  $stmt = $conn->prepare("UPDATE todo_tasks SET title=?, description=?, priority=?, status=?, due_date=? WHERE id=? AND user_id=?");
  $stmt->bind_param("sssssii", $title, $description, $priority, $status, $due_date, $id, $user_id);
  $stmt->execute();
  header("Location: todo.php");
  exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM todo_tasks WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>

<form action="todo_edit.php" method="POST">
  <input type="hidden" name="id" value="<?= $data['id'] ?>">
  <input type="text" name="title" value="<?= htmlspecialchars($data['title']) ?>" required>
  <textarea name="description"><?= htmlspecialchars($data['description']) ?></textarea>
  <select name="priority">
    <option value="low" <?= $data['priority'] == 'low' ? 'selected' : '' ?>>Rendah</option>
    <option value="medium" <?= $data['priority'] == 'medium' ? 'selected' : '' ?>>Sedang</option>
    <option value="high" <?= $data['priority'] == 'high' ? 'selected' : '' ?>>Tinggi</option>
  </select>
  <select name="status">
    <option value="pending" <?= $data['status'] == 'pending' ? 'selected' : '' ?>>Belum Dikerjakan</option>
    <option value="in_progress" <?= $data['status'] == 'in_progress' ? 'selected' : '' ?>>Sedang Dikerjakan</option>
    <option value="completed" <?= $data['status'] == 'completed' ? 'selected' : '' ?>>Selesai</option>
  </select>
  <input type="date" name="due_date" value="<?= $data['due_date'] ?>">
  <button type="submit">Simpan Perubahan</button>
</form>
