<?php
	session_start();

	include_once "db.php";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$repeat = "";

		if (isset($_GET['main'])) {
			$query = "SELECT * FROM subtask WHERE name='".$_POST["task"]."' AND date='".$today."'";
			$result = $conn->query($query);
			$rows = $result->fetch_assoc();
			if(!$rows)
			{
				// $query = "INSERT INTO task(name, date) VALUES('".$_POST["task"]."', '".date("Y-m-d")."');";
				// $result = $conn->query($query);
				echo $_GET['main']. " - " .$_POST["task"];
				$_SESSION['error'] = 0;
				header("Location:index.php");	
			}
			else
			{
				$_SESSION['error'] = $_GET['main'];
				echo $_GET['main']. " ok- " .$_POST["task"];
				header("Location:index.php?error");
			}
		}
		else{
			$query = "SELECT * FROM task WHERE name='".$_POST["task"]."' AND date='".$today."'";
			$result = $conn->query($query);
			$rows = $result->fetch_assoc();
			if(!$rows)
			{
				// $query = "INSERT INTO task(name, date) VALUES('".$_POST["task"]."', '".date("Y-m-d")."');";
				// $result = $conn->query($query);
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