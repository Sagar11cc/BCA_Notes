<?php
require "db_conn_user.php";

if (isset($_GET['id'])) {
    $messageId = $_GET['id'];

    // Delete the message from the database
    $query = "DELETE FROM messages WHERE m_id = '$messageId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Output a JavaScript script to reload the page after a short delay
        echo '<script>';
        echo 'setTimeout(function(){ window.location.href = "admin-feedback.php?success=1"; }, 1000);'; // Redirect back to admin-feedback.php with success message after 1 second
        echo '</script>';
    } else {
        echo "Error deleting message: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
