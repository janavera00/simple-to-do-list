<?php 
	session_start();

	include_once "db.php";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_GET['main']))
		{
			$query = "SELECT * FROM subtask WHERE name='".$_POST["task"]."' AND date='".$today."' AND mainTask=".$_GET['main']." AND NOT subtaskno=".$_GET['sub'].";";
			$result = $conn->query($query);
			$rows = $result->fetch_assoc();
			if(!$rows)
			{
				$query = "UPDATE subtask SET name='".$_POST["task"]."' WHERE subtaskno=".$_GET['sub'].";";
				$result = $conn->query($query);
				$_SESSION['error'] = 0;
				header("Location:index.php");	
			}
			else
			{
				$_SESSION['error'] = -1;
				header("Location:index.php?error");
			}
		}
		else
		{
			$query = "SELECT * FROM task WHERE name='".$_POST["task"]."' AND date='".$today."' AND NOT taskno=".$_GET['id'].";";
			$result = $conn->query($query);
			$rows = $result->fetch_assoc();
			if(!$rows)
			{
				$query = "UPDATE task SET name='".$_POST["task"]."' WHERE taskno=".$_GET['id'].";";
				$result = $conn->query($query);
				$_SESSION['error'] = 0;
				header("Location:index.php");	
			}
			else
			{
				$_SESSION['error'] = -1;
				header("Location:index.php?error");
			}
		}
	}
	 
?>