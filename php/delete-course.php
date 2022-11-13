<?php
include "../config/database.php";

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

  // fetch form from the database  in order to delete form from images folder
  $query = "SELECT * FROM subjects WHERE id = $id";
  $result = mysqli_query($dbconnect, $query);
  
  
  //make sure we got back only one user 
  if(mysqli_num_rows($result) == 1){
       $subject = mysqli_fetch_assoc($result);
    $subject_thumbnail_name = $subject['thumbnail'];
    $subject_thumbnail_path = '../form/' .  $subject_thumbnail_name;

    // delete image if available
    if($subject_thumbnail_path){
        unlink($subject_thumbnail_path);

        // delet post from database
        $delete_subject_query = "DELETE FROM subjects WHERE id=$id LIMIT 1";
        $delete_subject_result = mysqli_query($dbconnect, $delete_subject_query);
        if(!mysqli_errno($dbconnect)){
            $_SESSION['delete-form-success'] = "Subject Deleted successfully";
         }
    }
} 
 
}

header('location: ' . ROOT_URL . 'admin/available-courses.php');
die();