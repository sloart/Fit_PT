<?php
require 'mysqli_connect.php';

function executeQuery($mysqli, $query, $params = [], $types = '') {
    $stmt = $mysqli->prepare($query);
    if (!$stmt) {
        // Log error and return a user-friendly message
        error_log("Error preparing the statement: " . $mysqli->error);
        return false;
    }

    if ($params) {
        $stmt->bind_param($types, ...$params);
    }

    if ($stmt->execute()) {
        return $stmt->get_result();
    } else {
        // Log error and return a user-friendly message
        error_log("Error executing the query: " . $stmt->error);
        return false;
    }
}

function getTherapists($mysqli, $therapistName = '') {
    $query = "SELECT * FROM system_users WHERE user_type = 't'";
    if ($therapistName) {
        $query .= " AND user_name = ?";
        return executeQuery($mysqli, $query, [$therapistName], 's');
    }
    return executeQuery($mysqli, $query);
}
?>