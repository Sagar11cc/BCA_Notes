
<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
    
    # If subject ID is not set
	if (!isset($_GET['id'])) {
		#Redirect to admin.php page
        header("Location: admin.php");
        exit;
	}

	$id = $_GET['id'];

	# Database Connection File
	include "db_conn.php";

    # subject helper function
	include "php/func-subject.php";
    $subject = get_subject($conn, $id);
    
    # If the ID is invalid
    if ($subject == 0) {
    	#Redirect to admin.php page
        header("Location: admin.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit subject</title>
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
	
        </style>

</head>
<body>
	<div class="container">
		<nav class="navbar ">
		  <div class="container">
		    <a class="navbar" href="admin.php">Admin</a>
		    
		    <div class="collapse " 
		         id="navbar">
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
		             href="logout.php">Logout</a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
     <form action="php/edit-subject.php"
           method="post" 
           class="shadow">

     	<h1>
     		Edit subject
     	</h1>
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
     	<div class="mb-3">
		    <label class="form-label">
		           	subject Name
		           </label>

		     <input type="text" 
		            value="<?=$subject['id'] ?>" 
		            hidden
		            name="subject_id">


		    <input type="text" 
		           class="form-control"
		           value="<?=$subject['name'] ?>" 
		           name="subject_name">
		</div>

	    <button type="submit" 
	            class="btn btn-primary">
	            Update</button>
     </form>
	</div>
</body>
</html>

<?php }else{
  header("Location: login.php");
  exit;
} ?>
