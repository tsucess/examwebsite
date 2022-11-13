<?php
require '../config/database.php';

if(isset($_GET['id'])){
    
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $form_query = "SELECT document FROM forms WHERE id =$id";
    $form_result = mysqli_query($dbconnect, $form_query);
    
    $form = mysqli_fetch_assoc($form_result);
    
    $db_document = $form['document'];
    $file = '../form/' . $db_document;
    

    if(file_exists($file)){
        
        $mime_type = mime_content_type($file);

        header('Cache-Control: public');
        header('Content-Description: File Transfer');
        header("Content-Dispositon: attachment; filename='$db_document'");
        header('Content-Type: '. $mime_type);
        header('Content-Length: '. filesize($file));
        header('Content-Transfer-Encoding: binary');
        
        readfile($file);
        exit;
     }else{
        $_SESSION['download'] = "File failed to download";
     }
}

header('location: ' . ROOT_URL . 'admin/forms.php');
die();