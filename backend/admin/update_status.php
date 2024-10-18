<?php
include("../../_conn/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['status'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        
        $validStatuses = ['pending', 'processing', 'ready', 'claimed'];
        if (in_array($status, $validStatuses)) {
            $updateQuery = "UPDATE ezdrequesttbl SET status=? WHERE id=?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("si", $status, $id);
            $result = $stmt->execute();
            if ($result === true) {
                echo "Success";
            } else {
                echo "Error: " . $conn->error;
            }
            $stmt->close();
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

<?php
try {
    $id = $_POST['id'];
    $status = $_POST['status'];

    function moveClaimedDocument($id) {
        // Insert claimed document into claimed history table
        $claimedQuery = "INSERT INTO requesthistory (id, fullName, gradelvl, reqDoc, reqDate, claimDate) 
                        SELECT id, fullName, gradelvl, reqDoc, reqDate, reqDate + INTERVAL 7 DAY FROM ezdrequesttbl WHERE id=?";
        $claimedStmt = $conn->prepare($claimedQuery);
        $claimedStmt->bind_param("i", $id);
        if (!$claimedStmt->execute()) {
            echo "Error inserting claimed document: " . $conn->error;
        }
    }

    if ($status == 'claimed') {
        moveClaimedDocument($id);
        // Update request status to 'claimed'
        $updateQuery = "UPDATE ezdrequesttbl SET status='claimed' WHERE id=?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("i", $id);
        if (!$updateStmt->execute()) {
            echo "Error updating request status: " . $conn->error;
        }
    }

    mysqli_close($conn);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>