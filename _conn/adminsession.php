<?php
    session_start();

    if (!isset($_SESSION['uid'])) {
        header("Location: ../adminui/adminlogin.php");
    }

?>