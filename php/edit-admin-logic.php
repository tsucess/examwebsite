<?php
require "../config/database.php";


// get data from edit-admin page
if (isset($_POST['submit'])) {

    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $prev_avatar_name = filter_var($_POST['prev_avatar_name'], FILTER_SANITIZE_SPECIAL_CHARS);

    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fname = strtoupper($firstname);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lname = strtoupper($lastname);
    $passport_no = filter_var($_POST['pnumber'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nationality = filter_var($_POST['nationality'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_NUMBER_INT);
    $resetpsword = filter_var($_POST['resetpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmRpsword = filter_var($_POST['confirmresetpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $userrole = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];


    if (!$firstname) {
        $_SESSION['edit-admin'] = "Enter your First Name";
    } else if (!$lastname) {
        $_SESSION['edit-admin'] = "Enter your Last Name";
    } else if (!$passport_no) {
        $_SESSION['edit-admin'] = "Enter your NRIC/Passport Number";
    } else if (!$nationality) {
        $_SESSION['edit-admin'] = "Enter your Nationality";
    } else if (!$gender) {
        $_SESSION['edit-admin'] = "Select your Gender";
    } else if (!$resetpsword) {
        $_SESSION['edit-admin'] = "Enter a New Password";
    } else if (strlen($resetpsword) < 5 || strlen($confirmRpsword) < 5) {
        $_SESSION['add-admin'] = "Your New Password should be 5+ characters";
    } else {


        if ($createpsword !== $confirmpsword) {
            $_SESSION['add-admin'] = "Passwords do not match";
        } else {
            // hash password 
            $hashed_password = password_hash($confirmpsword, PASSWORD_DEFAULT);


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
                        $_SESSION['edit-admin'] = "File size too big. should be less than 2mb";
                    }
                } else {
                    $_SESSION['edit-admin'] = "File should be png, jpg, or jpeg";
                }
            }
        }
    }

    // redirect back to edit-admin page if there is any problem 

    if (isset($_SESSION['edit-admin'])) {;

        // pass form data back to edit-admin page
        $_SESSION['edit-admin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/edit-admin.php');
        die();
    } else {
        //set avatar name if a new one was uploaded,else keep old avatar name
        $avatar_to_insert = $avatar_name ?? $prev_avatar_name;

        $update_admin_query = "UPDATE admins SET firstname ='$fname', lastname = '$lname', passport_no='$passport_no', nationality='$nationality',  avatar='$avatar_to_insert', password= '$confirmRpsword', gender='$gender', is_super_admin= '$userrole' WHERE id = $id LIMIT 1";
        $update_admin_result = mysqli_query($dbconnect, $update_admin_query);


        if (!mysqli_errno($dbconnect)) {
            // redirect to manage admins page with success message
            $_SESSION['edit-admin-success'] = "admin edited successfully";
            header('location: ' . ROOT_URL . 'admin/manage-admins.php');
            die();
        }
    }
} else {

    // if submit button is not clicked, redirect back to signup page 
    header('location: ' . ROOT_URL . 'admin/edit-admin.php');
    die();
}
