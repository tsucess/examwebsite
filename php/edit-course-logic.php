<?php
require "../config/database.php";


// get data from edit-subject page


$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$prev_thumbnail_name = filter_var($_POST['prev_thumbnail_name'], FILTER_SANITIZE_SPECIAL_CHARS);
$subject = filter_var($_POST['subject'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$subject_code = filter_var($_POST['subjectcode'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$start_date = filter_var($_POST['start_date'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$end_date = filter_var($_POST['end_date'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$fee = filter_var($_POST['fee'], FILTER_SANITIZE_NUMBER_INT);
$thumbnail = $_FILES['thumbnail'];


if (!$subject) {
    echo "Enter Subject Title";
} else if (!$subject_code) {
    echo "Enter Subject Code";
} else if (!$fee) {
    echo "Enter Fee for the subject";
} else {


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
        $thumbnail_destination_path = '../img/thumbnail/'.$thumbnail_name;

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
    //set thumbnail name if a new one was uploaded,else keep old thumbnail name
    $thumbnail_to_insert = $thumbnail_name ?? $prev_thumbnail_name;

    $update_subject_query = "UPDATE subjects SET subject ='$subject', subject_code='$subject_code', start_date='$start_date', end_date='$end_date', fee='$fee', thumbnail='$thumbnail_to_insert' WHERE id = $id LIMIT 1";
    $insert_subject_result = mysqli_query($dbconnect, $update_subject_query);
    echo "success";
}
