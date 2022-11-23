<?php
require "../config/database.php";


// get data from edit-admin page

$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$prev_avatar_name = filter_var($_POST['prev_avatar_name'], FILTER_SANITIZE_SPECIAL_CHARS);
$prev_password = filter_var($_POST['prev_password'], FILTER_SANITIZE_SPECIAL_CHARS);


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



if (!empty($fname) && !empty($lname) && !empty($passport_no)) {

        // if (!empty($gender)) {
        //     $gender = 0;
        // }
    
        if (!empty($resetpsword)) {
    
            if ($resetpsword !== $confirmRpsword) {
                echo "Passwords do not match";
            } else {
                // hash password 
                $hashed_password = password_hash($confirmRpsword, PASSWORD_DEFAULT);
            }
        } else{
            $hashed_password = $prev_password;
        }

    
        //work on document
        //deleting existing document if new document is available
        if ($avatar['name']) {
            $prev_avatar_path = '../img/avatar/'.$prev_avatar_name;
            if ($prev_avatar_path) {
                unlink($prev_avatar_path);
            }
    
    
    
            // Checking Document Properties: size and file 
            $time = time();
            $avatar_name = $time . $avatar['name'];
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_destination_path = '../img/avatar/'.$avatar_name;
    
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
                    echo "File size too big. should be less than 2mb";
                }
            } else {
                echo "please select an Image file - png, jpeg, or jpg!";
            }
        }
    //set avatar name if a new one was uploaded,else keep old avatar name
    // $password_to_insert = $hashed_password ?? $prev_password;
    $avatar_to_insert = $avatar_name ?? $prev_avatar_name;


    $update_admin_query = "UPDATE admins SET firstname ='$fname', lastname = '$lname', passport_no='$passport_no', nationality='$nationality',  avatar='$avatar_to_insert', password= '$hashed_password', gender='$gender', is_super_admin= '$userrole' WHERE id = $id LIMIT 1";
    $update_admin_result = mysqli_query($dbconnect, $update_admin_query);
    echo "success";
}else {
    echo "All input field are required";
}