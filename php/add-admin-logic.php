<?php
require "../config/database.php";
 

// get data from add-admin page
if (isset($_POST['submit'])) {


    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fname = strtoupper($firstname);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lname = strtoupper($lastname);
    $pNumber = filter_var($_POST['pnumber'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nationality = filter_var($_POST['nationality'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $createpsword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpsword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_NUMBER_INT);
    $userrole = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];


    if (!$fname) {
        $_SESSION['add-admin'] = "Enter your First Name";
    }elseif (!$lname) {
        $_SESSION['add-admin'] = "Enter your Lastst Name";
    } else if (!$pNumber) {
        $_SESSION['add-admin'] = "Enter your NRIC/Passport ID Number";
    } else if (!$nationality) {
        $_SESSION['add-admin'] = "Enter your Nationality";
    } else if (strlen($createpsword) < 5 || strlen($confirmpsword) < 5) {
        $_SESSION['add-admin'] = "Password should be 5+ characters";
    } else if (!$avatar) {
        $_SESSION['add-admin'] = "Upload Avatar";
    } else {

        if ($createpsword !== $confirmpsword) {
            $_SESSION['add-admin'] = "Passwords do not match";
        } else {
            // hash password 
            $hashed_password = password_hash($confirmpsword, PASSWORD_DEFAULT);

            //check if student already registered 
            $admincheck_query = "SELECT * FROM admins WHERE passport_no = '$pNumber'";
            $admincheck_result = mysqli_query($dbconnect, $admincheck_query);

            if (mysqli_num_rows($admincheck_result) > 0) {
                $_SESSION['add-admin'] = "Account already Registered";
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
                        $_SESSION['add-admin'] = "File size too big. should be less than 1mb";
                    }
                 }else{
                    $_SESSION['add-admin'] = "File should be png, jpg, or jpeg";
                }
            }
        }
    }


// redirect back to add-admin if there is any problem 
if(isset($_SESSION['add-admin'])){

    // pass form data back to add-admin page
    $_SESSION['add-admin-data'] = $_POST;
    header('location: ' . ROOT_URL . 'admin/add-admin.php');
    die();
} else {
    $insert_user_query = "INSERT INTO admins (firstname, lastname, passport_no, nationality, avatar, password, gender, is_super_admin) 
    VALUES ('$fname', '$lname', '$pNumber', '$nationality', '$avatar_name', '$hashed_password', '$gender', '$userrole' )";
    $insert_user_result = mysqli_query($dbconnect, $insert_user_query);


    if(!mysqli_errno($dbconnect)){
            // redirect to signin page with success message
            $_SESSION['add-admin-success'] = "Student Successfully Registered!";
            header('location: ' . ROOT_URL . 'admin/manage-admin.php');
            die();
    }
}

} else {

    // if submit button is not clicked, redirect back to add-admin page 
    header('location: ' . ROOT_URL . 'admin/add-admin.php');
    die();

}
