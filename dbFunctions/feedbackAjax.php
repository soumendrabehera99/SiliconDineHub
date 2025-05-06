<?php
require_once "feedbackDb.php";
header('Content-Type: application/json');

if($_GET['operation'] == "fetchFeedBack"){
    $result = fetchFeedBacks();
    echo $result;
}else if ($_GET['operation'] == "fetchanalyticsFeedBack" && isset($_GET['days'])) {
    $days = intval($_GET['days']);
    echo fetchAnalyticsFeedBacks($days);
}
?>