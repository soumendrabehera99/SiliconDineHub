<?php
require_once "categorydb.php";
header('Content-Type: application/json');

if(isset($_POST['operation'])) {
    if($_POST['operation'] == 'categoryGet'){

        $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        $limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 5;
        $search = isset($_POST['category']) ? $_POST['category'] : '';

        $response = getCategories($search, $page, $limit);

        echo json_encode($response);
    }else if($_POST['operation'] == 'categoryAdd' && isset($_POST['category'])){
            $category = $_POST['category'];
            $response = addCategory($category);
            echo json_encode(["status" => $response]);
    }else if($_POST['operation'] == 'categoryUpdate' && isset($_POST['category']) && isset($_POST['id'])){
        $id = $_POST['id'];
        $category = $_POST['category'];
        $response = updateCategory($id, $category);
        echo json_encode(['status' => $response]);
    }else if($_POST['operation'] == 'categoryDelete' && isset($_POST['id'])){
        $id = $_POST['id'];
        $response = deleteCategory($id);
        echo json_encode(['status' => $response]);
    }else if($_POST['operation'] == 'categoryGetAll'){
        $response = getAllCategory();
        echo json_encode($response);
    }
}
?>
