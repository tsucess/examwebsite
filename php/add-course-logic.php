<?php
require "../config/database.php";


// get data from add-subject page
$author_id = $_SESSION['id'];
$subject = filter_var($_POST['subject'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$subject_code = filter_var($_POST['subjectcode'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$start_date = filter_var($_POST['start_date'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$end_date = filter_var($_POST['end_date'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$fee = filter_var($_POST['fee'], FILTER_SANITIZE_NUMBER_INT);
$thumbnail = $_FILES['thumbnail'];


if (!empty($subject) && !empty($subject_code) && !empty($start_date) && !empty($end_date) && !empty($fee)) {


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

    try {
        // redirect back to add-subject page if there is any problem             
        $insert_subject_query = "INSERT INTO subjects (subject, subject_code, start_date, end_date, fee, thumbnail) VALUES ('$subject', '$subject_code', '$start_date', '$end_date', '$fee', '$thumbnail_name')";
        $insert_subject_result = mysqli_query($dbconnect, $insert_subject_query);
        echo 'success';
    } catch (mysqli_sql_exception $e) {
        var_dump($e);
        exit;
    }
} else {
    echo "All input field are required";
}
