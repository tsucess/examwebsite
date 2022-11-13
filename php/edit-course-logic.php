<?php
require "../config/database.php";


// get data from edit-subject page
if (isset($_POST['submit'])) {

    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $prev_thumbnail_name = filter_var($_POST['prev_thumbnail_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $subject_code = filter_var($_POST['subjectcode'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $option_code = filter_var($_POST['optioncode'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fee = filter_var($_POST['fee'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];


    if (!$subject) {
        $_SESSION['edit-subject'] = "Enter Subject Title";
    } else if (!$subject_code) {
        $_SESSION['edit-subject'] = "Enter Subject Code";
    } else if (!$fee) {
        $_SESSION['edit-subject'] = "Enter Fee for the subject";
    } else {


        //work on document
        //deleting existing document if new document is available
        if ($thumbnail['name']) {
            $prev_thumbnail_path = '../form/' . $prev_thumbnail_name;
            if ($prev_thumbnail_path) {
                unlink($prev_thumbnail_path);
            }


            // Checking Document Properties: size and file 
            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../img/thumbnail/' . $thumbnail_name;

            // image validation
            $image_format = ['jpeg', 'jpg', 'png'];
            $image_ext = explode('.', $thumbnail_name);
            $image_ext = end($image_ext);

            if (in_array($image_ext, $image_format)) {
                // chck document size 
                if ($thumbnail['size'] < 2000000) {
                    // upload Document
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {
                    $_SESSION['edit-subject'] = "File size too big. should be less than 2mb";
                }
            } else {
                $_SESSION['edit-subject'] = "File should be png, jpg, or jpeg";
            }
        }
    }

    // redirect back to edit-subject page if there is any problem 

    if (isset($_SESSION['edit-subject'])) {;

        // pass form data back to edit-subject page
        $_SESSION['edit-subject-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/edit-course.php');
        die();
    } else {
        //set thumbnail name if a new one was uploaded,else keep old thumbnail name
        $thumbnail_to_insert = $thumbnail_name ?? $prev_thumbnail_name;

        $update_subject_query = "UPDATE subjects SET subject ='$subject', subject_code='$subject_code', option_code='$option_code', fee='$fee', thumbnail='$thumbnail_to_insert' WHERE id = $id LIMIT 1";
        $insert_subject_result = mysqli_query($dbconnect, $update_subject_query);


        if (!mysqli_errno($dbconnect)) {
            // redirect to manage form page with success message
            $_SESSION['edit-subject-success'] = "Subject edited successfully";
            header('location: ' . ROOT_URL . 'admin/available-courses.php');
            die();
        }
    }
} else {

    // if submit button is not clicked, redirect back to signup page 
    header('location: ' . ROOT_URL . 'admin/edit-course.php');
    die();
}
