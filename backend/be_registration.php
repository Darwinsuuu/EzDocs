<?php

if (isset($_POST["btnCreateAccount"])) {

    try {
        include("../_conn/connection.php");
        session_start();

        // Get Data
        $studentId = $_POST["inputStudentId"];
        $firstname = $_POST["inputFirstname"];
        $middlename = $_POST["inputMiddlename"];
        $lastname = $_POST["inputLastname"];
        $suffix = $_POST["inputSuffix"];
        $gradeLevel = $_POST["inputGradeLevel"];
        $phoneNumber = $_POST["inputPhoneNumber"];
        $emailAddress = $_POST["inputEmailAddress"];
        $password = $_POST["inputPassword"];
        $confirmPassword = $_POST["inputConfirmPassword"];

        $errorMsg = '';
        $errorCount = 0;

        // Validate
        $regexValidPassword = "/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[@#$%^&+=_!]).{8,16}$/";

        if (!preg_match($regexValidPassword, $password)) {
            $errorMsg = "Password is too weak. Please change your password.";
            header("Location: ../registration.php?studentId=$studentId&firstname=$firstname&middlename=$middlename&lastname=$lastname&suffix=$suffix&gradeLevel=$gradeLevel&phoneNumber=$phoneNumber&emailAddress=$emailAddress&errorMsg=" . $errorMsg);
        } else if ($password != $confirmPassword) {
            $errorMsg = "Password does not match.";
            header("Location: ../registration.php?studentId=$studentId&firstname=$firstname&middlename=$middlename&lastname=$lastname&suffix=$suffix&gradeLevel=$gradeLevel&phoneNumber=$phoneNumber&emailAddress=$emailAddress&errorMsg=" . $errorMsg);
        } else {

            // hash password
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert
            $sql = "
                        INSERT INTO student_tbl 
                            (studentId, firstname, middlename, lastname, suffix, gradeLevel, phoneNumber, emailAddress, password) VALUES
                            ('$studentId', '$firstname', '$middlename', '$lastname', '$suffix', '$gradeLevel', '$phoneNumber', '$emailAddress', '$hashPassword')
                       ";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Account successfully created')</script>";
                header("Location: ../login.php");
            } else {
                $errorMsg = mysqli_error($conn);
                header("Location: ../registration.php?studentId=$studentId&firstname=$firstname&middlename=$middlename&lastname=$lastname&suffix=$suffix&gradeLevel=$gradeLevel&phoneNumber=$phoneNumber&emailAddress=$emailAddress&errorMsg=" . $errorMsg);
            }
        }
        mysqli_close($conn);
    } catch (Exception $e) {
        header("Location: ../registration.php?studentId=$studentId&firstname=$firstname&middlename=$middlename&lastname=$lastname&suffix=$suffix&gradeLevel=$gradeLevel&phoneNumber=$phoneNumber&emailAddress=$emailAddress&errorMsg=" . $e->getMessage());
    }
}
