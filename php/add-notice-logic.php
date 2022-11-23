<?php
require "../config/database.php";


if (isset($_POST['submit'])) {

    $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_SPECIAL_CHARS);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];



    // set is_featured to zero if unchecked 
    $is_featured = $is_featured == 1 ?: 0;


    if (!$title) {
        $_SESSION['add-post'] = "Enter Notice Title";
    } else if (!$body) {
        $_SESSION['add-post'] = "Enter Notice body";
    } else if (!$thumbnail) {
        $_SESSION['add-post'] = "Upload Notice thumbnail";
    } else {

        // Checking thumbnail Properties: size and file 
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../img/thumbnail/'.$thumbnail_name;

        // chck if file is an image
        $image_format = ['png', 'jpg', 'jpeg'];
        $image_ext = explode('.', $thumbnail_name);
        $image_ext = end($image_ext);

        if (in_array($image_ext, $image_format)) {
            // chck image size 
            if ($thumbnail['size'] < 1000000) {
                // upload thumbnail
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {
                $_SESSION['add-post'] = "File size too big. should be less than 1mb";
            }
        } else {
            $_SESSION['add-post'] = "File should be png, jpg, or jpeg";
        }



        // redirect back to add-user if there is any problem 

        if (isset($_SESSION['add-post'])) {

            // pass form data back to add-user page
            $_SESSION['add-post-data'] = $_POST;
            header('location: ' . ROOT_URL . 'admin/add-notice.php');
            die();
        } else {
            // set is_featured of  all other post to 0 if is_featured for this post is 1
            if ($is_featured == 1) {
                $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0";
                $zero_all_is_featured_result = mysqli_query($dbconnect, $zero_all_is_featured_query);
            }

            $insert_post_query = "INSERT INTO posts (title, body, post_thumbnail, is_featured) VALUES ('$title', '$body', '$thumbanil', $is_featured)";
            $insert_post_result = mysqli_query($dbconnect, $insert_post_query);


            if (!mysqli_errno($dbconnect)) {
                // redirect to signin page with success message
                $_SESSION['add-post-success'] = "Notice has been Successfully Posted!";
                header('location: ' . ROOT_URL . 'admin/');
                die();
            }
        }
    }
} else {

    // if submit button is not clicked, redirect back to add-user page 
    header('location: ' . ROOT_URL . 'admin/add-notice.php');
    die();
}
