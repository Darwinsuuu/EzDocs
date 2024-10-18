<?php
include_once("../_conn/session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Document</title>
    <?php
    include("../_includes/styles.php");
    include("../_includes/scripts.php");
    ?>
</head>

<body>

    <nav class="flex flex-row items-center justify-between px-10 py-4 bg-slate-900">
        <h1 class="font-bold text-[26px] text-white">EZDocs</h1>
        <ul class="flex flex-row gap-x-4 !p-0 !m-0 list-none">
            <li>
                <a class="block text-white text-[17px] font-regular hover:no-underline px-3" href="dashboard.php">
                    Dashboard
                </a>
            </li>
            <li>
                <a class="block text-white text-[17px] font-regular hover:no-underline px-3" href="#">
                    FAQs
                </a>
            </li>
            <li>
                <a class="block text-white text-[17px] font-regular hover:no-underline px-3" id="btnLogout"
                    type="button">
                    Logout
                </a>
            </li>
        </ul>
    </nav>

    <div class="container pt-5">

        <form method="POST" class="shadow-md rounded p-3 w-full max-w-[500px] m-auto" action="../backend/admin/be_adminedit.php">
            <h1 class="text-[32px] !text-left">Welcome to EzDocs</h1>
            <p class="text-[14px] text-gray-600 mb-4">
                Update student requested document.
            </p>
            <?php

            if (isset($_GET['errorMsg'])) {
                echo "<div class='py-4 px-2 !bg-red-200 !text-red-700 rounded mb-4'>
                        <p class='!m-0 text-center font-medium'>" . $_GET['errorMsg'] . "</p>
                      </div>";
            }

            ?>
            
            <div class="grid grid-cols-2 gap-x-2">
                <div class="col-span-2 mb-2">
                    <label>Student ID No.</label>
                    <input class="form-control" type="text" name="studentID">
                </div>
                <div class="col-span-2 mb-2">
                    <label>Student Name</label>
                    <input class="form-control" type="text" name="studentName">
                </div>

                <div class="col-span-2 mb-2">
                    <label>Grade Level</label>
                    <select name="gradelv" class="form-control">
                        <option disabled selected>-- Select option --</option>
                        <option value="gd7">Grade 7</option>
                        <option value="gd8">Grade 8</option>
                        <option value="gd9">Grade 9</option>
                        <option value="gd10">Grade 10</option>
                        <option value="gd11">Grade 11</option>
                        <option value="gd12">Grade 12</option>
                    </select>
                </div>

                <div class="col-span-2 mb-2">
                    <label>Document Request</label>
                    <select name="reqDoc" class="form-control">
                        <option disabled selected>-- Select option --</option>
                        <option value="Certificate of Enrollment">Certificate of Enrollment</option>
                        <option value="Good Moral">Good Moral</option>
                        <option value="Form 137/138">Form 137/138</option>
                        <option value="Diploma">Diploma</option>
                    </select>
                </div>
                <div class="col-span-2 mb-2">
                    <label>Date</label>
                    <input class="form-control" type="date" name="reqDate" value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>

            <button class="btn btn-primary py-2 mt-2 w-full" type="submit" name="btneditdoc">Save</button>

        </form>
    </div>
    
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