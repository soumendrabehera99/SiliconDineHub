
<?php
require_once "studentdb.php";
if(isset($_POST['operation'])){
    if ($_POST['operation']== "studentSignUp" & isset($_POST['sic'])) {
        $sic = $_POST['sic'];
        $response = fetchStudentBySIC($sic);
        echo $response;
    }
}
?>