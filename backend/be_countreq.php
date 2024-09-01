<?php
try {
    //session_start();
    include("_conn/connection.php");

    // Query to get total document requests
    $totalQuery = "SELECT COUNT(*) AS total_requests FROM ezdrequesttbl WHERE studentID = ".$_SESSION['studentId'];
    $totalResult = mysqli_query($conn, $totalQuery);
    $totalRow = mysqli_fetch_assoc($totalResult);
    $totalRequests = $totalRow['total_requests'];

    // Query to get pending document requests
    $pendingQuery = "SELECT COUNT(*) AS pending_requests FROM ezdrequesttbl WHERE status = 'Pending' studentID = ".$_SESSION['studentId'];
    $pendingResult = mysqli_query($conn, $pendingQuery);
    $pendingRow = mysqli_fetch_assoc($pendingResult);
    $pendingRequests = $pendingRow['pending_requests'];

    // Echo the results
    echo '<div class="flex flex-row items-start gap-8">
            <div class="flex flex-col items-center">
                <p class="font-bold text-[26px]">' . htmlspecialchars($totalRequests) . '</p>
                <h2 class="font-medium text-[18px]">Total Requests</h2>
            </div>
            <div class="flex flex-col items-center">
                <p class="font-bold text-[26px]">' . htmlspecialchars($pendingRequests) . '</p>
                <h2 class="font-medium text-[18px]">Pending Requests</h2>
            </div>
          </div>';
}
catch(Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
