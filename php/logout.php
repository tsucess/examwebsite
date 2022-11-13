<?php
require '../config/constant.php';

// destroy all sessions and redirect user to login page;
session_destroy();

header('location: ' . ROOT_URL); 
