<?php
require "../config/database.php";


// get data from edit-post page


$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$prev_thumbnail_name = filter_var($_POST['prev_thumbnail_name'], FILTER_SANITIZE_SPECIAL_CHARS);

$title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
$body = filter_var($_POST['body'], FILTER_SANITIZE_SPECIAL_CHARS);
$is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
$thumbnail = $_FILES['thumbnail'];



if (!$title) {
    $_SESSION['add-post'] = "Enter Notice Title";
} else if (!$body) {
    $_SESSION['add-post'] = "Enter Notice body";
} else if (!$thumbnail) {
    $_SESSION['add-post'] = "Upload Notice thumbnail";
} else {


    // set is_featured to zero if unchecked 
    $is_featured = $is_featured == 1? : 0;

    //work on document
    //deleting existing document if new document is available
    if ($thumbnail['name']) {
        $prev_thumbnail_path = '../img/thumbnail/'.$prev_thumbnail_name;
        if ($prev_thumbnail_path) {
            unlink($prev_thumbnail_path);
        }


        // Checking Document Properties: size and file 
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../img/thumbnail/' . $thumbnail_name;

        // image validation
        $image_format = ['jpeg', 'jpg', 'png'];
        $image_ext = explode('.', $thumbnail_name);
        $image_ext = end($image_ext);

        if (in_array($image_ext, $image_format)) {
            // chck document size 
            if ($thumbnail['size'] < 2000000) {
                // upload Document
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {
                echo "File size too big. should be less than 2mb";
            }
        } else {
            echo "File should be png, jpg, or jpeg";
        }
    }

    // set is_featured of  all other post to 0 if is_featured for this post is 1
    if ($is_featured == 1) {
        $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0";
        $zero_all_is_featured_result = mysqli_query($dbconnect, $zero_all_is_featured_query);
    }



    //set thumbnail name if a new one was uploaded,else keep old thumbnail name
    $thumbnail_to_insert = $thumbnail_name ?? $prev_thumbnail_name;

    $update_post_query = "UPDATE posts SET title ='$title', body='$body', post_thumbnail='$thumbnail_to_insert', is_featured = '$is_featured' WHERE id = $id LIMIT 1";
    $insert_post_result = mysqli_query($dbconnect, $update_post_query);
    echo "success";
}
