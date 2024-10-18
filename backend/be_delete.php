<?php
try {
    include("../_conn/connection.php");

    if (isset($_GET['studentId'])) {
        $studentId = $_GET['studentId'];

        // Delete student information from student_tbl
        $sql = "DELETE FROM student_tbl WHERE studentId = $studentId";
        mysqli_query($conn, $sql);

        // Delete student requests from request_tbl
        $sql = "DELETE FROM ezdrequesttbl WHERE studentId = $studentId";
        mysqli_query($conn, $sql);

        // Redirect back to student_info.php
        header("Location: admin/be_studentacc.php");
        exit;
    } else {
        echo "Error: No student ID provided.";
    }

    mysqli_close($conn);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>