<?php
include "../config/database.php";

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

  // fetch admin from the database  in order to delete admin from images folder
  $query = "SELECT * FROM admins WHERE id = $id";
  $result = mysqli_query($dbconnect, $query);
  
  
  //make sure we got back only one admin 
  if(mysqli_num_rows($result) == 1){
       $admin = mysqli_fetch_assoc($result);
    $admin_avatar_name = $admin['avatar'];
    $admin_avatar_path = '../img/thumbnail/'. $admin_avatar_name;

    // delete image if available
    if($admin_avatar_path){
        unlink($admin_avatar_path);

        // delet post from database
        $delete_admin_query = "DELETE FROM admins WHERE id=$id LIMIT 1";
        $delete_admin_result = mysqli_query($dbconnect, $delete_admin_query);
        if(!mysqli_errno($dbconnect)){
            $_SESSION['delete-admin-success'] = "admin deleted successfully";
         }
    }
} 
 
}

header('location: ' . ROOT_URL . 'admin/manage-admins.php');
die();