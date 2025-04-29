<?php
include_once "dbconnect.php";

header('Content-Type: application/json');

$conn = dbConnection();

function sendResponse($success, $message) {
    echo json_encode(["success" => $success, "message" => $message]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['operation'])) {
    $operation = $_POST['operation'];

    try {
        if ($operation == 'add') {
            $stmt = $conn->prepare("INSERT INTO announcements (title, message, from_date, to_date) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $_POST['title'], $_POST['message'], $_POST['from_date'], $_POST['to_date']);
            $stmt->execute();

            sendResponse(true, "Announcement added successfully.");
        }

        elseif ($operation == 'fetch') {
            $result = $conn->query("SELECT * FROM announcements ORDER BY id DESC");

            $announcements = [];

            while ($row = $result->fetch_assoc()) {
                $announcements[] = $row;
            }

            echo json_encode($announcements);
            exit;
        }

        elseif ($operation == 'get') {
            $stmt = $conn->prepare("SELECT * FROM announcements WHERE id = ?");
            $stmt->bind_param("i", $_POST['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $announcement = $result->fetch_assoc();

            echo json_encode($announcement);
            exit;
        }

        elseif ($operation == 'edit') {
            $stmt = $conn->prepare("UPDATE announcements SET title = ?, message = ?, from_date = ?, to_date = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $_POST['title'], $_POST['message'], $_POST['from_date'], $_POST['to_date'], $_POST['id']);
            $stmt->execute();

            sendResponse(true, "Announcement updated successfully.");
        }

        elseif ($operation == 'delete') {
            $stmt = $conn->prepare("DELETE FROM announcements WHERE id = ?");
            $stmt->bind_param("i", $_POST['id']);
            $stmt->execute();

            sendResponse(true, "Announcement deleted successfully.");
        }

        elseif ($operation == 'fetchLatestAnnouncement') {
            $stmt = $conn->prepare("SELECT * FROM announcements ORDER BY id DESC LIMIT 1");
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result && $row = $result->fetch_assoc()) {
                echo json_encode($row);
            } else {
                echo json_encode(['error' => 'No announcement found']);
            }
        }
        

        else {
            sendResponse(false, "Invalid operation.");
        }
    } catch (Exception $e) {
        sendResponse(false, "Error: " . $e->getMessage());
    } finally {
        $stmt->close();
        $conn->close();
    }
} else {
    sendResponse(false, "Invalid request.");
}
?>
