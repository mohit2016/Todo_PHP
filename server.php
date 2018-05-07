<?php 
	session_start();
	// database connection call
	$db = mysqli_connect('localhost', 'root', '', 'crud');
	
	// initialize variables
	$title = "";
	$description = "";
	$id = 0;
	$update = false;
	
	// Create the task and insert into table
	if (isset($_POST['save'])) {
		$title = $_POST['title'];
		$description = $_POST['description'];
		$date = $_POST['date'];
		
		mysqli_query($db, "INSERT INTO tasks (title, description,date) VALUES ('$title', '$description','$date')"); 
		$_SESSION['message'] = "Task saved"; 
		header('location: index.php');
	}
	//Update the task from table
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$date = $_POST['date'];

		mysqli_query($db, "UPDATE tasks SET title='$title', description='$description', date='$date' WHERE id=$id");
		$_SESSION['message'] = "Task updated!"; 
		header('location: index.php');
	}
	
	// Delete task from table
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		
		mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
		$_SESSION['message'] = "Task deleted!"; 
		header('location: index.php');
	}