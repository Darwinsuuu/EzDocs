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
                url: '../backend/admin/adminupdate.php',
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
                    Claimed History
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
            <h1 class="text-[32px] font-bold">Hi there, <br><?php echo $_SESSION['name']; ?></h1>

            <div class="flex flex-col gap-5">
                <?php
                include('../backend/admin/be_admincountreq.php');
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

                <a class="btn btn-primary px-6 py-2" href="adminedit.php">Edit Document</a>
            </div>
        </div>


        <div class="rounded shadow-lg mt-2 px-3 py-5">
            <?php
            include_once('../backend/admin/be_admindashtable.php');
            ?>
            <!-- <table class="table" id="documentTableStudent">
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
            </table> -->
        </div>

    </div>
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('#documentTableStudent').DataTable();

            // Handle dropdown change
            $('.status-dropdown').change(function() {
                const id = $(this).data('id');
                const newStatus = $(this).val();

                $.ajax({
                    url: '../backend/admin/adminupdate.php',
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
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.status-dropdown').change(function() {
                var status = $(this).val();
                var id = $(this).data('id');

                $.ajax({
                    url: '../backend/admin/update_status.php',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        console.log('Status updated successfully.');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating status:', error);
                    }
                });
            });
        });
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
                    window.location.href = "../backend/admin/be_adminlogout.php";
                }
            });
        });
    </script>

</body>

</html>