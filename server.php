<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'crud');

	// initialize variables
	$title = "";
	$description = "";
	$id = 0;
	$update = false;

	// Create
	if (isset($_POST['save'])) {
		$title = $_POST['title'];
		$description = $_POST['description'];

		mysqli_query($db, "INSERT INTO info (title, description) VALUES ('$title', '$description')"); 
		$_SESSION['message'] = "Task saved"; 
		header('location: index.php');
	}

	//Update 
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$title = $_POST['title'];
		$description = $_POST['description'];
	
		mysqli_query($db, "UPDATE info SET title='$title', description='$description' WHERE id=$id");
		$_SESSION['message'] = "Task updated!"; 
		header('location: index.php');
	}
	
	// Delete
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM info WHERE id=$id");
		$_SESSION['message'] = "Task deleted!"; 
		header('location: index.php');
	}