<?php
$errorMessage = "";
try {
    session_start();
    include("../../_conn/connection.php");

    if (isset($_POST['btneditdoc'])) {
        $studentid = $_POST['studentID'];
        $studentname = $_POST['fullName'];
        $gradelev = $_POST['gradelv'];
        $docreq = $_POST['reqDoc'];
        $datereq = $_POST['reqDate'];

        mysqli_autocommit($conn,FALSE);

        $editRequestSql = "UPDATE ezdrequesttbl SET fullName = '$studentname', gradelv = '$gradelev', reqDoc = '$docreq', reqDate = '$datereq' WHERE studentID = '$studentid'";

        mysqli_query($conn, $editRequestSql);

        /*$lastID = mysqli_insert_id($conn);

        $requestHistorySql = "INSERT INTO requestHistory(reqID, reqHistoryDesc, dateCreated) VALUES('".$lastID."', 'Document request for ".$docreq." is submitted.', '".date("Y-m-d H:i:s")."')";
        $errorMessage = $requestHistorySql;

        mysqli_query($conn, $requestHistorySql);*/

        if (!mysqli_commit($conn)) {
            header('Location: ../../adminui/adminedit.php?errorMsg=Something went wrong');
        } else {
            header('Location: ../../adminui/dashboard.php');
        }

        mysqli_close($conn);
    }
}
 catch (Exception $e) {
    //header("Location: ../reqdocument.php?errorMsg=" . $e->getMessage());
    header("Location: ../../adminui/adminedit.php?errorMsg=" . $errorMessage);
}
?>