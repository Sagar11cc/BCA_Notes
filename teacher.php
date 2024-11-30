<?php 
session_start();
$isLoggedIn = isset($_SESSION['name']);


# If not teacher ID is set
if (!isset($_GET['id'])) {
	header("Location: index.php");
	exit;
}

# Get teacher ID from GET request
$id = $_GET['id'];

# Database Connection File
include "db_conn.php";

# note helper function
include "php/func-note.php";
$notes = get_notes_by_teacher($conn, $id);

# teacher helper function
include "php/func-teacher.php";
$teachers = get_all_teacher($conn);
$current_teacher = get_teacher($conn, $id);


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
	<title><?=$current_teacher['name']?></title>

    
	<style>
	
body{
	font-family: Arial, sans-serif;
  background-color: #D4FEFD;
 

}
.layout {
  width: 1200px;
  height: 768px;
  display: grid;
  grid-template-rows: 1fr;
  grid-template-columns: repeat(2, 1fr);
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



	</style>
  

</head>
<body>
	<div class="container">
		<nav class="navbar">
		
		   
		    
		    <div class="collapse " 
		         id="navbarSupportedContent">
		      <ul class="navbar">
		        <li class="nav-item">
		          <a class="nav-link active" 
		             aria-current="page" 
		             href="index.php">Home</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="#">Contact</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="#">About</a>
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
		    
		    </div>
		</nav>

		<div class="side_content">
			                        

											 <!-- List of subjects -->
											 <div class="list-group">
			 	       <?php if ($subjects == 0){
					   // do nothing
				       }else{ ?>
				       <a href="#"
				       class="list-group">Subject</a>
				       <?php foreach ($subjects as $subject ) {?>
				      
				       <a href="subject.php?id=<?=$subject['id']?>"
				       class="list-group">
				      <?=$subject['name']?></a>
				<?php } } ?>
			</div>


			                                   <!-- List of teachers -->
			                                    <div class="list-group mt-5">
				                                  <?php if ($teachers == 0){
					                              // do nothing
													}else{ ?>
													<a href="#"
													class="list-group-item list-group-item-action active">teacher</a>
													<?php foreach ($teachers as $teacher ) {?>
													
													<a href="teacher.php?id=<?=$teacher['id']?>"
														class="list-group-item list-group-item-action">
														<?=$teacher['name']?></a>
														<?php } } ?>
												</div>	
	     </div>
		              <h1 class="display"> 
		            	<a href="index.php" class="nd">
				        <img src="img/back-arrow.PNG" width="35">
			            </a>
		                <?=$current_teacher['name']?>
		               </h1>
		            <div class="d-flex ">
			            <?php if ($notes == 0){ ?>
				        <div class="alert alert-warning text-center p-5" role="alert">
        	                 <img src="img/empty.png" width="300" height="300">
        	                <br>
			                There is no note in the database
		                </div>
			                <?php }else{ ?>
			                <div class="pdf">
				               <?php foreach ($notes as $note) { ?>
				                <div class="card m-1">
									<img src="uploads/cover/<?=$note['cover']?>" class="card-img-top" width="300" height="300">
					                <div class="card-body">
									<h5 class="card-title">
							
									<?=$note['title']?>
						
								
					            	<p class="card-text">
							         <i><b>By:
								      <?php foreach($teachers as $teacher){ 
									
									  if ($teacher['id'] == $note['teacher_id']) {
										echo $teacher['name'];
										break;
									}
								    ?>

								    <?php } ?>
							        <br></b></i>Description:-
							        <?=$note['description']?>
							        <br><i><b>Subject:
								    <?php foreach($subjects as $subject){ 
									if ($subject['id'] == $note['subject_id']) {
										echo $subject['name'];
										break;
									}
								    ?>

								    <?php } ?>
							        <br></b></i>
						            </p>
                                    <a href="uploads/files/<?=$note['file']?>" class="btn btn-success">Open</a>

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
				                     <?php } ?>
			            
		                             <?php } ?>

									
    </div>
	            	
	
</body>
</html>