<?php
require "../config/database.php";

 
// get data from edit-user page
if (isset($_POST['submit'])) {

    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $prev_avatar_name = filter_var($_POST['prev_avatar_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $full_name = filter_var($_POST['fname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $passport_no = filter_var($_POST['pnumber'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nationality = filter_var($_POST['nationality'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_NUMBER_INT);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];


    if (!$full_name) {
        $_SESSION['edit-user'] = "Enter your Full Name";
    } else if (!$passport_no) {
        $_SESSION['edit-user'] = "Enter your NRIC/Passport Number";
    } else if (!$nationality) {
        $_SESSION['edit-user'] = "Enter your Nationality";
    
    } else {


        //work on document
        //deleting existing document if new document is available
        if ($avatar['name']) {
            $prev_avatar_path = '../form/' . $prev_avatar_name;
            if ($prev_avatar_path) {
                unlink($prev_avatar_path);
            }


            // Checking Document Properties: size and file 
            $time = time();
            $avatar_name = $time . $avatar['name'];
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_destination_path = '../img/avatar/' . $avatar_name;

            // image validation
            $image_format = ['jpeg', 'jpg', 'png'];
            $image_ext = explode('.', $avatar_name);
            $image_ext = end($image_ext);

            if (in_array($image_ext, $image_format)) {
                // chck document size 
                if ($avatar['size'] < 2000000) {
                    // upload Document
                    move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                } else {
                    $_SESSION['edit-user'] = "File size too big. should be less than 2mb";
                }
            } else {
                $_SESSION['edit-user'] = "File should be png, jpg, or jpeg";
            }
        }
    }

    // redirect back to edit-user page if there is any problem 

    if (isset($_SESSION['edit-user'])) {;

        // pass form data back to edit-user page
        $_SESSION['edit-user-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/edit-user.php');
        die();
    } else {
        //set avatar name if a new one was uploaded,else keep old avatar name
        $avatar_to_insert = $avatar_name ?? $prev_avatar_name;

        $update_user_query = "UPDATE users SET full_name ='$full_name', passport_no='$passport_no', nationality='$nationality', gender='$gender', passport='$avatar_to_insert' WHERE id = $id LIMIT 1";
        $insert_user_result = mysqli_query($dbconnect, $update_user_query);


        if (!mysqli_errno($dbconnect)) {
            // redirect to manage users page with success message
            $_SESSION['edit-user-success'] = "user edited successfully";
            header('location: ' . ROOT_URL . 'admin/manage-users.php');
            die();
        }
    }
} else {

    // if submit button is not clicked, redirect back to signup page 
    header('location: ' . ROOT_URL . 'admin/edit-user.php');
    die();
}
