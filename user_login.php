<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>/* style.css */

body {
  font-family: Arial, sans-serif;
  background-color: skyblue;
  padding: 20px;
}

form {
  max-width: 400px;
  margin: 0 auto;
  background-color: gray;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

.error {
  color: red;
  margin-bottom: 10px;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
  
}

input[type="text"],
input[type="password"] {
  width: 95%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: lightgray;
}

button[type="submit"] {
  background-color: #4caf50;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

a.ca {
  display: block;
  text-align: center;
  margin-top: 10px;
}
</style>
</head>
<body>
     <form action="user_login_php.php" method="post">
     	<h2>LOGIN</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>User Name</label>
     	<input type="text" name="uname" placeholder="User Name"><br>

     	<label>Password</label>
     	<input type="password" name="password" placeholder="Password"><br>

     	<button type="submit">Login</button>
          <a href="user_signup.php" class="ca">Create an account</a>
          <a href="index.php" class="ca">Online notes main page</a>
     </form>
</body>
</html>