<?php
require_once "dbConnect.php";

function addStudent($sic, $email) {
    try {
        $conn = dbConnection();
        $stmt = $conn->prepare("SELECT * FROM sic_email WHERE sic = ?");
        $stmt->bind_param('s', $sic);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            return "present";
        } else {
            $stmt1 = $conn->prepare("INSERT INTO sic_email(sic, email) VALUES(?, ?)");
            $stmt1->bind_param('ss', $sic, $email);
            $stmt1->execute();

            if ($conn->affected_rows > 0) {
                return "success";
            } else {
                return "error";
            }
        }
    } catch (Exception $e) {
        return "error: " . $e->getMessage();
    }
}
?>
