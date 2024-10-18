<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once('_conn/connection.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$idsession = $_SESSION['studentId'];

// Fetch student data
$sql = "SELECT s.* FROM student_tbl s JOIN ezdrequesttbl r ON s.studentId = r.studentId WHERE r.status = 'ready' AND s.studentId =  $idsession";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    die("No results found or query failed: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);

// Fetch request history
$requestHistorySql = "SELECT * FROM ezdrequesttbl WHERE status = 'ready' AND studentId = ?";
$stmt = mysqli_prepare($conn, $requestHistorySql);
mysqli_stmt_bind_param($stmt, "s", $idsession);
mysqli_stmt_execute($stmt);
$requestHistoryResult = mysqli_stmt_get_result($stmt);
if (!$requestHistoryResult) {
    die("Query failed: " . mysqli_error($conn));
}

$requestHistoryHtml = '';
while ($requestHistoryRow = mysqli_fetch_assoc($requestHistoryResult)) {
    $requestHistoryHtml .= '
        <tr>
            <td>' . $requestHistoryRow['gradelvl'] . '</td>
            <td>' . $requestHistoryRow['reqDoc'] . '</td>
            <td>' . $requestHistoryRow['reqDate'] . '</td>
        </tr>
    ';
}

$html = '
<html>
<head>
    <title>PDF Document</title>
    <style>
        body { font-family: Arial, sans-serif; }
    </style>
</head>
<body>
    <div class="header" style="text-align: center;">
    <img src="data:image/jpeg;base64,' . base64_encode(file_get_contents('logo/spnhs.jpg')) . '" alt="San Pablo National High School" width="100" height="100" style="display: inline-block; margin-right: 10px;">
    <div style="display: inline-block; margin: 0 10px;">
        <h2>San Pablo National High School</h2>
        <h3>San Pablo, Jaen, Nueva Ecija</h3>
    </div>
    <img src="data:image/jpeg;base64,' . base64_encode(file_get_contents('logo/deped.jpg')) . '" alt="San Pablo National High School" width="100" height="100" style="display: inline-block; margin-left: 10px;">
</div>
<table border="1px" width="100%">
    <h4>Student Information</h4>
    <table width="100%">
        <tr align="left">
            <th>LRN: ' . $row['studentId'] . '</th>
        </tr>
        <tr align="left">
            <th>Name: ' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . '</th>
            <th>Grade Level: ' . $row['gradeLevel'] . '</th>
        </tr>
        <tr>
        </tr>
    </table>
    <h4">Document Details</h4>
    <table width="100%">
        <tr>
            <th>Grade Level</th>
            <th>Document</th>
            <th>Date Requested</th>
        </tr>
        ' . $requestHistoryHtml . '
    </table>
</table><br><br>
 <table border="1px">
    <h4">Authorization</h4>
    <p>To Whom It May Concern,</p>
    <p>I, ' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . ', hereby authorize ____________________________ to claim my document on my behalf.</p>
    <p>Student Signature: ______________________________</p>

    </table>
    
    <div style="text-align: center;">
    <p>Thank you for your request!</p>
    <p>Please keep this slip for your records.</p>
</div>
</body>
</html>
';

require 'vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("document.pdf", array("Attachment" => false));