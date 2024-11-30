<?php
include 'db_conn_user.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['comment']);

    $sql = "INSERT INTO messages (name,email,message) 
    VALUES('$name','$email','$message')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<script>alert("Message Sent Successfully")</script>';
        header("location:index.php");
    } else {
        echo "<script>alert('Message Not Sent')</script>";
    }

}