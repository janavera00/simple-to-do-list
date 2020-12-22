<?php
	session_start();

	if(!$_GET)
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

				// display all the task ang subtask
				while ($rows = $result->fetch_assoc()) 
				{
					// display task box
					if($rows['status'] == 0)
					{ ?>
						<div class='taskBox'>
							<a onclick="myFunction(<?php echo $rows['taskno']; ?>)" style="color: white;" id="<?php echo $rows['taskno']; ?>">
								<div class='task'>
									<?php echo $rows['name'] ?>
								</div>
							</a>
							<div class='buttonContainer'>
								<a href="complete.php?id=<?php echo $rows['taskno']; ?>" class="button" style="background-color: green;">Done</a>
								<a href="complete.php?id=<?php echo $rows['taskno']; ?>" class="button" >Edit</a>
								<a href="complete.php?id=<?php echo $rows['taskno']; ?>" class="button" style="background-color: red;">Delete</a>
							</div>

							<hr style="width: 95%;">
							<div class="subTaskBox">
								<form method="post" action="add.php?main=<?php echo $rows['taskno']; ?>">
									<input type="textbox" name="task" class="task" style="width: 90%;" placeholder="Any Specifics?" required>
									<input type="submit" name="enter" value="Enter" class="button">

									<div <?php echo $_SESSION['error'] == $rows['taskno']?"id":"class" ?>="error" >
										Task already in the list!!!
									</div>
								</form>
								<!-- <div class='task' style="width: 79%;">
									<?php echo $rows['name'] ?>
								</div>
								<div class='buttonContainer'>
									<a href="complete.php?id=<?php echo $rows['taskno']; ?>" class="button" style="background-color: green;">Done</a>
									<a href="complete.php?id=<?php echo $rows['taskno']; ?>" class="button" >Edit</a>
									<a href="complete.php?id=<?php echo $rows['taskno']; ?>" class="button" style="background-color: red;">Delete</a>
								</div> -->
							</div>

							<?php 
								$subResult = $conn->query("SELECT * FROM subtask WHERE mainTask = '".$rows['taskno']."'");

								while ($subRows = $subResult->fetch_assoc()) {
									?>
										<hr style="width: 95%;">
										<div class="subTaskBox">
											<div class='task' style="width: 79%;">
												<?php echo $subRows['name'] ?>
											</div>
											<div class='buttonContainer'>
												<a href="complete.php?id=<?php echo $rows['taskno']; ?>" class="button" style="background-color: green;">Done</a>
												<a href="complete.php?id=<?php echo $rows['taskno']; ?>" class="button" >Edit</a>
												<a href="complete.php?id=<?php echo $rows['taskno']; ?>" class="button" style="background-color: red;">Delete</a>
											</div>
										</div>
									<?php
								}
							?>
							<!--  -->
						</div>
						<?php
							}}
						?>								
		<script>
			function myFunction(elemId)
			{
				// var elemId = "";
				// alert(elemId);
				document.getElementById(elemId).style.display = "none"; 
			}
			function openSubtask()
			{

			}
		</script>
	</body>
</html>
