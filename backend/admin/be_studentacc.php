<?php
try {
    include("../_conn/connection.php");

    $sql = "SELECT studentId, CONCAT(firstname, ' ', middlename, ' ', lastname) AS fullname, suffix, gradeLevel, phoneNumber, emailAddress FROM student_tbl";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-hover" id="documentTableStudent">
                <thead>
                    <tr>
                        <th scope="col">Student ID</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Suffix</th>
                        <th scope="col">Grade Level</th>
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
                    <td class="align-middle">' . htmlspecialchars($row['suffix']) . '</td>
                    <td class="align-middle">' . htmlspecialchars($row['gradeLevel']) . '</td>
                    <td class="align-middle">' . htmlspecialchars($row['phoneNumber']) . '</td>
                    <td class="align-middle">' . htmlspecialchars($row['emailAddress']) . '</td>
                    <td class="align-middle">
                        <button type="submit" class="btn btn-outline-info w-full py-2" name="btnEdit">
                            Edit
                        </button>
                    </td>
                    <form method="GET" action="be_delete.php">
                    <td class="align-middle">
                        <button type="submit" class="btn btn-outline-danger w-full py-2" name="btnDelete">
                            Delete
                        </button>
                    </td>
                    </form>
                 </tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No requests found.</p>';
    }

    mysqli_free_result($result);
    mysqli_close($conn);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
