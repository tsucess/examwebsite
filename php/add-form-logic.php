<?php
require "../config/database.php";


// get data from add-form page
if (isset($_POST['submit'])) {

    $author_id = $_SESSION['id'];
    $title_name = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = strtolower($title_name);
    $document = $_FILES['document'];


    if (!$title) {
        $_SESSION['add-form'] = "Enter Document Title";
    } else if (!$document) {
        $_SESSION['add-form'] = "Upload Document";
    } else {


                // Checking Document Properties: size and file 
                $time = time();
                $document_name = $time . $document['name'];
                $document_tmp_name = $document['tmp_name'];
                $document_destination_path = '../form/' . $document_name;

                // chck if file is an doc
                 $doc_format = ['doc', 'pdf', 'docx', 'xlsx', 'ppt'];
                 $doc_ext = explode('.', $document_name);
                 $doc_ext = end($doc_ext);

                 if(in_array($doc_ext, $doc_format)){
                    // chck document size 
                    if($document['size'] < 5000000){
                        // upload Document
                        move_uploaded_file($document_tmp_name, $document_destination_path);
                    }else{
                        $_SESSION['add-form'] = "File size too big. should be less than 5mb";
                    }
                 }else{
                    $_SESSION['add-form'] = "File should be doc, docx, pdf, xlsx, or ppt";
                }
        
    }

// redirect back to add-form page if there is any problem 

if(isset($_SESSION['add-form'])){

    // pass form data back to add-form page
    $_SESSION['add-form-data'] = $_POST;
    header('location: ' . ROOT_URL . 'admin/add-form.php');
    die();
} else {
    $insert_user_query = "INSERT INTO forms (title, document, author_id) VALUES ('$title', '$document_name', '$author_id' )";
    $insert_user_result = mysqli_query($dbconnect, $insert_user_query);


    if(!mysqli_errno($dbconnect)){
            // redirect to manage form page with success message
            $_SESSION['add-form-success'] = "File Uploaded successfully";
            header('location: ' . ROOT_URL . 'admin/forms.php');
            die();
    }
}

} else {

    // if submit button is not clicked, redirect back to signup page 
    header('location: ' . ROOT_URL . 'admin/add-form.php');
    die();

}
