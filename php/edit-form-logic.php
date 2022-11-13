<?php
require '../config/database.php';

if(isset($_POST['submit'])){

    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $prev_form_name = filter_var($_POST['prev_form_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
    $document = $_FILES['document'];
 
    if(!$title){
        $_SESSION['edit-form'] = "Couldn't update form. Invalid update on edit form";
    } else {

        //work on document
        //deleting existing document if new document is available
        if($document['name']){
            $prev_form_path = '../form/' . $prev_form_name;
            if($prev_form_path){
                    unlink($prev_form_path);
            }
       

        // rename new document 
        $time = time();
        $document_name = $time . $document['name'];
        $document_tmp_name = $document['tmp_name'];
        $document_destination_path = '../form/'. $document_name;

        // validate document file 
        $file_format = ['doc', 'pdf', 'docx', 'xlsx', 'ppt'];
        $doc_ext = explode('.', $document_name);
        $doc_ext = end($doc_ext); 

          if(in_array($doc_ext, $file_format)){
                    // chck document size 
                    if($document['size'] < 5000000){
                        // upload Document
                        move_uploaded_file($document_tmp_name, $document_destination_path);
                    }else{
                        $_SESSION['edit-form'] = "Couldn't update Form. File size too big. should be less than 5mb";
                    }
                 }else{
                    $_SESSION['edit-form'] = "Couldn't update Form. File should be doc, docx, pdf, xlsx, or ppt";
                }
    }
// redirect back (with form data)  to edit-form page, if there is any problem
if($_SESSION['edit-form']){
    // redirect form to manage form if form was invalid 
    header('location: ' . ROOT_URL . 'admin/manage-forms.php');
    die();
}else{

        //set thumbnail name if a new one was uploaded,else keep old thumbnail name
        $document_to_insert = $document_name ?? $prev_form_name;

        $queryform = "UPDATE forms SET title = '$title', document = '$document_to_insert' WHERE id = $id LIMIT 1";
        $result = mysqli_query($dbconnect, $queryform);
    }

    
    }

    if(!mysqli_errno($dbconnect)){
        $_SESSION['edit-form-success'] = "form updated successfully";
        }
}
header('location: ' . ROOT_URL . 'admin/forms.php');
die();