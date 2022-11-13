<?php 
require "./config/database.php";


$fname = $_SESSION['signin-data']['fullname_firstname'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;


unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <!-- custom style sheet  -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>
    <section class="form_section">
        <div class="container form_section-container"> 
            <h2>Sign In</h2>
            <?php if (isset($_SESSION['signup-success'])) : ?>
                <div class="alert_message success">
                    <p> <?= $_SESSION['signup-success'];
                        unset($_SESSION['signup-success']);
                        ?>
                    </p>
                </div>
            <?php elseif(isset($_SESSION['signin'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['signin'];
                        unset($_SESSION['signin']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?php ROOT_URL ?>php/signin-logic.php" method="POST">
                <input type="text" name="fullname_firstname" value="<?= $fname ?>" placeholder="Enter Your Full Name">
                <input type="password" name="password" value="<?= $password ?>" placeholder="Enter Your Password">
                <button type="Submit" name="submit" class="btn"> Sign In</button>
                <small>Don't have an account? <a href="./signup.php">Sign Up</a></small>
            </form>
        </div>
    </section>

    <!-- <script src="./js/main.js"></script> -->
</body>

</html>