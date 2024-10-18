<?php
include_once("../_conn/adminsession.php");
include_once("../_conn/connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Document</title>
    <?php
    include("../_includes/styles.php");
    include("../_includes/scripts.php");

    $pnum = "";
    if (isset($_GET['phoneNumber'])) {
        $pnum = $_GET['phoneNumber'];
    }

    ?>
</head>

<body>

    <nav class="flex flex-row items-center justify-between px-10 py-4 bg-emerald-900">
        <h1 class="font-bold text-[26px] text-white">EZDocs</h1>
    </nav>

    <div class="container pt-5">

        <form class="shadow-md rounded p-3 w-full max-w-[500px] m-auto" method="POST" action="../smsnotif.php">
            <h1 class="text-[32px] !text-left">Messaging</h1>
            <p class="text-[14px] text-gray-600 mb-4">
                Message the student to claim the requested document.
            </p>
            <?php
            if (isset($_GET['errorMsg'])) {
                echo "<div class='py-4 px-2 !bg-red-200 !text-red-700 rounded mb-4'>
                        <p class='!m-0 text-center font-medium'>" . $_GET['errorMsg'] . "</p>
                      </div>";
            }
            ?>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="pnumber" placeholder="+639000000000" value="<?php echo $pnum?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="message"></textarea>
            </div>

            <button class="btn btn-success py-2 mt-2 w-full" type="submit" name="btnsend">Send</button>
            <a class="btn btn-danger py-2 mt-2 w-full text-center block" href="dashboard.php">Cancel</a>
        </form>
    </div>
</body>

</html>