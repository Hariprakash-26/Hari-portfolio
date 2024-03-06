<?php

if(isset($_POST['id']) && isset($_POST['title'])){
    require '../db_conn.php';

    $id = $_POST['id'];
    $title = $_POST['title'];

    if(empty($id) || empty($title)){
       echo 'error';
    }else {
        $stmt = $conn->prepare("UPDATE todos SET title=? WHERE id=?");
        $res = $stmt->execute([$title, $id]);

        if($res){
            echo 'success';
        }else {
            echo 'error';
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}
