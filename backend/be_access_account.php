<?php
try {
    include("../_conn/connection.php");
    include("../_includes/styles.php");
    include("../_includes/scripts.php");

    if (isset($_GET['studentId'])) {
        $studentId = $_GET['studentId'];

        // SQL query to select student account information
        $sql = "SELECT * FROM student_tbl WHERE studentId = '$studentId'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo '<h2>Student Account Information</h2>';
            echo '<p>Student ID: ' . htmlspecialchars($row['studentId']) . '</p>';
            echo '<p>Username: ' . htmlspecialchars($row['emailAddress']) . '</p>';
            echo '<p>Password: ' . htmlspecialchars($row['password']) . '</p>';
            // ...
        } else {
            echo '<p>No student account found.</p>';
        }

        mysqli_free_result($result);
    }

    mysqli_close($conn);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>