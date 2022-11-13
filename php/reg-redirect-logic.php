<?php
require '../config/database.php';

if(isset($_POST['submit'])){
    if (isset($_SESSION['id'])) {
        // if user is logged in redirect to available course in dashboard 
        header('location: ' . ROOT_URL . 'admin/available-courses.php');
        die();
    } else{
        //if user login session is not set redirect to signin page
        
        header('location: ' . ROOT_URL . 'signin.php');
        die();
    } 
}