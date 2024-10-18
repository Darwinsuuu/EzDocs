<?php
session_start();
include_once("_conn/connection.php");

if (!isset($_SESSION['studentId'])) {
    header("Location: index.php");
    exit();
}

$studentId = $_SESSION['studentId'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $suffix = mysqli_real_escape_string($conn, $_POST['suffix']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $emailAddress = mysqli_real_escape_string($conn, $_POST['emailAddress']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $gradeLevel = mysqli_real_escape_string($conn, $_POST['gradeLevel']);
    
    // If password field is not empty, hash the new password
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $updateSql = "UPDATE student_tbl SET 
                        firstname='$firstname',
                        middlename='$middlename',
                        lastname='$lastname',
                        suffix='$suffix',
                        phoneNumber='$phoneNumber',
                        emailAddress='$emailAddress',
                        password='$hashedPassword',
                        gradeLevel='$gradeLevel'
                      WHERE studentId='$studentId'";
    } else {
        $updateSql = "UPDATE student_tbl SET 
                        firstname='$firstname',
                        middlename='$middlename',
                        lastname='$lastname',
                        suffix='$suffix',
                        phoneNumber='$phoneNumber',
                        emailAddress='$emailAddress',
                        gradeLevel='$gradeLevel'
                      WHERE studentId='$studentId'";
    }

    if (mysqli_query($conn, $updateSql)) {
        $_SESSION['success'] = "Information updated successfully!";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Error updating information: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}

$studentSql = "SELECT * FROM student_tbl WHERE studentId='$studentId'";
$result = mysqli_query($conn, $studentSql);
$student = mysqli_fetch_assoc($result);
mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Information</title>
    <?php include("_includes/styles.php"); ?>
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        form label {
            display: block;
            margin: 10px 0 5px;
        }
        form input, form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        form input[type="submit"] {
            background-color: #FFC107;
            color: white;
            border: none;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #FFA07A;
        }

        .box {
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>
<?php
    include("_includes/styles.php");
    include("_includes/scripts.php");
    ?>
<body>
    <nav class="flex flex-row items-center justify-between px-10 py-4 bg-emerald-900">
        <h1 class="font-bold text-[26px] text-white">EZDocs</h1>
        <ul class="flex flex-row gap-x-4 !p-0 !m-0 list-none">
            <li>
                <a class="block text-white text-[17px] font-regular hover:no-underline px-3" href="index.php">
                    Dashboard
                </a>
            </li>
            <li>
                <a class="block text-white text-[17px] font-regular hover:no-underline px-3" href="claim/claim_history.php">
                    Claimed History
                </a>
            </li>
            <li>
                <a class="block text-white text-[17px] font-regular hover:no-underline px-3" id="btnLogout" type="button">
                    Logout
                </a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <h1>Edit Your Information</h1>
        <?php
        if (isset($_SESSION['success'])) {
            echo '<p style="color: green;">' . $_SESSION['success'] . '</p>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <div class="box">
            <form method="POST" action="">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($student['firstname']); ?>" required>

                <label for="middlename">Middle Name:</label>
                <input type="text" id="middlename" name="middlename" value="<?php echo htmlspecialchars($student['middlename']); ?>">

                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($student['lastname']); ?>" required>

                <label for="suffix">Suffix:</label>
                <input type="text" id="suffix" name="suffix" value="<?php echo htmlspecialchars($student['suffix']); ?>">

                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo htmlspecialchars($student['phoneNumber']); ?>" required>

                <label for="emailAddress">Email Address:</label>
                <input type="email" id="emailAddress" name="emailAddress" value="<?php echo htmlspecialchars($student['emailAddress']); ?>" required>

                <label for="gradeLevel">Grade Level:</label>
                <select id="gradeLevel" name="gradeLevel" required>
                    <?php
                    for ($i = 7; $i <= 12; $i++) {
                        $selected = $student['gradeLevel'] == $i ? 'selected' : '';
                        echo "<option value='$i' $selected>Grade $i</option>";
                    }
                    ?>
                </select>

                <label for="password">New Password (leave blank if not changing):</label>
                <input type="password" id="password" name="password">

                <input type="submit" value="Update Information">
            </form>
        </div>
    </div>

    <script src="path/to/jquery.min.js"></script>
    <script src="path/to/bootstrap.min.js"></script>
    <script>
        $('#btnLogout').click(function(e) {
            Swal.fire({
                title: "SIGN OUT",
                text: "Are you sure you want to logout?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Logout"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "backend/be_logout.php";
                }
            });
        });
    </script>
</body>
</html>