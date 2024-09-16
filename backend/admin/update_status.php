<?php
include("../../_conn/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['status'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        
        $validStatuses = ['pending', 'processing', 'ready', 'claimed'];
        if (in_array($status, $validStatuses)) {
            $updateQuery = "UPDATE ezdrequesttbl SET status='$status' WHERE id='$id'";
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