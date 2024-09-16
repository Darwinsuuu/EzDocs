<?php

if (isset($_POST["btnLogin"])) {

    try {
        session_start();
        include("../../_conn/connection.php");

        // Get Data
        $emailAddress = $_POST['inputEmailAddress'];
        $password = $_POST['inputPassword'];

        $sql = "SELECT * FROM ezdadmintbl WHERE email = '$emailAddress'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                
                // Check if password is valid

                if (password_verify($password, $row['password'])) {
                    echo "test";
                    // Store studentId and emailAddress to session
                    $_SESSION['id'] = $row["id"];
                    $_SESSION['name'] = $row["name"];
                    $_SESSION['email'] = $row["email"];
                    
                    header("Location: ../../adminui/dashboard.php");
                    exit();
                }

            }
            header("Location: ../../adminui/adminlogin.php?emailAddress=$emailAddress&error=true&errorMsg=Invalid email and password.");
        } else {
            header("Location: ../../adminui/adminlogin.php?emailAddress=$emailAddress&error=true&errorMsg=Invalid email and password.");
        }

        mysqli_close($conn);
    } catch (Exception $e) {
        header("Location: ../../adminui/adminlogin.php?emailAddress=$emailAddress&error=true&errorMsg=" . $e->getMessage());
    }

}

?>