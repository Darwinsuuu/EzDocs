<?php
try {
    include("_conn/connection.php");

    // Check if status update request is made
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['requestId']) && isset($_POST['newStatus'])) {
        $requestId = intval($_POST['requestId']);
        $newStatus = mysqli_real_escape_string($conn, $_POST['newStatus']);
        
        // Update the status in the database
        $updateSql = "UPDATE ezdrequesttbl SET status = '$newStatus' WHERE id = $requestId";
        if (mysqli_query($conn, $updateSql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
        }
        mysqli_close($conn);
        exit;
    }

    // SQL query to fetch data
    $sql = "SELECT * FROM ezdrequesttbl WHERE studentID = " . intval($_SESSION['studentId']);
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Start of table
        echo '<table class="table" id="documentTableStudent">
                <thead>
                    <tr>
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
            $statusClass = strtolower($row['status']);

            echo '<tr>
                    <td class="align-middle">' . htmlspecialchars($row['reqDoc']) . '</td>
                    <td class="align-middle">' . htmlspecialchars($reqDate) . '</td>
                    <td class="align-middle">' . htmlspecialchars($claimDate) . '</td>
                    <td class="align-middle">
                        <p class="bg-' . $statusClass . '-200 text-center py-2">' . htmlspecialchars($row['status']) . '</p>
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