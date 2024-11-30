
   <?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# Database Connection File
	include "db_conn.php";

    # subject helper function
	include "php/func-subject.php";
    $subjects = get_all_subjects($conn);

    # teacher helper function
	include "php/func-teacher.php";
    $teachers = get_all_teacher($conn);

	# semester helper function
	include "php/func-semester.php";
	$semesters = get_all_semesters($conn);
	

    if (isset($_GET['title'])) {
    	$title = $_GET['title'];
    }else $title = '';

    if (isset($_GET['desc'])) {
    	$desc = $_GET['desc'];
    }else $desc = '';

    if (isset($_GET['subject_id'])) {
    	$subject_id = $_GET['subject_id'];
    }else $subject_id = 0;

    if (isset($_GET['teacher_id'])) {
    	$teacher_id = $_GET['teacher_id'];
    }else $teacher_id = 0;

	if (isset($_GET['semester_id'])) {
    	$semester_id = $_GET['semester_id'];
    }else $semester_id = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add note</title>

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
	.form-label {
  font-weight: bold;
}

.form-control {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
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

.btn-primary {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
}

.btn-primary:hover {
  background-color: #0069d9;
}

	}
	</style>
</head>
<body>
	<div class="container">
		<nav class="navbar ">
		  <div class="container">
		    <a class="navbar" href="admin.php"><h2>Admin</h2></a>
		  
		    <div class="collapse " 
		         id="navbarSupportedContent">
		      <ul class="navbar">
		        <li class="nav-item">
		          <a class="nav-link" 
		             aria-current="page" 
		             href="index.php">Store</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active" 
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
		             href="logout.php">Logout</a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
     <form action="php/add-note.php" method="post" enctype="multipart/form-data">

     	<h1>
     		Add New note
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
		                note Title
		                </label>
						<input type="text" 
						class="form-control"
						value="<?=$title?>" 
						name="note_title">
		            </div>

					<div class="mb-3">
						<label class="form-label">
							Note Description
							</label>
						<input type="text" 
							class="form-control" 
							value="<?=$desc?>"
							name="note_description">
					</div>
	
					<div class="mb-3">
    <label class="form-label">Note semester</label>
    <select name="note_semester" class="form-control">
        <option value="0">Select semester</option>
        <?php
        if ($semesters == 0) {
            # Do nothing!
        } else {
            foreach ($semesters as $semester) {
                if ($semester_id == $semester['id']) {
                    echo '<option selected value="' . $semester['id'] . '">' . $semester['name'] . '</option>';
                } else {
                    echo '<option value="' . $semester['id'] . '">' . $semester['name'] . '</option>';
                }
            }
        }
        ?>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Note subject</label>
    <select name="note_subject" class="form-control">
        <option value="0">Select subject</option>
        <?php
        if ($subjects == 0) {
            # Do nothing!
        } else {
            foreach ($subjects as $subject) {
                if ($subject_id == $subject['id']) {
                    echo '<option selected value="' . $subject['id'] . '">' . $subject['name'] . '</option>';
                } else {
                    echo '<option value="' . $subject['id'] . '">' . $subject['name'] . '</option>';
                }
            }
        }
        ?>
    </select>
</div>

<!-- Additional JavaScript code -->
<script>
    const semesterSelect = document.querySelector('select[name="note_semester"]');
    const subjectSelect = document.querySelector('select[name="note_subject"]');
    const subjects = <?php echo json_encode($subjects); ?>;

    semesterSelect.addEventListener('change', function() {
        const selectedSemester = this.value;
        subjectSelect.innerHTML = '<option value="0">Select subject</option>';
        subjects.forEach(function(subject) {
            if (subject.semester_id == selectedSemester) {
                const option = document.createElement('option');
                option.value = subject.id;
                option.textContent = subject.name;
                subjectSelect.appendChild(option);
            }
        });
    });
</script>

<div class="mb-3">
						<label class="form-label">
							note teacher
							</label>
						<select name="note_teacher"
								class="form-control">
								<option value="0">
									Select teacher
								</option>
								<?php 
								if ($teachers == 0) {
									# Do nothing!
								}else{
								foreach ($teachers as $teacher) { 
									if ($teacher_id == $teacher['id']) { ?>
									<option 
									selected
									value="<?=$teacher['id']?>">
									<?=$teacher['name']?>
									</option>
									<?php }else{ ?>
									<option 
										value="<?=$teacher['id']?>">
										<?=$teacher['name']?>
									</option>
							<?php }} } ?>
						</select>
					</div>
				</div>


						<div class="mb-3">
							<label class="form-label">
								note Cover
								</label>
							<input type="file" 
								class="form-control" 
								name="note_cover">
						</div>

						<div class="mb-3">
							<label class="form-label">
								File
								</label>
							<input type="file" 
								class="form-control" 
								name="file">
						</div>

						<button type="submit" 
								class="btn btn-primary">
								Add note</button>
    </form>
	</div>
</body>
</html>

<?php }else{
  header("Location: login.php");
  exit;
} ?>