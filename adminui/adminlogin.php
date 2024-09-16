<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Includes -->
    <?php
    include("../_includes/styles.php");
    include("../_includes/scripts.php");
    ?>

</head>

<body>

    <div class="flex flex-col items-center justify-center h-screen w-full">

        <div class="shadow-lg p-5 rounded min-w-[500px]">

            <div class="mb-4">
                <h1 class="text-[32px] !text-left">ADMIN</h1>
                <p class="text-[14px] text-gray-600">
                    Please enter your credentials.
                </p>
            </div>

            <?php
            if (isset($_GET['error'])) {
                echo "<div class='py-2 px-2 !bg-red-200 !text-red-700 rounded mb-4'>
                        <p class='!m-0 text-center font-medium'>" . $_GET['errorMsg'] . "</p>
                      </div>";
            }
            ?>

            <form class="w-full max-w-[450px]" method="POST" action="../backend/admin/be_adminlogin.php">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="inputEmailAddress" value="<?php if(isset($_GET['emailAddress'])) { echo $_GET['emailAddress']; } ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="inputPassword">
                </div>
                <button type="submit" class="btn btn-primary w-full py-2" name="btnLogin">Login</button>
            </form>
        </div>

    </div>

</body>

</html>