<?php
require_once('_conn/connection.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch the student information based on the request status
$sql = "SELECT s.* 
        FROM student_tbl s 
        JOIN ezdrequesttbl r ON s.studentId = r.studentId 
        WHERE r.status = 'ready'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 0) {
    die("No results found");
}

$row = mysqli_fetch_assoc($result);

// Fetch the request history
$requestHistorySql = "SELECT * FROM ezdrequesttbl WHERE status = 'ready'";
$requestHistoryResult = mysqli_query($conn, $requestHistorySql);

if (!$requestHistoryResult) {
    die("Query failed: " . mysqli_error($conn));
}

$requestHistoryRows = array();
while ($requestHistoryRow = mysqli_fetch_assoc($requestHistoryResult)) {
    $requestHistoryRows[] = $requestHistoryRow;
}

$requestHistoryHtml = '';
foreach ($requestHistoryRows as $requestHistoryRow) {
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
        body {
            font-family: Arial, sans-serif;
        }
        
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
    <p>I, ' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . ', hereby authorize ______________________________ to claim my document on my behalf.</p>
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
?>