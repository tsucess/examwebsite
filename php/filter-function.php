<?php


function connect()
{
    // connect to the database;
    $dbconnect =  new mysqli("localhost", 'success', 'Taofeeq1993@', 'exam_website');

    if (mysqli_error($dbconnect)) {
        die(mysqli_error($dbconnect));
    } else {
        return $dbconnect;
    }
}



if (isset($_POST['filtervalue'])) {
    $filtervalue = $_POST['filtervalue'];
    $filter = $_POST['filters'];
    if ($filter === "all") {
        $subjects = getAllData();
        echo json_encode($subjects);
    } else if ($filter === "others") {

        $subjects = getDataBystatus($filtervalue);
        echo json_encode($subjects);
    } else if ($filter === "year") {

        $subjects = getDataByYear($filtervalue);
        echo json_encode($subjects);
    } else if ($filter === "yearsession") {
        $filteryearvalue = $_POST['filteryearvalue'];
        $subjects = getYearSession($filtervalue, $filteryearvalue);
        echo json_encode($subjects);
    }
}












function getAllData()
{
    $dbconnect = connect();

    //fetch all forms from database
    $query = "SELECT rs.*, u.firstname, u.lastname  FROM registered_subjects rs, users u WHERE u.id=student_id";
    $subject_result = mysqli_query($dbconnect, $query);

    if (mysqli_num_rows($subject_result) > 0) {
        while ($subject = mysqli_fetch_assoc($subject_result)) {
            $subjects[] = $subject;
        }
        return $subjects;
    } else {
        return "success";
    }
}


function getDataByYear($filtervalue)
{
    $dbconnect = connect();
    //fetch all forms from database
    $query = "SELECT rs.*, u.firstname, u.lastname  FROM registered_subjects rs, users u WHERE u.id=student_id AND year = '$filtervalue'";
    $subject_result = mysqli_query($dbconnect, $query);

    if (mysqli_num_rows($subject_result) > 0) {
        while ($subject = mysqli_fetch_assoc($subject_result)) {
            $subjects[] = $subject;
        }
        return $subjects;
    } else {
        return "success";
    }
}


function getYearSession($filter, $filteryear)
{
    $dbconnect = connect();
    //fetch all forms from database
    $query = "SELECT rs.*, u.firstname, u.lastname  FROM registered_subjects rs, users u WHERE u.id=student_id AND year = $filteryear AND session = '$filter' ";
    $subject_result = mysqli_query($dbconnect, $query);

    if (mysqli_num_rows($subject_result) > 0) {
        while ($subject = mysqli_fetch_assoc($subject_result)) {
            $subjects[] = $subject;
        }
        return $subjects;
    } else {
        return "success";
    }
}


function getDataBystatus($filterval)
{
    $dbconnect = connect();
    //fetch all forms from database
    $query = "SELECT rs.*, u.firstname, u.lastname  FROM registered_subjects rs, users u WHERE u.id=student_id AND payment_status = '$filterval' ";
    $subject_result = mysqli_query($dbconnect, $query);

    if (mysqli_num_rows($subject_result) > 0) {
        while ($subject = mysqli_fetch_assoc($subject_result)) {
            $subjects[] = $subject;
        }
        return $subjects;
    } else {
        return "success";
    }
}
