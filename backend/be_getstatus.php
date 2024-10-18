<?php
include_once("_conn/connection.php");


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $query = "SELECT status FROM ezdrequesttbl WHERE id = ?";
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