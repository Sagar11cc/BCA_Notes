<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

    # If note ID is not set
    if (!isset($_GET['id'])) {
        #Redirect to admin.php page
        header("Location: admin.php");
        exit;
    }

    $id = $_GET['id'];

    # Database Connection File
    include "db_conn.php";

    # note helper function
    include "php/func-note.php";
    $note = get_note($conn, $id);

    # If the ID is invalid
    if ($note == 0) {
        #Redirect to admin.php page
        header("Location: admin.php");
        exit;
    }

    # subject helper function
    include "php/func-subject.php";
    $subjects = get_all_subjects($conn);

    # teacher helper function
    include "php/func-teacher.php";
    $teachers = get_all_teacher($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit note</title>
	<style>
		/* Reset some default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

nav {
    margin-bottom: 20px;
}

nav a {
    text-decoration: none;
    color: #333;
    margin-right: 10px;
}

form {
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
}

form h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
select,
button,
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

select {
    appearance: none;
    -webkit-appearance: none;
    background: url('down-arrow.png') no-repeat right center;
    background-size: 20px;
}

.link-dark {
    color: #333;
    text-decoration: none;
    margin-left: 10px;
}

button {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    padding: 10px 20px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

div {
    margin-bottom: 15px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container {
        padding: 10px;
    }
}

		</style>
</head>
<body>
    <div class="container">
        <nav>
            <a href="admin.php">Admin</a>
            <a href="index.php">Home</a>
            <a href="add-note.php">Add note</a>
            <a href="add-subject.php">Add subject</a>
            <a href="add-teacher.php">Add teacher</a>
            <a href="logout.php">Logout</a>
        </nav>
        <form action="php/edit-note.php"
            method="post"
            enctype="multipart/form-data">

            <h1>Edit note</h1>
            <?php if (isset($_GET['error'])) { ?>
                <div>
                    <?=htmlspecialchars($_GET['error']); ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <div>
                    <?=htmlspecialchars($_GET['success']); ?>
                </div>
            <?php } ?>
            <div>
                <label>
                    note Title
                </label>
                <input type="text" 
                    hidden
                    value="<?=$note['id']?>" 
                    name="note_id">

                <input type="text" 
                    value="<?=$note['title']?>" 
                    name="note_title">
            </div>

            <div>
                <label>
                    note Description
                </label>
                <input type="text" 
                    value="<?=$note['description']?>"
                    name="note_description">
            </div>

            <div>
                <label>
                    note teacher
                </label>
                <select name="note_teacher">
                    <option value="0">
                        Select teacher
                    </option>
                    <?php 
                    if ($teachers == 0) {
                        # Do nothing!
                    }else{
                    foreach ($teachers as $teacher) { 
                        if ($note['teacher_id'] == $teacher['id']) { ?>
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

            <div>
                <label>
                    note subject
                </label>
                <select name="note_subject">
                    <option value="0">
                        Select subject
                    </option>
                    <?php 
                    if ($subjects == 0) {
                        # Do nothing!
                    }else{
                    foreach ($subjects as $subject) { 
                        if ($note['subject_id'] == $subject['id']) { ?>
                        <option 
                            selected
                            value="<?=$subject['id']?>">
                            <?=$subject['name']?>
                        </option>
                        <?php }else{ ?>
                        <option 
                            value="<?=$subject['id']?>">
                            <?=$subject['name']?>
                        </option>
                   <?php }} } ?>
                </select>
            </div>

            <div>
                <label>
                    note Cover
                </label>
                <input type="file" 
                    name="note_cover">

                <input type="text" 
                    hidden
                    value="<?=$note['cover']?>" 
                    name="current_cover">

                <a href="uploads/cover/<?=$note['cover']?>"
                class="link-dark">Current Cover</a>
            </div>

            <div>
                <label>
                    File
                </label>
                <input type="file" 
                    name="file">

                <input type="text" 
                    hidden
                    value="<?=$note['file']?>" 
                    name="current_file">

                <a href="uploads/files/<?=$note['file']?>"
                class="link-dark">Current File</a>
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>

<?php }else{
  header("Location: login.php");
  exit;
} ?>
