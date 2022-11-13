<?php
require "../config/database.php";


//get data from signin page
if (isset($_POST['submit'])) {
    $fullname = filter_var($_POST['fullname_firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fname = strtoupper($fullname);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // form validation 
    if (!$fname) {
        $_SESSION['signin'] = "Full Name or First Name required";
    } else if (!$password) {
        $_SESSION['signin'] = "Password required";
    } else {

        // admin query 
        $fetch_admin_query = "SELECT * FROM admins WHERE firstname = '$fname'";
        $fetch_admin_result = mysqli_query($dbconnect, $fetch_admin_query);

        if (mysqli_num_rows($fetch_admin_result) == 1) {

            $admin_record = mysqli_fetch_assoc($fetch_admin_result);
            $db_password = $admin_record['password'];

            //compare form password with database password
            if (password_verify($password, $db_password)) {

                // set session for access control 
                $_SESSION['id'] = $admin_record['id'];

                // set session for  admin and super admin later 
                if ($admin_record['is_super_admin'] == 1) {
                    $_SESSION['user_is_admin'] = 1;
                } else {
                    $_SESSION['user_is_admin'] = 2;
                }
                // log user in 
                header('location: ' . ROOT_URL . 'admin/');
            }
        } else {

            $fetch_user_query = "SELECT * FROM users WHERE full_name = '$fname'";
            $fetch_user_result = mysqli_query($dbconnect, $fetch_user_query);


            if (mysqli_num_rows($fetch_user_result) == 1) {

                $user_record = mysqli_fetch_assoc($fetch_user_result);
                $db_password = $user_record['password'];

                //compare form password with database password
                if (password_verify($password, $db_password)) {

                    // set session for access control 
                    $_SESSION['id'] = $user_record['id'];
                    $_SESSION['user_is_admin'] = 0;

                    // log user in 
                    header('location: ' . ROOT_URL . 'admin/');
                }
            } else{
                $_SESSION['signin'] = "User not found";
            }
        }
        header('location: ' . ROOT_URL . 'admin/');
        
    }
    // if any problem, redirect back to signin page with login data
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signin.php');
        die();
    }
} else {
    // link bypass security check;
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}
