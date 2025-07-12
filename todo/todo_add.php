<?php
session_start();
include '../config/db.php';

$title = $_POST['title'];
$description = $_POST['description'];
$priority = $_POST['priority'] ?? 'medium';
$due_date = $_POST['due_date'] ?? null;
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("INSERT INTO todo_tasks (user_id, title, description, priority, due_date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("issss", $user_id, $title, $description, $priority, $due_date);
$stmt->execute();

header("Location: todo.php");
exit;
