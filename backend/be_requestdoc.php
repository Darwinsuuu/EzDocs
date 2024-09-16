<?php
$errorMessage = "";
try {
    session_start();
    include("../_conn/connection.php");

    if (isset($_POST['btnreqdoc'])) {
        $studentid = $_SESSION['studentId'];
        $studentname = $_SESSION['fullName'];
        $gradelev = $_POST['gradelv'];
        $docreq = $_POST['reqDoc'];
        $datereq = $_POST['reqDate'];

        mysqli_autocommit($conn,FALSE);

        $addRequestSql = "INSERT INTO ezdrequesttbl(studentID, fullName, gradelvl, reqDoc, reqDate) VALUES('$studentid', '$studentname', '$gradelev', '$docreq', '$datereq')";

        mysqli_query($conn, $addRequestSql);

        $lastID = mysqli_insert_id($conn);

        $requestHistorySql = "INSERT INTO requestHistory(reqID, reqHistoryDesc, dateCreated) VALUES('".$lastID."', 'Document request for ".$docreq." is created.', '".date("Y-m-d H:i:s")."')";
        $errorMessage = $requestHistorySql;
        
        mysqli_query($conn, $requestHistorySql);

        if (!mysqli_commit($conn)) {
            header('Location: ../reqdocument.php?errorMsg=Something went wrong');
        } else {
            header('Location: ../index.php');
        }

        mysqli_close($conn);
    }
}
 catch (Exception $e) {
    //header("Location: ../reqdocument.php?errorMsg=" . $e->getMessage());
    header("Location: ../reqdocument.php?errorMsg=" . $errorMessage);
}
?> 