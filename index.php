<?php
	session_start();

	include_once 'db.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="design.css">
		<title>To Do List</title>
	</head>
	<body>
		<!-- Title -->
		<h1 style="font-size: 70px; margin: 50px;">To Do List</h1>
		
		<!-- Main Container -->
		<div class="container">
			<!-- Tabs -->
			<div class="tabContainer">
				<div class="tab">
					<-
				</div>
				<div class="tab">
					Today
				</div>	
				<div class="tab">
					->
				</div>
			</div>


			<!-- textbox for task input -->
			<div class="taskBox">
				<form method="post">
					<input type="textbox" name="task" class="task" placeholder="What will you do today?">
					<input type="submit" name="enter" value="Enter" class="button">
				</form>
				<?php
					if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						$repeat = "";

						$query = "SELECT * FROM task WHERE name='".$_POST["task"]."'";
						$result = $conn->query($query);
						$rows = $result->fetch_assoc();
						if(!$rows)
						{
							$query = "INSERT INTO task(name, date) VALUES('".$_POST["task"]."', '".date("Y-m-d")."');";
							$result = $conn->query($query);

							header("Location:index.php");	
						}
						else
						{
							echo "Task already Exist";
						}
					} 
				?>
			</div>

			<?php
				//getting current date
				$today = date("Y-m-d");

				// query to fetch task created today
				$query = "SELECT * FROM task WHERE date='".$today."';";
				$result = $conn->query($query);

				// display all the task ang subtask
				while ($rows = $result->fetch_assoc()) 
				{
					// display task box
					if($rows['status'] == 0)
					echo "<div class='taskBox'>
							<div class='task'>
								".$rows['name']."
							</div>
							<div class='buttonContainer'>
								<div class='button'>
									/
								</div>
								<div class='button'>
									E
								</div>
								<div class='button'>
									X
								</div>
							</div>";

					// query to fetch subtask
					$subQuery = "SELECT * FROM subtask WHERE mainTask='".$rows['taskno']."';";
					$subResult = $conn->query($subQuery);

					while ($subRows = $subResult->fetch_assoc()) 
					{
						if($subRows['status'] == 0)
						{
							echo "<br>
								<div class='arrow'>
									L>
								</div>
								<div class='subTaskBox'>
									<div class='task'>
										".$subRows['name']."
									</div>
									<div class='buttonContainer'>
										<div class='button'>
											/
										</div>
										<div class='button'>
											E
										</div>
										<div class='button'>
											X
										</div>
									</div>
								</div>";
						}
					}
					echo "</div>";
				}
			?>
		</div>
	</body>
</html>
