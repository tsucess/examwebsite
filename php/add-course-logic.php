<?php
require "../config/database.php";


// get data from add-subject page
if (isset($_POST['submit'])) {

    $author_id = $_SESSION['id'];
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $subject_code = filter_var($_POST['subjectcode'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $option_code = filter_var($_POST['optioncode'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fee = filter_var($_POST['fee'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];


    if (!$subject) {
        $_SESSION['add-subject'] = "Enter Subject Title";
    } else if (!$subject_code) {
        $_SESSION['add-subject'] = "Enter Subject Code";
    } else if (!$fee) {
        $_SESSION['add-subject'] = "Enter Fee for the subject";
    } else {


                // Checking Document Properties: size and file 
                $time = time();
                $thumbnail_name = $time . $thumbnail['name'];
                $thumbnail_tmp_name = $thumbnail['tmp_name'];
                $thumbnail_destination_path = '../img/thumbnail/' . $thumbnail_name;

                // image validation
                 $image_format = ['jpeg', 'jpg', 'png'];
                 $image_ext = explode('.', $thumbnail_name);
                 $image_ext = end($image_ext);

                 if(in_array($image_ext, $image_format)){
                    // chck document size 
                    if($thumbnail['size'] < 2000000){
                        // upload Document
                        move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                    }else{
                        $_SESSION['add-subject'] = "File size too big. should be less than 2mb";
                    }
                 }else{
                    $_SESSION['add-subject'] = "File should be png, jpg, or jpeg";
                }
        
    }

// redirect back to add-subject page if there is any problem 

if(isset($_SESSION['add-subject'])){

    // pass form data back to add-subject page
    $_SESSION['add-subject-data'] = $_POST;
    header('location: ' . ROOT_URL . 'admin/add-course.php');
    die();
} else {
    $insert_subject_query = "INSERT INTO subjects (subject, subject_code, option_code, fee, thumbnail) VALUES ('$subject', '$subject_code', '$option_code', '$fee', '$thumbnail_name')";
    $insert_subject_result = mysqli_query($dbconnect, $insert_subject_query);


    if(!mysqli_errno($dbconnect)){
            // redirect to manage form page with success message
            $_SESSION['add-subject-success'] = "Subject added successfully";
            header('location: ' . ROOT_URL . 'admin/available-courses.php');
            die();
    }
}

} else {

    // if submit button is not clicked, redirect back to signup page 
    header('location: ' . ROOT_URL . 'admin/add-course.php');
    die();

}
