<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

      	# Database Connection File
	include "db_conn.php";
      	# semester helper function
	include "php/func-semester.php";
	$semesters = get_all_semesters($conn);


  if (isset($_GET['semester_id'])) {
    $semester_id = $_GET['semester_id'];
  }else $semester_id = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add subject</title>

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

	.shadow {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.text-center {
  text-align: center;
}

.alert {
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 4px;
}

.alert-danger {
  background-color: #f8d7da;
  border-color: #f5c6cb;
  color: #721c24;
}

.alert-success {
  background-color: #d4edda;
  border-color: #c3e6cb;
  color: #155724;
}

.form-label {
  font-weight: bold;
}

.form-control {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.btn {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
}

.btn:hover {
  background-color: #0069d9;
}

	</style>

</head>
<body>
	<div class="container" >
		<nav class="navbar ">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="admin.php"><h2>Admin</h2></a>
           
		    <div class="collapse " 
		         id="navbarSupportedContent">
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
		          <a class="nav-link active" 
		             href="add-subject.php">Add subject</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="add-teacher.php">Add teacher</a>
					 <li class="nav-item">
		          <a class="nav-link" 
		             href="add-semester.php">Add semester</a>
		        </li>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="logout.php">Logout</a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
     <form action="php/add-subject.php"
           method="post" 
           class="shadow">

     	<h1 class="text-center">
     		Add New subject
     	</h1>
     	<?php if (isset($_GET['error'])) { ?>
          <div class="alert" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>
     	<div class="mb-3">
		    <label class="form-label">
		           	subject Name
		           </label>
		    <input type="text" 
		           class="form-control" 
		           name="subject_name">
		</div>

	    <button type="submit" 
	            class="btn ">
	            Add subject</button>

              <div class="mb-3">
  <label class="form-label">
    Select Semester
  </label>
  <select name="semester_id" class="form-control">
    <option value="0">Select semester</option>
    <?php 
    // Fetch the list of semesters from the database
    $stmt = $conn->query("SELECT * FROM semesters");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $semesterId = $row['id'];
      $semesterName = $row['name'];
      echo "<option value=\"$semesterId\">$semesterName</option>";
    }
    ?>
  </select>
</div>


     </form>
	</div>
</body>
</html>

<?php }else{
  header("Location: login.php");
  exit;
} ?>