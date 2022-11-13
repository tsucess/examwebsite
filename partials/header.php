<?php
require "./config/database.php";

//fetch current user's Information from database
if (isset($_SESSION['id'])) {

    $current_user_id = $_SESSION['id'];

    if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) {
        $admin_query = "SELECT avatar FROM admins WHERE id = $current_user_id LIMIT 1";
        $admin_info = mysqli_query($dbconnect, $admin_query);

        $admin = mysqli_fetch_assoc($admin_info);
    } else {

        $user_query = "SELECT passport FROM users WHERE id = $current_user_id LIMIT 1";
        $user_info = mysqli_query($dbconnect, $user_query);

        $user = mysqli_fetch_assoc($user_info);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <!-- custom style sheet  -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>/css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body>
    <nav>
        <div class="container nav_container">
            <a href="<?= ROOT_URL ?>"><img id="logo" src="<?= ROOT_URL ?>/img/logo.png" alt="logo"></a>
            <a href="<?= ROOT_URL ?>" class="nav_logo">SEVEN SKIES IGCSE EXAM CENTER</a>
            <ul class="nav_items">
                <li><a href="<?= ROOT_URL ?>">Home</a></li>
                <li><a href="<?= ROOT_URL ?>courses.php">Subjects</a></li>
                <li><a href="https://sevenskies.edu.my/admission-form/">Admission</a></li>
                <li><a href="<?= ROOT_URL ?>index.php#contact">Contact us</a></li>
                <li><a href="<?= ROOT_URL ?>faq.php">FAQ</a></li>
                <?php if (isset($_SESSION['id'])) : ?>
                    <li class="nav_profile">
                        <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                            <div class="avatar">
                                <img src="<?= ROOT_URL . 'img/' . $admin['avatar'] ?>">
                            </div>
                        <?php else :  ?>
                            <div class="avatar">
                                <img src="<?= ROOT_URL . 'img/' . $user['passport'] ?>">
                            </div>
                        <?php endif  ?>
                        <ul>
                            <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a></li>
                            <li><a href="<?= ROOT_URL ?>php/logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li><a href="<?= ROOT_URL ?>signin.php">Signin/Signup</a></li>
                <?php endif ?>
            </ul>

            <button id="open_nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close_nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
    <!-- ******************** End of Nav Section *********************** -->