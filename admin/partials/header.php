<?php
require "../partials/header.php";

// Check login status 
if (!isset($_SESSION['id'])){
    header('location: ' . ROOT_URL . 'signin.php');
}
