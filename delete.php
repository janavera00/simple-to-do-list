<?php
	session_start();

	include_once "db.php";

	if($_GET['id'])
	{
		$id = $_GET['id'];	

		mysqli_query($conn, "DELETE FROM subtask WHERE mainTask=".$id);
		mysqli_query($conn, "DELETE FROM task WHERE taskno=".$id);

		header("location: index.php");
	}
	else
	{
   		$sub = $_GET['sub'];
		mysqli_query($conn, "DELETE FROM subtask WHERE subtaskno=".$sub);
		
		header("location: index.php");
	}
?>