<?php
require "../config/database.php";


// get data from add-form page

    $author_id = $_SESSION['id'];
    $title_name = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = strtolower($title_name);
    $document = $_FILES['document'];


    if (!empty($title) && !empty($document)) {


            // Checking Document Properties: size and file 
            $time = time();
            $document_name = $time . $document['name'];
            $document_tmp_name = $document['tmp_name'];
            $document_destination_path = '../form/'.$document_name;

            // chck if file is an doc
            $doc_format = ['doc', 'pdf', 'docx', 'xlsx', 'ppt'];
            $doc_ext = explode('.', $document_name);
            $doc_ext = end($doc_ext);

            if (in_array($doc_ext, $doc_format)) {
                // chck document size 
                if ($document['size'] < 5000000) {
                    // upload Document
                    move_uploaded_file($document_tmp_name, $document_destination_path);
                    try {
                        $insert_user_query = "INSERT INTO forms (title, document, author_id) VALUES ('$title', '$document_name', '$author_id' )";
                        $insert_user_result = mysqli_query($dbconnect, $insert_user_query);
                        echo "success";
                    } catch (mysqli_sql_exception $e) {
                        var_dump($e);
                        exit;
                    }
                } else {
                    echo "File size too big. should be less than 5mb";
                }
            } else {
                echo "File should be doc, docx, pdf, xlsx, or ppt";
            }
      
        } else {
            echo "All input field are required";
        }
