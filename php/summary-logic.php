<?php
require "../config/database.php";
 
if (isset($_SESSION['id'])) {

    $current_user_id = $_SESSION['id'];

// get data from add-admin page
if (isset($_POST['submit'])) {

    $subjects =  $_SESSION['subjects'];
 
    foreach ($subjects as $item) {
        //fetch all subjects from database
        $query = "SELECT  subject, subject_code FROM subjects WHERE id= $item ORDER BY id DESC";
        $subject_result = mysqli_query($dbconnect, $query);
        $subject = mysqli_fetch_assoc($subject_result);

        $sub = $subject['subject'];
        $sub_code = $subject['subject_code'];
    
        $insert_registered_subject = "INSERT INTO registered_subjects (subject, subject_code, student_id )  VALUES ('$sub', '$sub_code', '$current_user_id')";
        $insert_subject_result = mysqli_query($dbconnect, $insert_registered_subject);
        
    }

    if(!mysqli_errno($dbconnect)){
            // redirect to signin page with success message
            $_SESSION['add-registered-success'] = "Subjects Successfully Registered!";
            header('location: ' . ROOT_URL . 'admin/registered-courses.php');
            die();
    }

} else {

    // if submit button is not clicked, redirect back to add-admin page 
    header('location: ' . ROOT_URL . 'admin/summary.php');
    die();
    
}
} else {
    // redirect back to siginin
    header('location: ' . ROOT_URL . 'signin.php');
    die();

}