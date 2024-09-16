<?php
$errorMessage = "";
try {
    session_start();
    include("../_conn/connection.php");

    if (isset($_POST['btnClaim'])) {
        $studentid = $_SESSION['studentId'];
        $studentname = $_SESSION['fullName'];
        $docid = $_POST['id'];
        $claimDate = $_POST['claimDate'];

        mysqli_autocommit($conn, FALSE);

        // Update the status of the document
        $updateStatusSql = "UPDATE request_tbl SET status='claimed' WHERE id='$docid'";
        if (!mysqli_query($conn, $updateStatusSql)) {
            throw new Exception('Error updating status: ' . mysqli_error($conn));
        }

        // Insert into claim history
        $addClaimHistorySql = "INSERT INTO claim_history (studentID, fullName, reqDoc, claimDate, status) 
                               SELECT studentID, fullName, reqDoc, '$claimDate', 'claimed' 
                               FROM request_tbl 
                               WHERE id='$docid'";

        if (!mysqli_query($conn, $addClaimHistorySql)) {
            throw new Exception('Error inserting into claim history: ' . mysqli_error($conn));
        }

        if (!mysqli_commit($conn)) {
            throw new Exception('Transaction commit failed');
        } else {
            header('Location: ../claim_history.php?message=Claim recorded successfully');
        }

        mysqli_close($conn);
    }
} catch (Exception $e) {
    mysqli_rollback($conn);
    header("Location: ../index.php?errorMsg=" . urlencode($e->getMessage()));
}
?>
