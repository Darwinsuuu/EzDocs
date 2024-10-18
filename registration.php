<!DOCTYPE html>
<html lang="en">
<head>      
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>

    <!-- Includes -->
    <?php
    include("_includes/styles.php");
    include("_includes/scripts.php");
    ?>

    <link rel="stylesheet" href="css/_global.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #004a3a; 
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .container {        
            position: relative;
            z-index: 2;
            overflow-y: auto; /* Add this property */
            padding: 20px; /* Adjust the padding value */
            max-width: 800px; /* Add a max-width to prevent the form from taking up the full screen */
            margin: 40px auto; /* Adjust the margin value */
        }

        .form-container {       
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            padding: 20px;
            background-color: white;
            opacity: 95%;
        }

        .form-label {
            color: black;
        }

        .text-white {
            color: black;
        }

        .requirements {
            font-size: 0.9em;
            margin-top: 10px;
        }
        .requirement {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .requirement span {
            margin-right: 10px;
            font-size: 1.2em; /* Adjust the size as needed */
        }
        .valid {
            color: green;
        }
        .invalid {
            color: red;
        }
    </style>
</head>
<body>
    
    <div class="container flex flex-col items-center justify-center w-full">

        <div class="form-container shadow-lg">

            <div class="mb-4">
                <h1 class="text-[32px] !text-left">Welcome to EzDocs Student</h1>
                <p class="text-[14px] text-gray-600">
                    Kindly fill up the form to create a student account.
                </p>
            </div>

            <?php

            if (isset($_GET['errorMsg'])) {
                echo "<div class='py-4 px-2 !bg-red-200 !text-red-700 rounded mb-4'>
                        <p class='!m-0 text-center font-medium'>" . $_GET['errorMsg'] . "</p>
                      </div>";
            }

            ?>


<form class="w-full max-w-[650px]" method="POST" action="backend/be_registration.php">

<p class="text-[14px] font-medium text-sky-600 mb-2">Personal Information</p>

<div class="grid grid-cols-4 gap-x-3">
    <div class="mb-3 col-span-4">
        <label for="inputStudentId" class="form-label">Student ID</label>
        <input type="text" class="form-control" id="inputStudentId" aria-describedby="studentId"
            name="inputStudentId" required value="<?php if (isset($_GET['studentId'])) { echo $_GET['studentId']; } ?>">
    </div>

    <div class="mb-3 col-span-2">
        <label for="inputFirstname" class="form-label">First Name</label>
        <input type="text" class="form-control" id="inputFirstname" aria-describedby="firstname"
            name="inputFirstname" required value="<?php if (isset($_GET['firstname'])) { echo $_GET['firstname']; } ?>">
    </div>

    <div class="mb-3 col-span-2">
        <label for="inputMiddlename" class="form-label">Middle Name</label>
        <input type="text" class="form-control" id="inputMiddlename" aria-describedby="middleName"
            name="inputMiddlename"  required value="<?php if (isset($_GET['middlename'])) { echo $_GET['middlename']; } ?>">
    </div>

    <div class="mb-3 col-span-3">
        <label for="inputLastname" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="inputLastname" aria-describedby="lastName"
            name="inputLastname" required value="<?php if (isset($_GET['lastname'])) { echo $_GET['lastname']; } ?>">
    </div>

    <div class="mb-3 col-span-1">
        <label for="inputSuffix" class="form-label">Suffix</label>
        <input type="text" class="form-control" id="inputSuffix" aria-describedby="suffix"
            name="inputSuffix"  value="<?php if (isset($_GET['suffix'])) {echo $_GET['suffix']; } ?>">
    </div>

    <div class="mb-3 col-span-1">
        <label for="inputGradeLevel" class="form-label">Grade Level</label>
        <select class="form-control" name="inputGradeLevel" id="inputGradeLevel" required>
            <option disabled selected></option>
            <option value="7" <?php if (isset($_GET['gradeLevel']) && $_GET['gradeLevel'] == '7')
                echo 'selected'; ?>>Grade 7</option>
            <option value="8" <?php if (isset($_GET['gradeLevel']) && $_GET['gradeLevel'] == '8')
                echo 'selected'; ?>>Grade 8</option>
            <option value="9" <?php if (isset($_GET['gradeLevel']) && $_GET['gradeLevel'] == '9')
                echo 'selected'; ?>>Grade 9</option>
            <option value="10" <?php if (isset($_GET['gradeLevel']) && $_GET['gradeLevel'] == '10')
                echo 'selected'; ?>>Grade 10
            </option>
            <option value="11" <?php if (isset($_GET['gradeLevel']) && $_GET['gradeLevel'] == '11')
                echo 'selected'; ?>>Grade 11
            </option>
            <option value="12" <?php if (isset($_GET['gradeLevel']) && $_GET['gradeLevel'] == '12')
                echo 'selected'; ?>>Grade 12
            </option>
        </select>
    </div>

    <div class="mb-3 col-span-3">
<label for="inputPhoneNumber" class="form-label">Phone Number</label>
<input type="tel" class="form-control" id="inputPhoneNumber" aria-describedby="phoneNumber"
name="inputPhoneNumber" required value="<?php if (isset($_GET['inputPhoneNumber'])) { echo $_GET['inputPhoneNumber']; } ?>" pattern="63\d{10}" maxlength="12" placeholder="639XXXXXXXXX" >
</div>

</div>

<p class="text-[14px] font-medium text-sky-600 mt-4 mb-2">Account Details</p>

<div class="grid grid-cols-2 gap-x-3">
    <div class="mb-3 col-span-2">
        <label for="inputEmailAddress" class="form-label">Email address</label>
        <input type="email" class="form-control" id="inputEmailAddress" aria-describedby="emailAddress"
            name="inputEmailAddress" required value="<?php if(isset($_GET['emailAddress'])) { echo $_GET['emailAddress']; } ?>">
    </div>

    <div class="mb-3 col-span-1">
        <label for="inputPassword" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputPassword" name="inputPassword" required>
    </div>

    <div class="mb-3 col-span-1">
        <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="inputConfirmPassword" name="inputConfirmPassword" required>
    </div>
</div>

<div class="requirements">
    <div class="requirement">
        <span id="length-icon" class="icon">✘</span> At least 8 characters long
    </div>
    <div class="requirement">
        <span id="uppercase-icon" class="icon">✘</span> Contains at least one uppercase letter (A-Z)
    </div>
    <div class="requirement">
        <span id="lowercase-icon" class="icon">✘</span> Contains at least one lowercase letter (a-z)
    </div>
    <div class="requirement">
        <span id="number-icon" class="icon">✘</span> Contains at least one number (0-9)
    </div>
    <div class="requirement">
        <span id="special-icon" class="icon">✘</span> Contains at least one special character (e.g., @#$%^&+=_!)
    </div>
</div>

<button type="submit" class="btn btn-primary w-full py-2 mt-2" name="btnCreateAccount">Register Account</button>
<a class="btn btn-danger py-2 mt-2 w-full text-center block" href="index.php">Cancel</a>

</form>
<script>
document.getElementById('inputPhoneNumber').addEventListener('input', function() {
let value = this.value;

// Remove all non-digit characters
value = value.replace(/\D/g, '');

// Ensure the value starts with 63
if (!value.startsWith('63')) {
value = '63' + value;
}

// Limit the length to 11 characters
if (value.length > 12) {
value = value.substring(0, 12);
}

this.value = value;
});
</script>

<script>
document.getElementById('inputPassword').addEventListener('input', function() {
const password = this.value;

// Length requirement
const lengthValid = password.length >= 8;
document.getElementById('length-icon').textContent = lengthValid ? '✔' : '✘';
document.getElementById('length-icon').className = lengthValid ? 'icon valid' : 'icon invalid';

// Uppercase requirement
const uppercaseValid = /[A-Z]/.test(password);
document.getElementById('uppercase-icon').textContent = uppercaseValid ? '✔' : '✘';
document.getElementById('uppercase-icon').className = uppercaseValid ? 'icon valid' : 'icon invalid';

// Lowercase requirement
const lowercaseValid = /[a-z]/.test(password);
document.getElementById('lowercase-icon').textContent = lowercaseValid ? '✔' : '✘';
document.getElementById('lowercase-icon').className = lowercaseValid ? 'icon valid' : 'icon invalid';

// Number requirement
const numberValid = /[0-9]/.test(password);
document.getElementById('number-icon').textContent = numberValid ? '✔' : '✘';
document.getElementById('number-icon').className = numberValid ? 'icon valid' : 'icon invalid';

// Special character requirement
const specialCharValid = /[@#$%^&+=_!]/.test(password);
document.getElementById('special-icon').textContent = specialCharValid ? '✔' : '✘';
document.getElementById('special-icon').className = specialCharValid ? 'icon valid' : 'icon invalid';
});
</script>

</body>
</html>