<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <style>
        .table-container {
            width: 80%;
            margin: 0 auto;
            margin-bottom: 20px;
      }

        .table-container table {
            width: 100%; 
            border-collapse: collapse; 
        }

        .table-container th, .table-container td {
            padding: 10px; 
            text-align: left; 
            border: 1px solid #ddd;
       
        }

        .table-container th {
            background-color: #8db600;
            color: #FFFFFF;
        }

        .button-group {
            gap: 1px; 
        }

        .button-group button {
            margin: 0; 
        }
    </style>
</head>
<body>

    <nav class="flex flex-row items-center justify-between px-10 py-4 bg-emerald-900">
        <h1 class="font-bold text-[26px] text-white">EZDocs</h1>
        <ul class="flex flex-row gap-x-4 !p-0 !m-0 list-none">
            <li>
                <a class="block text-white text-[17px] font-regular hover:no-underline px-3" href="../../adminui/dashboard.php">
                    Dashboard
                </a>
            </li>
            <li>
                <a class="block text-white text-[17px] font-regular hover:no-underline px-3" href="#">
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

    <?php
    try {
        include("../../_conn/connection.php");
        include("../../_includes/styles.php");
        include("../../_includes/scripts.php");

        // Define the grade levels you want to display
        $gradeLevels = range(7, 12);

        foreach ($gradeLevels as $gradeLevel) {
            // SQL query to select students for the current grade level
            $sql = "SELECT studentId, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS fullname, phoneNumber, emailAddress 
                    FROM student_tbl
                    WHERE gradeLevel = $gradeLevel
                    ORDER BY lastname ASC, firstname ASC"; // Order by name within each grade level
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo '<div class="table-container">';
                echo '<h2>Grade ' . htmlspecialchars($gradeLevel) . '</h2>';
                echo '<table class="table table-hover" id="documentTableStudent' . htmlspecialchars($gradeLevel) . '">
                        <thead>
                            <tr class="table-apple-green/  /">
                                <th scope="col">Student ID</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>';

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                            <td class="align-middle" scope="row">' . htmlspecialchars($row['studentId']) . '</td>
                            <td class="align-middle">' . htmlspecialchars($row['fullname']) . '</td>
                            <td class="align-middle">' . htmlspecialchars($row['phoneNumber']) . '</td>
                            <td class="align-middle">' . htmlspecialchars($row['emailAddress']) . '</td>
                            <td class="align-middle">
                                <div class="button-group">
                                    <form method="GET" action="../be_delete.php" style="display:inline;">
                                        <input type="hidden" name="studentId" value="' . htmlspecialchars($row['studentId']) . '">
                                        <button type="submit" class="btn btn-outline-danger w-full py-2" id="btnDelete" name="btnDelete">
                                            Delete
                                        </button>
                                    </form>
                                    <form method="GET" action="../be_access_account.php" style="display:inline;">
                                        <input type="hidden" name="studentId" value="' . htmlspecialchars($row['studentId']) . '">
                                        <button type="submit" class="btn btn-outline-primary w-full py-2" id="btnAccessAccount" name="btnAccessAccount">
                                            Access Account
                                        </button>
                                    </form >
                                </div>
                            </td>
                         </tr>';
                }
                echo '</tbody></table></div>';
            } else {
                echo '<div class="table-container"><p>No students found in grade ' . htmlspecialchars($gradeLevel) . '.</p></div>';
            }

            mysqli_free_result($result);
        }

        mysqli_close($conn);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
    ?>

<script>
    $('.button-group button[name="btnDelete"]').click(function(e) {
    e.preventDefault(); // Prevent the form from submitting
    Swal.fire({
        title: "DELETE STUDENT RECORD",
        text: "Are you sure you want to delete this student record?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Delete"
    }).then((result) => {
        if (result.isConfirmed) {
            console.log('Form submission confirmed!');
            window.location.href = "../be_delete.php?studentId=" + $(this).closest('form').find('input[name="studentId"]').val();
        }
    });
});
</script>

</body>
</html>
