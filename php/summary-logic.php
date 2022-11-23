<?php
require "../config/database.php";

if (isset($_SESSION['id'])) {

    $current_user_id = $_SESSION['id'];

    // get data from add-admin page
    if (isset($_POST['submit'])) {

        $subjects =  $_SESSION['subjects'];
        $session = $_SESSION['session'];
        $year = $_SESSION['year'];
        $price = $_SESSION['price'];
      

        //check if student already registered 
        $user_check_query = "SELECT * FROM registered_subjects WHERE student_id = $current_user_id";
        $user_check_result = mysqli_query($dbconnect, $user_check_query);

        if (mysqli_num_rows($user_check_result) > 0) {
            $_SESSION['register'] = "Students already registered";
        } else {

            // Check for payment status later 
            $payment_status = "success";

            foreach ($subjects as $item) {
                //fetch all subjects from database
                $query = "SELECT subject, subject_code FROM subjects WHERE id= $item";
                $subject_result = mysqli_query($dbconnect, $query);
                $subject = mysqli_fetch_assoc($subject_result);

                $subjects2[] = $subject['subject'];
                $subject_codes[] = $subject['subject_code'];
            }

            $subjec_Arr = $subjects2;
            $subjec_code_Arr = $subject_codes;

            $sub = implode(',', $subjec_Arr);
            $sub_code =  implode(',', $subjec_code_Arr);
            $sub_id = implode(',', $subjects);

            $insert_registered_subject = "INSERT INTO registered_subjects (subject, subject_code, subject_id, student_id, year, session, payment_status, amount )  VALUES ('$sub', '$sub_code', '$sub_id', '$current_user_id', '$year', '$session', $payment_status, $price)";
            $insert_subject_result = mysqli_query($dbconnect, $insert_registered_subject);
        }

        if (isset($_SESSION['register'])) {
            header('location: ' . ROOT_URL . 'admin/available-courses.php');
            die();
        }

        // redirect to signin page with success message
        if (!mysqli_errno($dbconnect)) {
            $_SESSION['register-success'] = "Subjects Successfully Registered!";
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
