<?php

require "db_conn_user.php";
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  <style>
   * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
}

body {
    font-size: 16px;
    background-color: skyblue;
    color: white;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.main {
    display: grid;
    justify-content: center;
    padding: 30px;
}

.top {
    text-align: center;
    margin-bottom: 20px;
}

.top h1 {
    font-size: 2.5rem;
    color: #61c232;
}

.content {
    margin: 0 auto;
}

.btn-back {
    display: inline-block;
    padding: 8px 20px;
    border: none;
    border-radius: 5px;
    background-color: #61c232;
    color: black;
    text-decoration: none;
    font-weight: 600;
    margin-bottom: 20px;
}

.btn-back:hover {
    background-color: #45811e;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    color: white;
}

th,
td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #444;
}

th {
    background-color: #61c232;
}

td {
    background-color: #444;
}

a {
    color: black;
    text-decoration: none;
}

a:hover {
    color: white;
    text-decoration: underline;
}


.btn-btn-delete {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    background-color: #d9534f;
    color: white;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s;
}

.btn-btn-delete:hover {
    background-color: #c9302c;
}

    </style>
</head>
<body>

    <div class="container">
        <div class="main">
            <div class="top">
               
                    <h1>Messages from user</h1>
                   
            </div>
            <div class="content">
                <button class="btn-back"><a href="admin.php">Admin</a></button>
                <table border="1px solid black">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        
                        <th>Email</th>
                        <th>Messages</th>
                        <th>Options</th>
                    </tr>
                    <?php
                    $query = 'SELECT * FROM messages';
                    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

                    while ($row = mysqli_fetch_assoc($result)) {

                        echo '<tr>';
                        echo '<td>' . $row['m_id'] . '</td>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['message'] . '</td>';
                        echo ' <td><a  type="button" class="btn-btn-delete" href="deletemessage.php?type=people&delete & 
                        id=' . $row['m_id'] . '">DELETE </a> </td>';
                        echo '</tr> ';
                    }
                    ?>

            </div>
        </div>
    </div>

</body>

</html>