<?php
include_once("_conn/session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Document</title>
    <?php
    include("_includes/styles.php");
    include("_includes/scripts.php");
    ?>
</head>

<body>

    <nav class="flex flex-row items-center justify-between px-10 py-4 bg-emerald-900">
        <h1 class="font-bold text-[26px] text-white">EZDocs</h1>      
    </nav>

    <div class="container pt-5">

        <form method="POST" class="shadow-md rounded p-3 w-full max-w-[500px] m-auto" action="backend/be_requestdoc.php">
            <h1 class="text-[32px] !text-left">Request Document</h1>
            <p class="text-[14px] text-gray-600 mb-4">
                Please enter your credentials. We'll make sure your data is safe with us.
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
                    <input class="form-control" type="text" name="studentID" value="<?php echo $_SESSION['studentId']; ?>" disabled>
                </div>
                <div class="col-span-2 mb-2">
                    <label>Student Name</label>
                    <input class="form-control" type="text" name="studentName" value="<?php echo $_SESSION['fullName']; ?>" disabled>
                </div>

                <div class="col-span-2 mb-2">
                    <label>Grade Level</label>
                    <select name="gradelv" class="form-control" required>
                        <option disabled selected value="">-- Your Grade Level on the Documnet --</option>
                        <option value="Grade 7">Grade 7</option>
                        <option value="Grade 8">Grade 8</option>
                        <option value="Grade 9">Grade 9</option>
                        <option value="Grade 10">Grade 10</option>
                        <option value="Grade 11">Grade 11</option>
                        <option value="Grade 12">Grade 12</option>
                    </select>
                </div>

                <div class="col-span-2 mb-2">
                    <label>Document Request</label>
                    <select name="reqDoc" class="form-control" required>
                        <option disabled selected value="">-- Select option --</option>
                        <option value="Certificate of Enrollment">Certificate of Enrollment</option>
                        <option value="Certificate of Good Moral">Good Moral</option>
                        <option value="Form 137 (SF10)">Form 137 (SF10)</option>
                        <option value="Form 138 (SF9)">Form 138 (SF9)</option>
                        <option value="Diploma">Diploma</option>
                    </select>
                </div>
                <div class="col-span-2 mb-2">
                    <label>Date Requested</label>
                    <input class="form-control" type="date" name="reqDate" value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>

            <button class="btn btn-primary py-2 mt-2 w-full" type="submit" name="btnreqdoc">Request</button>
            <a class="btn btn-danger py-2 mt-2 w-full text-center block" href="index.php">Cancel</a>
        </form>
    </div>
</body>

</html>
