<?php
include("../../_conn/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['studentID']) && isset($_POST['status'])) {
        $studentid = mysqli_real_escape_string($conn, $_POST['studentID']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        
        $validStatuses = ['pending', 'processing', 'ready', 'claimed'];
        if (in_array($status, $validStatuses)) {
            $updateQuery = "UPDATE ezdrequesttbl SET status='$status' WHERE studentID='$studentid'";
            if (mysqli_query($conn, $updateQuery)) {
                echo "Success";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Invalid status";
        }
    } else {
        echo "ID and status are required";
    }
} else {
    echo "Invalid request method";
}

mysqli_close($conn);
?>
