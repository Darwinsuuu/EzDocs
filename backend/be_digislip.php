<?php
include_once("_conn/connection.php");
include_once("_conn/session.php");

$studentsql = "SELECT * FROM ezdrequesttbl WHERE studentID = " . intval($_SESSION['studentId']);

$slipquery = mysqli_query($conn, $studentsql);

$row = mysqli_fetch_assoc($slipquery);


?>