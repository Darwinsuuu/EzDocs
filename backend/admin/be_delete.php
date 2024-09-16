<?php
    include('../../_conn/connection.php');
        
    if (isset($_GET['btnDelete'])) {

        $delete = $_GET['btnDelete'];
        $deleteSql = "DELETE FROM student_tbl WHERE studentId='$delete'";

        mysqli_query($conn, $deleteSql);

        header('location: ../../adminui/studentacc.php');
    }
?>