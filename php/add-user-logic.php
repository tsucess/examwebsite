<?php
require "../config/database.php";


// get data from add-user page

if (isset($_POST['submit'])) {


    $fullname = filter_var($_POST['fname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fname = strtoupper($fullname);
    $pNumber = filter_var($_POST['pnumber'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nationality = filter_var($_POST['nationality'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $createpsword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpsword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];


    if (!$fname) {
        $_SESSION['add-user'] = "Enter your full name";
    } else if (!$pNumber) {
        $_SESSION['add-user'] = "Enter your NRIC/Passport ID Number";
    } else if (!$nationality) {
        $_SESSION['add-user'] = "Enter your Nationality";
    } else if (!$dob) {
        $_SESSION['add-user'] = "Enter your Date of Birth";
    } else if (strlen($createpsword) < 5 || strlen($confirmpsword) < 5) {
        $_SESSION['add-user'] = "Password should be 5+ characters";
    } else if (!$avatar) {
        $_SESSION['add-user'] = "Upload your passport";
    } else {

        if ($createpsword !== $confirmpsword) {
            $_SESSION['add-user'] = "Passwords do not match";
        } else {
            // hash password 
            $hashed_password = password_hash($confirmpsword, PASSWORD_DEFAULT);

            //check if student already registered 
            $user_check_query = "SELECT * FROM users WHERE passport_no = '$pNumber'";
            $user_check_result = mysqli_query($dbconnect, $user_check_query);

            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['add-user'] = "Student already Registered";
            } else {

                // Checking Avatar Properties: size and file 
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../img/' . $avatar_name;

                // chck if file is an image
                 $image_format = ['png', 'jpg', 'jpeg'];
                 $image_ext = explode('.', $avatar_name);
                 $image_ext = end($image_ext);

                 if(in_array($image_ext, $image_format)){
                    // chck image size 
                    if($avatar['size'] < 1000000){
                        // upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    }else{
                        $_SESSION['add-user'] = "File size too big. should be less than 1mb";
                    }
                 }else{
                    $_SESSION['add-user'] = "File should be png, jpg, or jpeg";
                }
            }
        }
    }

// redirect back to add-user if there is any problem 

if(isset($_SESSION['add-user'])){

    // pass form data back to add-user page
    $_SESSION['add-user-data'] = $_POST;
    header('location: ' . ROOT_URL . 'admin/add-user.php');
    die();
} else {
    $insert_user_query = "INSERT INTO users (full_name, passport_no, nationality, dob, passport, password, gender, is_super_admin) 
    VALUES ('$fname', '$pNumber', '$nationality', '$dob', '$avatar_name', '$hashed_password', '$gender', 0)";
    $insert_user_result = mysqli_query($dbconnect, $insert_user_query);


    if(!mysqli_errno($dbconnect)){
            // redirect to signin page with success message
            $_SESSION['add-user-success'] = "Student Successfully Registered!";
            header('location: ' . ROOT_URL . 'admin/manage-user.php');
            die();
    }
}

} else {

    // if submit button is not clicked, redirect back to add-user page 
    header('location: ' . ROOT_URL . 'admin/add-user.php');
    die();

}
