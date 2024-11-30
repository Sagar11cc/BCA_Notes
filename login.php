<?php  
session_start();

# If the admin is logged in
if (!isset($_SESSION['user_id']) &&
    !isset($_SESSION['user_email'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LOGIN</title>
<style>
	body {
    font-family: Arial, sans-serif;
    background-color: skyblue;
    margin: 0;
    padding: 0;
}

.d-flex {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

form {
    width: 300px;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
}

h1 {
    text-align: center;
}

.alert {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #f5c6cb;
    border-radius: 5px;
}

.form-label {
    margin-bottom: 5px;
}

.form-control {
    width: 95%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.btn-primary {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

a {
    display: block;
    text-align: center;
    margin-top: 10px;
    text-decoration: none;
    color: #777;
}

	</style>
    
</head>
<body>
	<div class="d-flex">
		<form class="p-5" method="POST" action="php/auth.php">

		  <h1 class="text-center">LOGIN</h1>
		  <?php if (isset($_GET['error'])) { ?>
          <div class="alert" >
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		  <?php } ?>

		  <div class="mb-3">
		    <label for="exampleInputEmail1" 
		           class="form-label">Email address</label>
		    <input type="email" 
		           class="form-control" 
		           name="email" 
		           id="exampleInputEmail1" 
		           aria-describedby="emailHelp">
		  </div>

		  <div class="mb-3">
		    <label for="exampleInputPassword1" 
		           class="form-label">Password</label>
		    <input type="password" 
		           class="form-control" 
		           name="password" 
		           id="exampleInputPassword1">
		  </div>
		  <button type="submit" 
		          class="btn btn-primary">
		          Login</button>
		   <a href="index.php">Online notes main page</a>
		</form>
	</div>
</body>
</html>

<?php }else{
  header("Location: admin.php");
  exit;
} ?>