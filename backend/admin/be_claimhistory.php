<?php
$errorMessage = "";
try {
    include("../_conn/connection.php");

    $reqSql = "SELECT fullName, reqHistoryDesc, dateCreated, status FROM requesthistory INNER JOIN ezdrequesttbl ON requesthistory.id = ezdrequesttbl.id";

    $result = mysqli_query($conn, $reqSql);

    if (mysqli_num_rows($result) > 0) {
        // table start
        echo '<table class="table" id="claimHistoryTable">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date Created</th>
                </thead>
                <tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td class="align-middle">' . htmlspecialchars($row['fullName']) . '</td>
                    <td class="align-middle">' . htmlspecialchars($row['reqHistoryDesc']) . '</td>
                    <td class="align-middle">' . htmlspecialchars($row['dateCreated']) . '</td>
                 </tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p>No claims found.</p>';
        //table end
    }

    mysqli_free_result($result);
    mysqli_close($conn);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
