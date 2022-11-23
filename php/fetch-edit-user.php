<?php
    require "../config/database.php";

        if(isset($_GET['id'])){
        $editId = $_GET['id'];
        $edit_fetch_query = "SELECT * FROM users WHERE id = $editId";
        $edit_fetch_result = mysqli_query($dbconnect, $edit_fetch_query);
        $sub = mysqli_fetch_assoc($edit_fetch_result);
        header('Content-Type: application/json');
        echo json_encode($sub);

        }
