<?php

include_once("_conn/connection.php");
include_once("_conn/session.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Includes -->
    <?php
    include("_includes/styles.php");
    include("_includes/scripts.php");
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
        background-color: #8BC34A;
        color: #FFFFFF;
      }

      .btn {
        background-color: #FFC107;
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
                <a class="block text-white text-sm md:text-base font-regular hover:no-underline px-3" href="profile.php">
                    Profile
                </a>
            </li>
            <li>
                <a class="block text-white text-[17px] font-regular hover:no-underline px-3" href="claim/claim_history.php">
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

    <div class="container pt-5">
    <div class="flex flex-row items-center justify-between padding-20px">
    <h1 class="text-[clamp(1rem,5vw,2rem)] font-bold">Hi there, <br><?php echo $_SESSION['fullName']; ?></h1>

    <div class="flex flex-col gap-5">
        <a class="btn btn-primary px-6 py-2" href="reqdocument.php">Request Document</a>
    </div>
</div>

        <div class="table-responsive rounded shadow-lg mt-2 px-3 py-5 bg-white">
            <?php
            include_once('backend/be_showdashtable.php');
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
       <div class="d-flex justify-content-end mt-4"> 
            <a class="btn btn-success position-relative px-6 py-2" href="digitalslip.php">Request Slip</a>
        </div>

    </div>

    <script>
    $(document).ready(function() {
        function fetchStatuses() {
            $.ajax({
                url: 'backend/be_getstatus.php',
                type: 'GET',
                success: function(response) {
                    const statuses = JSON.parse(response);
                    statuses.forEach(function(status) {
                        $(`#status-${status.id}`).text(status.status);
                    });
                }
            });
        }

        
        setInterval(fetchStatuses, 30000);
    });
    </script>

    <script>
    function pollStatus() {
        const studentId = <?php echo json_encode($student_id); ?>; 

        fetch('path/to/be_getstatus.php?student_id=' + studentId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateDashboard(data.updates);
                } else {
                    console.error(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function updateDashboard(updates) {
        
        console.log(updates);
    }

    setInterval(pollStatus, 10000);
    </script>

    <script>
        $(document).ready(function() {
            $('#documentTableStudent').DataTable();
        });

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