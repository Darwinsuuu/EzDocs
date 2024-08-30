<?php
try {
    session_start();
    include("../_conn/connection.php");

    if (isset($_POST['btnreqdoc'])) {
        $studentid = $_SESSION['studentId'];
        $studentname = $_SESSION['fullName'];
        $gradelev = $_POST['gradelv'];
        $docreq = $_POST['reqDoc'];
        $datereq = $_POST['reqDate'];

        $addRequest = mysqli_query($conn, "INSERT INTO ezdrequesttbl(studentID, fullName, gradelvl, reqDoc, reqDate) VALUES('$studentid', '$studentname', '$gradelev', '$docreq', '$datereq')");

        if (!$addRequest) {
            header('Location: ../reqdocument.php?errorMsg=Something went wrong');
        } else {
            header('Location: ../index.php');
        }

        mysqli_close($conn);
    }
}
 catch (Exception $e) {
    header("Location: ../reqdocument.php?errorMsg=" . $e->getMessage());
}
?>