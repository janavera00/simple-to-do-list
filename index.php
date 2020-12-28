<?php
	session_start();

	if(!isset($_GET['error']))
	{
		$_SESSION['error'] = 0;
	}

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
				<form method="post" action="add.php">
					<input type="textbox" name="task" class="task" style="width: 91%;" placeholder="What will you do today?" required>
					<input type="submit" name="enter" value="Enter" class="button">
				</form>
				<div <?php echo $_SESSION['error'] == -1?"id":"class" ?>="error" >
					Task already in the list!!!
				</div>
			</div>

			<?php
				//getting current date
				$today = date("Y-m-d");

				// query to fetch task created today
				$query = "SELECT * FROM task WHERE date='".$today."';";
				$result = $conn->query($query);

				// display all the taskan g subtask
				while ($rows = $result->fetch_assoc()) 
				{
					// display task box
					if($rows['status'] == 0)
						$key = $rows['taskno'];
					{ ?>
						<div class='taskBox'>
								<?php
									if(isset($_GET['id']) && $_GET['id'] == $rows['taskno'])
									{
										?>
											<form method="post" action="edit.php?id=<?php echo $_GET['id']; ?>">
												<input type="textbox" name="task" class="task" style="width: 91%; background-color: #1e5f74;" value="<?php echo $rows['name']; ?>" required>
												<input type="submit" name="enter" value="Enter" class="button">
											</form>
										<?php
									} else
									{
										?>
											<a onclick="myFunction(<?php echo $rows['taskno']; ?>)" style="color: white;">
												<div class="task">
													<?php echo $rows['name']; ?>
												</div>
											</a>
											<div class='buttonContainer'>
												<a href="complete.php?id=<?php echo $rows['taskno']; ?>" class="button" style="background-color: green;">Done</a>
												<a href="index.php?id=<?php echo $rows['taskno']; ?>" class="button" >Edit</a>
												<a href="complete.php?id=<?php echo $rows['taskno']; ?>" class="button" style="background-color: red;">Delete</a>
											</div>
										<?php	
									}
								?>

							<!-- subtask container --click main task to show(change display to block) -->
							<div id="<?php echo $rows['taskno']; ?>" style="display: <?php 
								if(isset($_GET['id']) && $_GET['id'] == $rows['taskno'] || isset($_GET['main']) && $_GET['main'] == $rows['taskno'] && $_GET['sub'] == $subRows['subtaskno'] || $_SESSION['error'] == $rows['taskno'])
								{
									echo 'block';
								}
								else
								{
									echo 'none';
								}

							 ?>;">
								<hr style="width: 95%;">
								<div class="subTaskBox">
									<form method="post" action="add.php?main=<?php echo $rows['taskno']; ?>">
										<input type="textbox" name="task" class="task" style="width: 87%;" placeholder="Any Specifics?" required>
										<input type="submit" name="enter" value="Enter" class="button">

										<div <?php echo $_SESSION['error'] == $rows['taskno']?"id":"class" ?>="error" >
											Task already in the list!!!
										</div>
									</form>
								</div>
							

							<?php 
								$subResult = $conn->query("SELECT * FROM subtask WHERE mainTask = '".$rows['taskno']."'");

								while ($subRows = $subResult->fetch_assoc()) {
									echo "<hr style='width: 95%;'>";
									if(isset($_GET['main']) && $_GET['main'] == $rows['taskno'] && $_GET['sub'] == $subRows['subtaskno'])
									{
										?>
											<form method="post" action="edit.php?main=<?php echo $rows['taskno'].'&sub='.$subRows['subtaskno']; ?>">
												<input type="textbox" name="task" class="task" style="width: 87%;" value="<?php echo $subRows['name'] ?>" required>
												<input type="submit" name="enter" value="Enter" class="button">
											</form>
										<?php
									} else
									{
										?>
											
											<div class="subTaskBox">
												<div class='task' style="width: 75%;">
													<?php echo $subRows['name'] ?>
												</div>
												<div class='buttonContainer'>
													<a href="complete.php?id=<?php echo $rows['taskno']; ?>" class="button" style="background-color: green;">Done</a>
													<a href="index.php?<?php echo 'main='.$rows['taskno'].'&sub='.$subRows['subtaskno']; ?>" class="button" >Edit</a>
													<a href="complete.php?id=<?php echo $rows['taskno']; ?>" class="button" style="background-color: red;">Delete</a>
												</div>
											</div>
										<?php	
									}
									?>
										
									<?php
								}
							?>
							</div>
							<!--  -->
						</div>
						<?php
							}}
						?>								
		<script>
			function myFunction(elemId)
			{
				var disp = document.getElementById(elemId).style.display; 
				// alert(disp);
				if(disp == "none")
				{
					document.getElementById(elemId).style.display = "block";
				}
				else
				{
					document.getElementById(elemId).style.display = "none";
				}
			}
			function openSubtask()
			{

			}
		</script>
	</body>
</html>
