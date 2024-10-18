<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Includes -->
    <?php
    include("_includes/styles.php");
    include("_includes/scripts.php");
    ?>

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('logo/background.jpg'); 
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
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

    <div class="overlay"></div>
    
    <div class="container flex flex-col items-center justify-center w-full">

        <div class="form-container shadow-lg">

            <div class="mb-4">
                <h1 class="text-[32px] !text-left text-blackj">Welcome to EzDocs</h1>
                <p class="text-[14px] text-black-300">
                    Please enter your credentials. We'll make sure your data is safe with us.
                </p>
            </div>

            <?php
            if (isset($_GET['error'])) {
                echo "<div class='py-2 px-2 !bg-red-200 !text-red-700 rounded mb-4'>
                        <p class='!m-0 text-center font-medium'>" . $_GET['errorMsg'] . "</p>
                      </div>";
            }
            ?>

            <form class="w-full max-w-[450px]" method="POST" action="backend/be_login.php">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="inputEmailAddress" value="<?php if(isset($_GET['emailAddress'])) { echo $_GET['emailAddress']; } ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="inputPassword">
                    <div class="w-full text-right">
                        <a href="forgot_password.php" class="text-black-300 text-[14px] hover:text-blue-500 hover:underline">Forgot
                            password?</a>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-full py-2" name="btnLogin">Login</button>
            </form>

            <p class="text-center mt-4 text-black">
                Don't have an account?
                <a href="registration.php" class="font-medium text-blue-500 hover:underline">Create an account here.</a>
            </p>

        </div>

    </div>

</body>

</html>
