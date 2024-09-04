<?php
include_once("../../_conn/connection.php");

// Log incoming GET data for debugging
file_put_contents('getstatus.log', json_encode($_GET) . PHP_EOL, FILE_APPEND);

if (isset($_GET['studentID'])) {
    $id = intval($_GET['studentID']);
    
    $query = "SELECT status FROM ezdrequesttbl WHERE studentID = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            echo json_encode(['success' => true, 'status' => $row['status']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No record found']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Statement preparation error: ' . $conn->error]);
    }
    
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
