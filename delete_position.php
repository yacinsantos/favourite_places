<?php
	session_start();
	include 'includes/connection.php';

	if(isset($_SESSION['username']))
	{
		$id = $_GET['id'];

		if(isset($_GET['action']))
			{
				if(isset($_GET['action']) == "delete")
				{

					$sql= $conn->prepare('DELETE FROM positions WHERE id=?' );
					$sql->execute(array($id));

					header('location:index.php');

				}
			}
	}else
	{
		header('location:login.php');
	}	