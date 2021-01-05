<?php
	session_start();

	include_once "db.php";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if (isset($_GET['main'])) {
			$query = "SELECT * FROM subtask WHERE name='".$_POST["task"]."' AND date='".$today."' AND mainTask=".$_GET['main'];
			$result = $conn->query($query);
			if(!mysqli_num_rows($result))
			{
				$query = "INSERT INTO subtask(name, mainTask, date, status) VALUES('".$_POST["task"]."', ".$_GET['main'].", '".date("Y-m-d")."', 0);";
				$result = $conn->query($query);
				// echo $_GET['main']. " - " .$_POST["task"];

				$_SESSION['error'] = 0;
				$_SESSION['errorMessege'] = "";
				header("Location:index.php");	 
			}
			else
			{
				$_SESSION['error'] = $_GET['main'];
				$_SESSION['errorMessege'] = "Task Already Exist";

				// echo $_GET['main']. " ok- " .$_POST["task"];
				header("Location:index.php?error");
			}
		}
		else{
			$query = "SELECT * FROM task WHERE name='".$_POST["task"]."' AND date='".$today."'";
			$result = $conn->query($query);
			
			if(!mysqli_num_rows($result))
			{
				echo $_POST["task"]." - ".$today;
				$query = "INSERT INTO task(name, date, status) VALUES('".$_POST["task"]."', '".$today."', 0);";
				$result = $conn->query($query);
				$_SESSION['error'] = 0;

				$_SESSION['error'] = 0;
				$_SESSION['errorMessege'] = "";
				header("Location:index.php");	
			}
			else
			{
				$_SESSION['error'] = -1;
				$_SESSION['errorMessege'] = "Task Already Exist";
				header("Location:index.php?error");
			}
		}
	} 
?>