<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# Database Connection File
	include "db_conn.php";

	# note helper function
	include "php/func-note.php";
    $notes = get_all_notes($conn);

    # teacher helper function
	include "php/func-teacher.php";
    $teachers = get_all_teacher($conn);

    # subject helper function
	include "php/func-subject.php";
    $subjects = get_all_subjects($conn);

	  # subject helper function
	  include "php/func-semester.php";
	  $semesters = get_all_semesters($conn)

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ADMIN</title>

	<style>
        ul.navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        ul.navbar li {
            float: left;
        }

        ul.navbar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul.navbar li a:hover {
            background-color: #111;
        }

        /*table*/
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: skyblue;
        }

        tr:nth-child(even) {
            background-color: lightgray;
        }

        tr:hover {
            background-color: lightgray;
        }
    </style>
</head>
<body>
	<div class="container">
		<nav class="navbar ">
		  <div class="container-sub">
		    <a class="navbar-brand" href="admin.php"><h2>Admin</h2></a>
		    
		    <div class="collapse" >
		      <ul class="navbar">
		        <li class="nav-item">
		          <a class="nav-link" 
		             aria-current="page" 
		             href="index.php">Home</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="add-note.php">Add note</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="add-subject.php">Add subject</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="add-teacher.php">Add teacher</a>
		        </li>
				<li class="nav-item">
		          <a class="nav-link" 
		             href="add-semester.php">Add semester</a>
		        </li>
				<li class="nav-item">
		          <a class="nav-link" 
		             href="admin-feedback.php">Feedback message from user</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="logout.php">Logout</a>
					 
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
      
       
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>


        <?php  if ($notes == 0) { ?>
        	<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			  There is no note in the database
		  </div>
        <?php }else {?>


        <!-- List of all notes -->
		<h4>All notes</h4>
		<table border:"1px";>
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>teacher</th>
					<th>Description</th>
					<th>subject</th>
					<th>Semester</th>
					<th>Action</th>
					
				</tr>
			</thead>
			<tbody>
			  <?php 
			  $i = 0;
			  foreach ($notes as $note) {
			    $i++;
			  ?>
			  <tr>
				<td><?=$i?></td>
				<td>
					<img width="100"
					     src="uploads/cover/<?=$note['cover']?>" >
					<a  class="link-dark d-block
					           text-center"
					    href="uploads/files/<?=$note['file']?>">
					   <?=$note['title']?>	
					</a>
						
				</td>
				<td>
					<?php if ($teachers == 0) {
						echo "Undefined";}else{ 

					    foreach ($teachers as $teacher) {
					    	if ($teacher['id'] == $note['teacher_id']) {
					    		echo $teacher['name'];
					    	}
					    }
					}
					?>

				</td>
				<td><?=$note['description']?></td>
				<td>
					<?php if ($subjects == 0) {
						echo "Undefined";}else{ 

					    foreach ($subjects as $subject) {
					    	if ($subject['id'] == $note['subject_id']) {
					    		echo $subject['name'];
					    	}
					    }
					}
					?>
				</td>
				
				<td>
					<?php if ($semesters == 0) {
						echo "Undefined";}else{ 

					    foreach ($semesters as $semester) {
					    	if ($semester['id'] == $note['semester_id']) {
					    		echo $semester['name'];
					    	}
					    }
					}
					?>

				</td>
				<td>
					<a href="edit-note.php?id=<?=$note['id']?>" 
					   class="btn btn-warning">
					   Edit</a>

					<a href="php/delete-note.php?id=<?=$note['id']?>" 
					   class="btn btn-danger">
				       Delete</a>
				</td>
			  </tr>
			  <?php } ?>
			</tbody>
		</table>
	   <?php }?>


	   <?php  if ($semesters == 0) { ?>
        	<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			  There is no semester in the database
		    </div>
        <?php }else {?>
	    <!-- List of all semesters -->
		<h4 class="mt-5">All semesters</h4>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Semester Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$j = 0;
				foreach ($semesters as $semester ) {
				$j++;	
				?>
				<tr>
					<td><?=$j?></td>
					<td><?=$semester['name']?></td>
					<td>
						<a href="edit-semester.php?id=<?=$semester['id']?>" 
						   class="btn btn-warning">
						   Edit</a>

						<a href="php/delete-semester.php?id=<?=$semester['id']?>" 
						   class="btn btn-danger">
					       Delete</a>
					</td>
				</tr>
			    <?php } ?>
			</tbody>
		</table>
	    <?php } ?>




        <?php  if ($subjects == 0) { ?>
        	<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			  There is no subject in the database
		    </div>
        <?php }else {?>
	    <!-- List of all subjects -->
		<h4 class="mt-5">All subjects</h4>
		<table class="table table-bordered shadow">
			<thead>
				<tr>
					<th>#</th>
					<th>subject Name</th>
				
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$j = 0;
				foreach ($subjects as $subject ) {
				$j++;	
				?>
				<tr>
					<td><?=$j?></td>
					<td><?=$subject['name']?></td>
					
					<td>
						<a href="edit-subject.php?id=<?=$subject['id']?>" 
						   class="btn btn-warning">
						   Edit</a>

						<a href="php/delete-subject.php?id=<?=$subject['id']?>" 
						   class="btn btn-danger">
					       Delete</a>
					</td>
				</tr>
			    <?php } ?>
			</tbody>
		</table>
	    <?php } ?>

	    <?php  if ($teachers == 0) { ?>
        	<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			  There is no teacher in the database
		    </div>
        <?php }else {?>
	    <!-- List of all teachers -->
		<h4 class="mt-5">All teachers</h4>
         <table class="table table-bordered shadow">
			<thead>
				<tr>
					<th>#</th>
					<th>teacher Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$k = 0;
				foreach ($teachers as $teacher ) {
				$k++;	
				?>
				<tr>
					<td><?=$k?></td>
					<td><?=$teacher['name']?></td>
					<td>
						<a href="edit-teacher.php?id=<?=$teacher['id']?>" 
						   class="btn btn-warning">
						   Edit</a>

						<a href="php/delete-teacher.php?id=<?=$teacher['id']?>" 
						   class="btn btn-danger">
					       Delete</a>
					</td>
				</tr>
			    <?php } ?>
			</tbody>
		</table> 
		<?php } ?>
	</div>
</body>
</html>

<?php }else{
  header("Location: login.php");
  exit;
} ?>