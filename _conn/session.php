<?php
    session_start();

    if (!isset($_SESSION['studentId'])) {
        header("Location: ../index.php");
    }

?>