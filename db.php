<?php
	$server = "localhost";
	$user = "root";
	$pass = "";
	$db = "todo_list";
	$conn = mysqli_connect($server, $user, $pass, $db);
	$today = date("Y-m-d");
?>