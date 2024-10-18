<?php
include_once("../_includes/styles.php");
include_once("../_includes/scripts.php");

try {
    include("../_conn/connection.php");

    $sql = "SELECT E.id, E.fullName, E.gradelvl, E.reqDoc, E.reqDate, E.status, S.phoneNumber FROM `ezdrequesttbl` E JOIN student_tbl S ON E.studentID = S.studentId WHERE E.status != 'claimed'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table" id="documentTableStudent">
                <thead>
                    <tr>
                        <th scope="col">Student Name</th>
                        <th scope="col">Grade Level</th>
                        <th scope="col">Document Name</th>
                        <th scope="col">Date Requested</th>
                        <th scope="col">Suggested Claim Date</th>
                        <th scope="col">Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            $reqDate = date('Y-m-d', strtotime($row['reqDate']));
            $claimDate = date('Y-m-d', strtotime($row['reqDate'] . ' +7 days'));
            $id = $row['id'];

            echo '<tr>
                    <td class="align-middle">' . htmlspecialchars($row['fullName']) . '</td>
                    <td class="align-middle">' . htmlspecialchars($row['gradelvl']) . '</td>
                    <td class="align-middle">' . htmlspecialchars($row['reqDoc']) . '</td>
                    <td class="align-middle">' . htmlspecialchars($reqDate) . '</td>
                    <td class="align-middle">' . htmlspecialchars($claimDate) . '</td>
                    <td class="align-middle status-' . strtolower($row['status']) . '">
                        <select class="status-dropdown" data-id="' . $id . '">
                            <option value="pending" ' . ($row['status'] == 'pending' ? 'selected' : '') . '>Pending</option>
                            <option value="processing" ' . ($row['status'] == 'processing' ? 'selected' : '') . '>Processing</option>
                            <option value="ready" ' . ($row['status'] == 'ready' ? 'selected' : '') . '>Ready</option>
                            <option value="claimed" ' . ($row['status'] == 'claimed' ? 'selected' : '') . '>Claimed</option>
                        </select>
                    </td>
                    <td>
                        <a class="btn" href="admin_msgreq.php?phoneNumber='.$row['phoneNumber'].'">Message</a>
                    </td>
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
?>
