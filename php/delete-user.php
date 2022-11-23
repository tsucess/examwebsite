<?php
include "../config/database.php";

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

  // fetch user from the database  in order to delete user from images folder
  $query = "SELECT * FROM users WHERE id = $id";
  $result = mysqli_query($dbconnect, $query);
  
  
  //make sure we got back only one user 
  if(mysqli_num_rows($result) == 1){
       $user = mysqli_fetch_assoc($result);
    $user_passport_name = $user['passport'];
    $user_passport_path = '../img/passport/'.$user_passport_name;

    $user_avatar_name = $user['avatar'];
    $user_avatar_path = '../img/thumbnail/'.$user_avatar_name;

    // delete image if available
    if($user_avatar_path){
        unlink($user_passport_path);
        unlink($user_avatar_path);

        // delet post from database
        $delete_user_query = "DELETE FROM users WHERE id=$id LIMIT 1";
        $delete_user_result = mysqli_query($dbconnect, $delete_user_query);
        if(!mysqli_errno($dbconnect)){
            $_SESSION['delete-user-success'] = "user deleted successfully";
         }
    }
} 
 
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();