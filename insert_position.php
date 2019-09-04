<?php

include 'includes/connection.php';
session_start();

if(isset($_SESSION['username']))
	{
        $stmt = $conn->prepare("INSERT INTO positions (username, name, description, lat, lng)
        VALUES (:username, :name, :description, :lat, :lng)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':lat', $lat);
        $stmt->bindParam(':lng', $lng);

        $username = $_SESSION['username'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $stmt->execute();
    }else{
        header('location: index.php');
    }


?>