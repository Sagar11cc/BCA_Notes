<?php
session_start();

$isLoggedIn = isset($_SESSION['name']);


	# Database Connection File
	include "db_conn.php";

	# notes helper function
	include "php/func-note.php";
	$notes = get_all_notes($conn);

	# teacher helper function
	include "php/func-teacher.php";
	$teachers = get_all_teacher($conn);

	# subject helper function
	include "php/func-subject.php";
	$subjects = get_all_subjects($conn);

	# semester helper function
	include "php/func-semester.php";
	$semesters = get_all_semesters($conn);

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>note Store</title>
		<link rel="stylesheet" href="css/test.css?=1">


		<!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
<style>
	/* * {
  border: 1px solid red;
} */

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
                <?php if ($isLoggedIn): ?>
                    <li class="logout">
                        <a href="user_logout.php">Logout</a>
                        <span class="name">Welcome <?php echo $_SESSION['name']; ?></span>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="user_login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>

			
            
        </nav>
    </div>
</div>

<style>
    .menu-item span,
    .sub-menu-item a {
        color: white;
    }
</style>

<div class="abc">
    <?php
    if ($semesters == 0) {
        // do nothing
    } else {
        echo '<ul class="menu-bar">';
        foreach ($semesters as $semester) {
            echo '<li class="menu-item">';
            echo '<span>' . $semester['name'] . '</span>'; // Changed from <a> to <span>

            // Display associated subjects
            $associatedSubjects = array_filter($subjects, function ($subject) use ($semester) {
                return $subject['semester_id'] == $semester['id'];
            });

            if (!empty($associatedSubjects)) {
                echo '<ul class="sub-menu">';
                foreach ($associatedSubjects as $subject) {
                    echo '<li class="sub-menu-item">';
                    echo '<a href="subject.php?id=' . $subject['id'] . '">' . $subject['name'] . '</a>';
                    echo '</li>';
                }
                echo '</ul>';
            }

            echo '</li>';
        }
        echo '</ul>';
    }
    ?>
</div>



		<section class="layout">
			<div class="main_content">

				<?php if ($notes == 0) { ?>
					<div class="alert" role="alert">
						<img src="img/empty.png" width="100">
						<br>
						There is no note in the database
					</div>
				<?php } else { ?>


					<div class="pdf">
						<?php foreach ($notes as $note) { ?>
							<div class="main-note">
								<div class="card">
									<img src="uploads/cover/<?= $note['cover'] ?>" class="card-img-top" width="300" height="300">
									<div class="card-body">
										<h3 class="card-title">
											Title:
											<?= $note['title'] ?>
										</h3>
										<p class="card-details">
											Teacher:
											<?php foreach ($teachers as $teacher) {
												if ($teacher['id'] == $note['teacher_id']) {
													echo $teacher['name'];
													break;
												}
											?>
											<?php } ?>
											<br>

											Semester:
											<?php foreach ($semesters as $semester) {
												if ($semester['id'] == $note['semester_id']) {
													echo $semester['name'];
													break;
												}
											?>
											<?php } ?>




											<br>Description:
											<?= $note['description'] ?><br>
											subject:
											<?php foreach ($subjects as $subject) {
												if ($subject['id'] == $note['subject_id']) {
													echo $subject['name'];
													break;
												}
											?>
											<?php } ?>
											
							
										</p>
                    <div class="btn-container">
    <?php if ($isLoggedIn): ?>
      <a href="uploads/files/<?=$note['file']?>#toolbar=0" class="btn" target="_blank">
    <span style="background-color: #F4FA99;">Open</span>
</a>

    <?php else: ?>
        <a href="user_login.php" class="btn">
            <span style="background-color: #F4FA99;">Login to View</span>
        </a>
    <?php endif; ?>

    <?php if ($isLoggedIn): ?>
        <a href="uploads/files/<?=$note['file']?>" class="btn" download="<?=$note['title']?>">
            <span style="background-color: #F4FA99;">Download</span>
        </a>
    <?php else: ?>
        <a href="user_login.php" class="btn">
            <span style="background-color: #F4FA99;">Login to Download</span>
        </a>
    <?php endif; ?>
</div>

									</div>
								</div>
							</div>
						<?php } ?>
					</div>
			</div>
								<div class="side_content">
							




									<!-- List of subjects -->
									
										<div class="list-group">
											<?php if ($subjects == 0) {
												// do nothing
											} else { ?>
												<a href="#" class="list-group">
													<h3 class="custom-heading">Subjects</h3>
												</a>
												<?php foreach ($subjects as $subject) { ?>

													<a href="subject.php?id=<?= $subject['id'] ?>" class="list-group">
														<?= $subject['name'] ?></a>
											<?php }
											} ?>
										</div>

										
											<!-- List of teachers -->
											<div class="list-group">
												
												<hr>
												<?php if ($teachers == 0) {
													// do nothing
												} else { ?>
													<a href="#" class="list-group">
														<h3 class="custom-heading">Teacher List</h3>
													</a>
													<?php foreach ($teachers as $teacher) { ?>

														<a href="teacher.php?id=<?= $teacher['id'] ?>" class="list-group">
															<?= $teacher['name'] ?></a>
												<?php }
												} ?>
												
											</div>


									</div>
									
								</div>
								 <?php } ?>
 

	</div>
	</body>

	</html>

