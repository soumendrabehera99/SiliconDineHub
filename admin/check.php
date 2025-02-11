<?php
if (!isset($_SESSION['email']) && !isset($_SESSION['role'])) {
    header("location: ./DemoLogin.html");
}
?>
