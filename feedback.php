<?php
session_start();

$isLoggedIn = isset($_SESSION['name']);

# Redirect to login page if not logged in
if (!$isLoggedIn) {
    header("Location: user_login.php");
    exit();
}

# Database Connection File
include "db_conn.php";
?>

<html>
<head>
    <title>Feedback page</title>
    <style>
        body {
            background-color: skyblue;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #63F3E8 ;
        }

        .container h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group .btn {
            margin-top: 10px;
        }


        body{
	font-family: Arial, sans-serif;
  background-color: #D4FEFD;
 

}
.layout {
  width: 1400px;
  height: 768px;
  display: grid;
  grid-template-rows: 1fr;
  /* grid-template-columns: repeat(2, 1fr); */
  grid-template-columns: 4fr 1fr;
  
  gap: 18px;
}
.main_content {
  flex-grow: 1;
  margin-right: 20px;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
  
}

.side_content {
  flex-shrink: 0;
  width: 225px;
  float: right;
  border: 3px solid #ccc;
  list-style-type: none;
  margin: 1px;
  padding: 0;
  background-color: #c0f4f0;
  height: fit-content;
  margin-top: 33px;
}
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

.logout {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.logout .name {
	
  margin-left: 10px;
  align-items: right;
  color: white;
  border: 1px solid #ccc;
  padding: 10px;
}
.card {
  border: 2px solid #000000;
  overflow: hidden;
  width: 18.5rem;
  height: 577px;
  background-color: #eaebed;
  margin-top: 2rem;
  margin-left: 0.5rem;
}
.main-note {
  width: fit-content;
  margin-bottom: 20px;
}
.pdf {
  width: fit-content;
  display: grid;
  grid-template-columns: repeat(3, 1fr);

  gap: 8px;
}
.card-body {
  width: fit-content;
  margin-left: 0.5rem;
}
.pdf-list {
  width: 80%;
  width: 300px;
  height: 200px;
  border: 1px solid black;
}
.category {
  width: 200px;
}
.nd {
  text-decoration: none;
}

.list-group {
  width: 200px;
}
.btn {
  display: inline-block;
  padding: 8px 16px;
  font-size: 14px;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
  border-radius: 9px;
  background-color: #f4fa99;
  color: #000;
  margin-right: 10px;

  

}

.btn:hover {
  background-color: #e8f56d;
}
.custom-heading {
  color: black;
}

//for subject
.subject {
  display: flex;
  justify-content: center;
}

.list-group {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 10px;

}

.list-group a {
  display: block;
  width: 100%;
  padding: 5px;
  margin-bottom: 5px;
  text-align: center;
  text-decoration: none;
  color: #fff;
  background-color: #007bff;
  
}

.list-group a:hover {
  background-color: #0056b3;
}

.custom-heading {
  margin-top: 0;
  margin-bottom: 5px;
  font-size: 20px;
  text-align: center;
}

.abc {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  background-color: black; /* Change background color to black */
}

.menu-bar {
  list-style-type: none;
  padding: 0;
  display: flex;
  margin: 0;
}

.menu-item {
  margin: 0;
  padding: 0;
  margin-right: 20px;
}

.menu-item a {
  text-decoration: none;
  color: white; /* Change text color to white */
  
  padding: 10px 15px;
  border-radius: 5px;
  transition: background-color 0.3s;
}

.menu-item a:hover {
  background-color: #555; /* Darker background color on hover */
}

.sub-menu {
  list-style-type: none;
  margin: 0;
  padding: 0;
  position: absolute;
  display: none;
  background-color: #444; /* Darker background color for sub-menu */
  border-radius: 5px;
}

.menu-item:hover .sub-menu {
  display: block;
}

.sub-menu-item {
  margin: 0;
  padding: 0;
}

.sub-menu-item a {
  text-decoration: none;
  color: white; /* Change text color to white */
  display: block;
  padding: 5px 15px;
  transition: background-color 0.3s;
}

.sub-menu-item a:hover {
  background-color: #555; /* Darker background color on hover */
}

.btn-container {
    display: flex;
    gap: 10px; /* Adjust the gap as needed */
}

.btn {
    text-decoration: none;
    padding: 10px 20px;
    border: 1px solid #ccc;
    background-color: #F4FA99;
    color: #000;
    border-radius: 5px;
    display: inline-block;
}

    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <nav class="navbar">
            <ul class="navbar">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="feedback.php">Feedback</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="logout">
                    <a href="user_logout.php">Logout</a>
                   
                </li>
            </ul>
        </nav>
    </div>
</div>

<div class="container">
   
    <div class="container">
        <h3>Submit feedback</h3>
        <form action="message.php" method="POST">
        <div class="main">
            <h1>Contact Us:</h1>
            <form action="message.php" method="post">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Your Name">
                </div>
                
                <div class="form-group">
                    <input type="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <textarea name="comment" placeholder="Your Message" id="" cols="35" rows="10"></textarea>
                </div>
                <input type="submit" value="Submit" name="submit">
            </form>
           
        </div>
        </form>
    </div>
</div>
</body>
</html>
