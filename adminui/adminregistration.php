<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>

    <!-- Includes -->
    <?php
    include("../_includes/styles.php");
    include("../_includes/scripts.php");
    ?>

    <link rel="stylesheet" href="../css/_global.css">
    <style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #46d495; 
        background-size: cover;
        background-position: center;
        position: relative;
        
        
    }

    .container {
        position: relative;
        z-index: 2;
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
</style>
</head>
<body>
    
    <div class="container flex flex-col items-center justify-center w-full">

        <div class="form-container shadow-lg">

            <div class="mb-4">
                <h1 class="text-[32px] !text-left">Welcome to EzDocs Admin</h1>
                <p class="text-[14px] text-gray-600">
                    Kindly fill up the form to create an admin account.
                </p>
            </div>

            <?php

            if (isset($_GET['errorMsg'])) {
                echo "<div class='py-4 px-2 !bg-red-200 !text-red-700 rounded mb-4'>
                        <p class='!m-0 text-center font-medium'>" . $_GET['errorMsg'] . "</p>
                      </div>";
            }

            ?>


            <form class="w-full max-w-[650px]" method="POST" action="../backend/admin/be_adminregister.php">

                <p class="text-[14px] font-medium text-sky-600 mb-2">Admin Information</p>

                <div class="grid grid-cols-2 gap-x-3">
                    <div class="mb-3 col-span-2">
                        <label for="inputAdminUsername" class="form-label">Admin Fullname</label>
                        <input type="text" class="form-control" id="inputAdminUsername" aria-describedby="adminUsername"
                            name="inputAdminUsername" required value="<?php if (isset($_GET['adminUsername'])) { echo $_GET['adminUsername']; } ?>">
                    </div>

                    <div class="mb-3 col-span-2">
                        <label for="inputAdminEmail" class="form-label">Admin Email</label>
                        <input type="email" class="form-control" id="inputAdminEmail" aria-describedby="adminEmail"
                            name="inputAdminEmail" required value="<?php if (isset($_GET['adminEmail'])) { echo $_GET['adminEmail']; } ?>">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-x-3">
                    <div class="mb-3 col-span-1">
                        <label for="inputAdminPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="inputAdminPassword" name="inputAdminPassword" required>
                    </div>

                    <div class="mb-3 col-span-1">
                        <label for="inputConfirmAdminPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="inputConfirmAdminPassword" name="inputConfirmAdminPassword" required>
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

                <button type="submit" class="btn btn-success w-full py-2 mt-2" name="btnCreateAdminAccount">Register Admin Account</button>
            <a class="btn btn-danger py-2 mt-2 w-full text-center block" href="adminlogin.php">Cancel</a>
            </form>

            <script>
    document.getElementById('inputAdminPassword').addEventListener('input', function() {
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

        </div>

    </div>

</body>
</html>