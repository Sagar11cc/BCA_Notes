<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add teacher</title>
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
		<nav class="navbar">
		  <div class="container">
		    <a class="navbar" href="admin.php"><h2>Home</h2></a>
		    
		    <div class="collapse" 
		         id="navbar">
		      <ul class="navbar">
		        <li class="nav-item">
		          <a class="nav-link" 
		             aria-current="page" 
		             href="index.php">Store</a>
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
		          <a class="nav-link active" 
		             href="add-teacher.php">Add teacher</a>
		        </li>
				<li class="nav-item">
		          <a class="nav-link" 
		             href="add-semester.php">Add semester</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="logout.php">Logout</a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
     <form action="php/add-teacher.php"
           method="post" 
           class="shadow"
           style="width: 90%; max-width: 50rem;">

     	<h1 class="text">
     		Add New teacher
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
		           	Teacher Name
		           </label>
		    <input type="text" 
		           class="form-control" 
		           name="teacher_name">
		</div>

	    <button type="submit" 
	            class="btn btn-primary">
	            Add teacher</button>
     </form>
	</div>
</body>
</html>

<?php }else{
  header("Location: login.php");
  exit;
} ?>