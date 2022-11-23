<?php
    require "../config/database.php";

        if(isset($_GET['id'])){
            $_SESSION['edit-id'] = $_GET['id'];
        $editId = $_SESSION['edit-id'];
        $edit_fetch_query = "SELECT * FROM posts WHERE id = $editId";
        $edit_fetch_result = mysqli_query($dbconnect, $edit_fetch_query);
        $post = mysqli_fetch_assoc($edit_fetch_result);
        header('Content-Type: application/json');
        echo json_encode($post);

        }
