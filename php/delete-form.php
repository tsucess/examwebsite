<?php
include "../config/database.php";

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

  // fetch form from the database  in order to delete form from images folder
  $query = "SELECT * FROM forms WHERE id = $id";
  $result = mysqli_query($dbconnect, $query);
  
  
  //make sure we got back only one user 
  if(mysqli_num_rows($result) == 1){
       $form = mysqli_fetch_assoc($result);
    $form_name = $form['document'];
    $form_path = '../form/'.$form_name;

    // delete image if available
    if($form_path){
        unlink($form_path);

        // delet post from database
        $delete_form_query = "DELETE FROM forms WHERE id=$id LIMIT 1";
        $delete_form_result = mysqli_query($dbconnect, $delete_form_query);
        if(!mysqli_errno($dbconnect)){
            $_SESSION['delete-form-success'] = "Form deleted successfully";
         }
    }
} 
 
}

header('location: ' . ROOT_URL . 'admin/forms.php');
die();