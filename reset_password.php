<?php
include ("_conn/connection.php");

include("_includes/styles.php");
include("_includes/scripts.php");

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $query = "SELECT * FROM student_tbl WHERE password_reset_token = '$token'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        
        ?>
        <div class="container flex flex-col items-center justify-center w-full">
            <div class="form-container shadow-lg">
                <h1 class="text-[32px] !text-left text-black">Reset Password</h1>
                <p class="text-[14px] text-black-300">
                    Please enter your new password.
                </p>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="newPassword">Enter new password:</label>
                    <input type="password" name="newPassword" required>
                    <label for="confirmPassword">Confirm new password:</label>
                    <input type="password" name="confirmPassword" required>
                    <button type="submit" name="submit">Reset password</button>
                </form>
            </div>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            if ($newPassword == $confirmPassword) {
                $query = "UPDATE student_tbl SET password = '$newPassword' WHERE password_reset_token = '$token'";
                mysqli_query($conn, $query);

                echo "Password reset successfully!";
            } else {
                echo "Passwords do not match.";
            }
        }
    } else {
        echo "Invalid token.";
    }
}
?>