<?php
include_once "dbConnect.php";

function totalOrder() {
    try {
        $conn = dbConnection();

        $stmt = $conn->prepare("SELECT COUNT(*) AS totalOrder FROM order_table");

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['totalOrder'];
        } else {
            return 0;
        }
    } catch (Exception $e) {
        error_log("Error in totalOrder: " . $e->getMessage());
        return 0; 
    } finally {
        $stmt->close();
        $conn->close();
    }
}

function totalDineInOrder() {
    try {
        $conn = dbConnection();

        $stmt = $conn->prepare("SELECT COUNT(*) AS dineInCount FROM order_table WHERE orderType = 'dineIn'");

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['dineInCount'];
        } else {
            return 0;
        }
    } catch (Exception $e) {
        error_log("Error in totalDineInOrder: " . $e->getMessage());
        return 0; 
    } finally {
        $stmt->close();
        $conn->close();
    }
}

function totalParcelOrder() {
    try {
        $conn = dbConnection();

        $stmt = $conn->prepare("SELECT COUNT(*) AS parcelCount FROM order_table WHERE orderType = 'parcel'");

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['parcelCount'];
        } else {
            return 0;
        }
    } catch (Exception $e) {
        error_log("Error in totalParcelOrder: " . $e->getMessage());
        return 0;
    } finally {
        $stmt->close();
        $conn->close();
    }
}

function totalActiveCustomer() {
    try {
        $conn = dbConnection();

        $stmt = $conn->prepare("SELECT COUNT(*) AS activeCustomer FROM student WHERE isActive = 1");

        if (!$stmt) {
            throw new Exception("Failed to prepare the statement: " . $conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['activeCustomer']; 
        } else {
            return 0;
        }
    } catch (Exception $e) {
        error_log("Error in totalActiveCustomer: " . $e->getMessage());
        return 0; 
    } finally {
        $stmt->close();
        $conn->close();
    }
}

function revenueToday() {
    try {
        $conn = dbConnection();

        $stmt = $conn->prepare("SELECT SUM(price) AS revenueToday FROM order_table WHERE DATE(createdAt) = CURDATE()");

        if (!$stmt) {
            throw new Exception("Failed to prepare the statement: " . $conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['revenueToday']; 
        } else {
            return 0;
        }
    } catch (Exception $e) {
        error_log("Error in Revenue Today: " . $e->getMessage());
        return 0; 
    } finally {
        $stmt->close();
        $conn->close();
    }
}

?>