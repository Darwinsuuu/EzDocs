<?php

if (isset($_POST["btnCreateAdminAccount"])) {

    try {
        include("../../_conn/connection.php");
        session_start();

        // Get Data
        $adminUsername = $_POST["inputAdminUsername"];
        $adminPassword = $_POST["inputAdminPassword"];
        $confirmAdminPassword = $_POST["inputConfirmAdminPassword"];
        $adminEmail = $_POST["inputAdminEmail"];

        $errorMsg = '';
        $errorCount = 0;

        // Validate
        $regexValidPassword = "/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[@#$%^&+=_!]).{8,16}$/";

        if (!preg_match($regexValidPassword, $adminPassword)) {
            $errorMsg = "Password is too weak. Please change your password.";
            header("Location: ../../adminui/adminregistration.php?adminUsername=$adminUsername&adminEmail=$adminEmail&errorMsg=" . $errorMsg);
        } else if ($adminPassword != $confirmAdminPassword) {
            $errorMsg = "Password does not match.";
            header("Location: ../../adminui/adminregistration.php?adminUsername=$adminUsername&adminEmail=$adminEmail&errorMsg=" . $errorMsg);
        } else {

            // hash password
            $hashAdminPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

            // Insert
            $sql = "
                        INSERT INTO ezdadmintbl 
                            (name, email, password) VALUES
                            ('$adminUsername', '$adminEmail', '$hashAdminPassword')
                       ";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Admin account successfully created')</script>";
                header("Location: ../../adminui/adminlogin.php");
            } else {
                $errorMsg = mysqli_error($conn);
                header("Location: ../../adminregistration.php?adminUsername=$adminUsername&adminEmail=$adminEmail&errorMsg=" . $errorMsg);
            }
            
        }





        mysqli_close($conn);
    } catch (Exception $e) {
        header("Location: ../../adminui/adminregistration.php?adminUsername=$adminUsername&adminEmail=$adminEmail&errorMsg=". $e->getMessage());
    }

}

?>