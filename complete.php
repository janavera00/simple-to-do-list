<?php
	include_once "db.php";

	if($_GET['id'])
	{
		$id = $_GET['id'];

		$result = $conn->query("UPDATE task SET status=1 WHERE taskno=".$id);

		header("location: index.php");
	}
	else
	{
		
	}
?>