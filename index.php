<?php  include('server.php'); ?>

<!-- Edit  -->
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM tasks WHERE id=$id");
		
			$n = mysqli_fetch_array($record);
			$title = $n['title'];
            $description = $n['description'];
            $date = $n['date'];
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>A To-Do App</title>
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body class="container">
<div class="jumbotron">
	<h1><center>A To-Do App</center></h1>
</div>
<?php if (isset($_SESSION['message'])): ?>
	<div class="alert alert-success">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>
	





<form class="form-horizontal" method="post" action="server.php">
<input type="hidden" name="id" value="<?php echo $id; ?>">
  <div class="form-group">
    <label class="control-label col-sm-2" >Title:</label>
    <div class="col-sm-10">
	<input type="text" class="form-control" name="title" required="required" value="<?php echo $title; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" >Description:</label>
    <div class="col-sm-10"> 
	<input type="text" class="form-control" name="description" required="required"  value="<?php echo $description; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" >Date:</label>
    <div class="col-sm-10"> 
	<input type="date" class="form-control" name="date" required="required"  value="<?php echo $date; ?>">
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
			      <?php if ($update == true): ?>
                <button class="btn btn-warning" type="submit" name="update" >Update</button>
            <?php else: ?>
                <button class="btn btn-primary" type="submit" name="save" >Save</button>
            <?php endif ?>
    </div>
  </div>
</form>



    <!-- get all the data from the table-->
    <?php $results = mysqli_query($db, "SELECT * FROM tasks"); ?>


<!--Display data-->

<div class="panel-group ">
    <div class="panel panel-primary">
                <div class="panel-heading" >
                  <h4 class="panel-title">
                    <a data-toggle="collapse" >Task Details</a>
                    </h4>
                </div>
        <div id="collapse1" class="panel-collapse ">
          <div class="panel-body table-responsive ">
              <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Task Name</th>
                        <th>Task Description</th>
                        <th>Task Date</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      
					  <!-- display data row wise -->
					<?php while ($row = mysqli_fetch_array($results)) { ?>
						<tr>
							<td><b><?php echo $row['title']; ?></b></td>
							<td><?php echo $row['description']; ?></td>
							<td><?php echo $row['date']; ?></td>
                            <td>
								<a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-xs" >Edit</a>
						
								<a href="server.php?del=<?php echo $row['id']; ?>" class="btn btn-danger btn-xs">Delete</a>
							</td>
						</tr>
					<?php } ?>
                      

                    </tbody>
              </table>
          </div>
        </div>
    </div>
  </div>

    
</body>
</html>