<?php
try {
    include("../_conn/connection.php");

    $sql = "SELECT * FROM ezdrequesttbl";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table" id="documentTableStudent">
                <thead>
                    <tr>
                        <th scope="col">QR</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Document Name</th>
                        <th scope="col">Date Requested</th>
                        <th scope="col">Suggested Claim Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            $reqDate = date('Y-m-d', strtotime($row['reqDate']));
            $claimDate = date('Y-m-d', strtotime($row['reqDate'] . ' +7 days'));
            $id = $row['id'];

            echo '<tr>
                    <td class="align-middle" scope="row">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="" width="50">
                    </td>
                    <td class="align-middle">' . htmlspecialchars($row['fullName']) . '</td>
                    <td class="align-middle">' . htmlspecialchars($row['reqDoc']) . '</td>
                    <td class="align-middle">' . htmlspecialchars($reqDate) . '</td>
                    <td class="align-middle">' . htmlspecialchars($claimDate) . '</td>
                    <td class="align-middle">
                        <select class="status-dropdown form-select" data-id="' . $id . '" name="stat">
                            <option value="pending" ' . ($row['status'] == 'pending' ? 'selected' : '') . '>Pending</option>
                            <option value="processing" ' . ($row['status'] == 'processing' ? 'selected' : '') . '>Processing</option>
                            <option value="ready" ' . ($row['status'] == 'ready' ? 'selected' : '') . '>Ready</option>
                            <option value="claimed" ' . ($row['status'] == 'claimed' ? 'selected' : '') . '>Claimed</option>
                        </select>
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
