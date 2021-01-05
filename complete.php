<?php
	session_start();

	include_once "db.php";

	if($_GET['id'])
	{
		$id = $_GET['id'];

		$check = $conn->query("SELECT * FROM subtask WHERE status=0 AND mainTask=".$id);
		
		if(!mysqli_num_rows($check))
		{
			$conn->query("UPDATE task SET status=1 WHERE taskno=".$id);

			$_SESSION['error'] = 0;
			$_SESSION['errorMessege'] = "";
			header("location: index.php");
		}
		else
		{
			$_SESSION['error'] = $id;
			$_SESSION['errorMessege'] = "Complete subtask first";
			header("location: index.php?error");
		}

	}
	else
	{
		$sub = $_GET['sub'];

		$conn->query("UPDATE subtask SET status=1 WHERE subtaskno=".$sub);

		$_SESSION['error'] = 0;
		$_SESSION['errorMessege'] = "";
		header("location: index.php");
	}
?>