<?php

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

</head>

<body>


    <nav class="flex flex-row items-center justify-between px-10 py-4 bg-slate-900">
        <h1 class="font-bold text-[26px] text-white">EZDocs</h1>
        <ul class="flex flex-row gap-x-4 !p-0 !m-0 list-none">
            <li>
                <a class="block text-white text-[17px] font-regular hover:no-underline px-3" href="index.php">
                    Dashboard
                </a>
            </li>
            <li>
                <a class="block text-white text-[17px] font-regular hover:no-underline px-3" href="#">
                    Documents
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

        <div class="flex flex-row items-center justify-between">
            <h1 class="text-[32px] font-bold">Hi there, <br><?php echo $_SESSION['fullName']; ?></h1>

            <div class="flex flex-col gap-5">
                <div class="flex flex-row items-start gap-8">
                    <div class="flex flex-col items-center">
                        <p class="font-bold text-[26px]">20</p>
                        <h2 class="font-medium text-[18px]">Total Requests</h2>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-bold text-[26px]">10</p>
                        <h2 class="font-medium text-[18px]">Pending Requests</h2>
                    </div>
                </div>

                <button class="btn btn-primary px-6 py-2">Request Document</button>
            </div>
        </div>

        <!-- ge -->
        <div class="rounded shadow-lg mt-2 px-3 py-5">
            <table class="table" id="documentTableStudent">
                <thead>
                    <tr>
                        <th scope="col">QR</th>
                        <th scope="col">Document Name</th>
                        <th scope="col">Date Requested</th>
                        <th scope="col">Suggested Claim Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle" scope="row">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg"
                                alt="" width="50">
                        </td>
                        <td class="align-middle">Docs1</td>
                        <td class="align-middle">August 31, 2024</td>
                        <td class="align-middle">September 7, 2024</td>
                        <td class="align-middle">
                            <p class="bg-gray-200 text-center py-2">Pending</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <script>
        $(document).ready(function () {
            $('#documentTableStudent').DataTable();
        });

        $('#btnLogout').click(function (e) {

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