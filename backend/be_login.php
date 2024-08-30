<?php

if (isset($_POST["btnLogin"])) {

    try {
        include("../_conn/connection.php");

        // Get Data
        $emailAddress = $_POST['inputEmailAddress'];
        $password = $_POST['inputPassword'];

        $sql = "SELECT * FROM student_tbl WHERE emailAddress = '$emailAddress'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                
                // Check if password is valid
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                if (password_verify($password, $hashed_password)) {
                    // Store studentId and emailAddress to session
                    $_SESSION['studentId'] = $row["studentId"];
                    $_SESSION['fullName'] = $row["firstname"] . " " . $row["middlename"] . " " . $row["lastname"] . " " . $row["suffix"];
                    $_SESSION['emailAddress'] = $row["emailAddress"];
                    
                    echo 'test';
                    header("Location: ../login.php");
                    exit();
                }

            }
            header("Location: ../login.php?emailAddress=$emailAddress&error=true&errorMsg=Invalid email and password.");
        } else {
            header("Location: ../login.php?emailAddress=$emailAddress&error=true&errorMsg=Invalid email and password.");
        }

        mysqli_close($conn);
    } catch (Exception $e) {
        header("Location: ../login.php?emailAddress=$emailAddress&error=true&errorMsg=" . $e->getMessage());
    }

}

?>