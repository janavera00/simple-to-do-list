<?php
	session_start();

	include_once 'db.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">		
		<title>To Do List</title>
	</head>
	<body>
		<!-- Title -->
		<h1 style="font-size: 50px; margin: 50px;">To Do List</h1>
		
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
				<div class="task" style="width: 88%;">
					This is a textbox
				</div>
				<div class="button">
					Enter
				</div>
			</div>

			<?php
				//getting current date
				$today = date("Y-m-d");

				// query to fetch task created today
				$query = "SELECT * FROM task WHERE date='".$today."';";
				$result = $conn->query($query);


				while ($rows = $result->fetch_assoc()) 
				{
					// display task box
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
					echo "</div>";
				}
			?>
		</div>
	</body>
</html>
