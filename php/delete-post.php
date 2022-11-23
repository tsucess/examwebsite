<?php
include "../config/database.php";

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

  // fetch form from the database  in order to delete form from images folder
  $query = "SELECT * FROM posts WHERE id = $id";
  $result = mysqli_query($dbconnect, $query);
  
  
  //make sure we got back only one user 
  if(mysqli_num_rows($result) == 1){
       $post = mysqli_fetch_assoc($result);
    $post_name = $post['document'];
    $post_path = '../img/thumbnail/'.$post_name;

    // delete image if available
    if($post_path){
        unlink($post_path);

        // delet post from database
        $delete_form_query = "DELETE FROM posts WHERE id=$id LIMIT 1";
        $delete_form_result = mysqli_query($dbconnect, $delete_form_query);
        if(!mysqli_errno($dbconnect)){
            $_SESSION['delete-form-success'] = "Form deleted successfully";
         }
    }
} 
 
}

header('location: ' . ROOT_URL . 'admin/forms.php');
die();