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
<<<<<<< HEAD
                    $_SESSION['id'] = $row["id"];
                    $_SESSION['name'] = $row["name"];
                    $_SESSION['email'] = $row["email"];
=======
                    $_SESSION['uid'] = $row["id"];
                    $_SESSION['name'] = $row["name"];
                    $_SESSION['emailAddress'] = $row["email"];
>>>>>>> d020ad5d5ddb59840dfbbf28f9cbc5be19712e84
                    
                    header("Location: ../../adminui/dashboard.php");
                    exit();
                }

            }
            header("Location: ../../adminui/adminlogin.php?emailAddress=$emailAddress&error=true&errorMsg=Invalid email and password.");
        } else {
<<<<<<< HEAD
            header("Location:../../adminui/adminlogin.php?emailAddress=$emailAddress&error=true&errorMsg=Invalid email and password.");
=======
            header("Location: ../../adminui/adminlogin.php?emailAddress=$emailAddress&error=true&errorMsg=Invalid email and password.");
>>>>>>> d020ad5d5ddb59840dfbbf28f9cbc5be19712e84
        }

        mysqli_close($conn);
    } catch (Exception $e) {
        header("Location: ../../adminui/adminlogin.php?emailAddress=$emailAddress&error=true&errorMsg=" . $e->getMessage());
    }

}

?>