<?php
try {
    include("_conn/connection.php");

    // SQL query to fetch data
    $sql = "SELECT * FROM ezdrequesttbl WHERE studentID = " . intval($_SESSION['studentId']);
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Start of table
        echo '<table class="table" id="documentTableStudent">
                <thead>
                    <tr>
                        <th scope="col">QR</th>
                        <th scope="col">Document Name</th>
                        <th scope="col">Date Requested</th>
                        <th scope="col">Suggested Claim Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>';

        // Loop through results and output rows
        while ($row = mysqli_fetch_assoc($result)) {
            $reqDate = date('Y-m-d', strtotime($row['reqDate']));
            $claimDate = date('Y-m-d', strtotime($row['reqDate'] . ' +7 days'));
            echo '<tr>
                    <td class="align-middle" scope="row">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg"
                            alt="" width="50">
                    </td>
                    <td class="align-middle">' . htmlspecialchars($row['reqDoc']) . '</td>
                    <td class="align-middle">' . htmlspecialchars($reqDate) . '</td>
                    <td class="align-middle">' . htmlspecialchars($claimDate) . '</td>
                    <td class="align-middle">
                        <p class="bg-gray-200 text-center py-2">' . htmlspecialchars($row['status']) . '</p>
                    </td>
                  </tr>';
        }

        // End of table
        echo '</tbody></table>';
    } else {
        echo '<p>No requests found.</p>';
    }

    // Free result and close connection
    mysqli_free_result($result);
    mysqli_close($conn);
}
catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
