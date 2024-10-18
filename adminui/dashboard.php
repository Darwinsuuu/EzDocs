<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize DataTables
    $('#documentTableStudent').DataTable();

    // Handle dropdown change
    $('.status-dropdown').change(function() {
        const id = $(this).data('id');
        const newStatus = $(this).val();

        $.ajax({
            url: '../backend/admin/update_status.php',
            type: 'POST',
            data: {
                id: id,
                status: newStatus
            },
            success: function(response) {
                const result = JSON.parse(response);
                if (result.success) {
                    // Update status display in the table
                    $(`#status-${id} p`).text(newStatus);
                } else {
                    alert('Failed to update status: ' + result.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error updating status');
            }
        });
    });
});
</script>


<?php

include_once("../_conn/adminsession.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Includes -->
    <?php
    include("../_includes/styles.php");
    include("../_includes/scripts.php");
    ?>

    <style>
        /* Global Styles */
      body {
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        line-height: 1.5;
        background-color: #F7F7F7; /* Light gray */
        color: #333333; /* Dark gray */
      }

      /* Header Styles */
      nav {
        background-color: #8BC34A; /* Mint green */
        padding: 20px;
        text-align: center;
      }

      nav h1 {
        color: #FFFFFF;
        font-size: 24px;
        margin-bottom: 10px;
      }

      /* Navigation Styles */
      nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: space-between;
      }

      nav li {
        margin-right: 20px;
      }

      nav a {
        color: #FFFFFF;
        text-decoration: none;
      }

      /* Main Content Styles */
      .container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
      }

      .rounded {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .shadow-lg {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
      }

      .mt-2 {
        margin-top: 20px;
      }

      .px-3 {
        padding-left: 20px;
        padding-right: 20px;
      }

      .py-5 {
        padding-top: 40px;
        padding-bottom: 40px;
      }

      .bg-white {
        background-color: #FFFFFF;
      }

      /* Table Styles */
      .table {
        width: 100%;
        border-collapse: collapse;
      }

      .table th, .table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
      }

      .table th {
        background-color: #8BC34A; /* Mint green */
        color: #FFFFFF;
      }

      /* Button Styles */
      .btn {
        background-color: #FFC107; /* Warm orange */
        color: #FFFFFF;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
      }

      .btn:hover {
        background-color: #FFA07A;
      }
    </style>

</head>

<body>


    <nav class="flex flex-row items-center justify-between px-10 py-4 bg-emerald-900">
        <h1 class="font-bold text-[26px] text-white">EZDocs</h1>
        <ul class="flex flex-row gap-x-4 !p-0 !m-0 list-none">
            <li>
                <a class="block text-white text-[17px] font-regular hover:no-underline px-3" href="../backend/admin/be_studentacc.php">
                    Student
                </a>
            </li>
            <li>
                <a class="block text-white text-[17px] font-regular hover:no-underline px-3" href="../backend/admin/claimed_history.php">
                    Claimed History
                </a>
            </li>
            <li>
                <button class="block text-white text-[17px] font-regular hover:no-underline px-3" id="btnLogout">
                    Logout
                </button>
            </li>
        </ul>
    </nav>

    <div class="container pt-5 ">

        <div class="flex flex-row items-center justify-between ">
            <h1 class="text-[32px] font-bold">Hi there, <br><?php echo $_SESSION['name']; ?></h1>

            <div class="flex flex-col gap-5">
                <?php
                    include ('../backend/admin/be_admincountreq.php');
                ?>
                <!-- <div class="flex flex-row items-start gap-8">
                    <div class="flex flex-col items-center">
                        <p class="font-bold text-[26px]">20</p>
                        <h2 class="font-medium text-[18px]">Total Requests</h2>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-bold text-[26px]">10</p>
                        <h2 class="font-medium text-[18px]">Pending Requests</h2>
                    </div>
                </div> -->

                <!-- <a class="btn btn-primary px-6 py-2" href="reqdocument.php">Request Document</a> -->
            </div>
        </div>


        <div class="rounded shadow-lg mt-2 px-3 py-5 ">
            <?php
            include_once('../backend/admin/be_admindashtable.php');
            ?>
            <!-- <table class="table" id="documentTableStudent">
                <thead>
                    <tr>
                        <th scope="col">Document Name</th>
                        <th scope="col">Date Requested</th>
                        <th scope="col">Suggested Claim Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td class="align-middle">Docs1</td>
                        <td class="align-middle">August 31, 2024</td>
                        <td class="align-middle">September 7, 2024</td>
                        <td class="align-middle">
                            <p class="bg-gray-200 text-center py-2">Pending</p>
                        </td>
                    </tr>
                </tbody>
            </table> -->
        </div>

    </div>
    <script>

    // Handle dropdown change
    $('.status-dropdown').change(function() {
        const id = $(this).data('id');
        const newStatus = $(this).val();

        $.ajax({
            url: '../backend/admin/update_status.php',
            type: 'POST',
            data: {
                id: id,
                status: newStatus
            },
            success: function(response) {
                const result = JSON.parse(response);
                if (result.success) {
                    // Update status display in the table
                    $(`#status-${id}`).text(newStatus);
                } else {
                    alert('Failed to update status: ' + result.message);
                }
            },
            error: function() {
                alert('Error updating status');
            }
        });
    });
</script>

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
                    window.location.href = "../backend/admin/be_adminlogout.php";
                }
            });
        });
    </script>

</body>

</html>