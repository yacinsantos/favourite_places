<?php

include 'includes/connection.php';

session_start();
$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM positions where username = ?");
$stmt->execute(array($username));
$result = $stmt->fetchAll();

echo json_encode($result);



?>