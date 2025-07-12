<?php
$host = '127.0.0.1';
$user = 'root';
$pass = ''; // default XAMPP tidak pakai password
$db   = 'tugas_db';
$socket = '/opt/lampp/var/mysql/mysql.sock';

$conn = new mysqli($host, $user, $pass, $db, null, $socket);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
