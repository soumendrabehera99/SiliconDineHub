<?php
require_once "fooddb.php";
if(isset($_GET['id'])){
    $foodID = $_GET['id'];
    $res = deleteFoodById($foodID);
    if($res){
        // header("location: ../admin/manageFood.php")
        ?>
            <script>
                window.location = "../admin/manageFood.php?message=<?php echo $res ?>";
                // toast.success("Food delete successfully");
            </script>
        <?php
    }
}

?>