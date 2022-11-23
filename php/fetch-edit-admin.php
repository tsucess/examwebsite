<?php
    require "../config/database.php";

        if(isset($_GET['id'])){
        $editId = $_GET['id'];
        $edit_fetch_query = "SELECT * FROM admins WHERE id = $editId";
        $edit_fetch_result = mysqli_query($dbconnect, $edit_fetch_query);
        $admin = mysqli_fetch_assoc($edit_fetch_result);
        header('Content-Type: application/json');
        echo json_encode($admin);

        }
