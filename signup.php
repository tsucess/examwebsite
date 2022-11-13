<?php
require "./config/database.php";

// get back form data if there was registeratio error
$fname = $_SESSION['signup-data']['fname'] ?? null;
$pNumber = $_SESSION['signup-data']['pnumber'] ?? null;
$nationality = $_SESSION['signup-data']['nationality'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;


unset($_SESSION['signup-data']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <!-- custom style sheet  -->
    
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>
    <section class="form_section">
        <div class="container form_section-container">
            <h2>Sign Up</h2>
            <?php if (isset($_SESSION['signup'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['signup'];
                        unset($_SESSION['signup']) 
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>php/signup-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="fname" value="<?= $fname ?>" placeholder="Full Name">
                <input type="text" name="pnumber" value="<?= $pNumber ?>" placeholder="NRIC/Passport Number:">
                <input type="text" name="nationality" value="<?= $nationality ?>" placeholder="Nationality:">
                <select name="gender">
                    <option value="0">Female</option>
                    <option value="1">Male</option>
                </select>
                <div class="control">
                    <div class="form_control">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" min="1997-01-01" max="2019-12-31"  placeholder="dd-mm-yyyy" name="dob" id="dob">
                    </div>
                    <div class="form_control">
                        <label for="avatar">Upload Passport</label>
                        <input type="file" name="avatar" id="avatar">
                    </div>
                </div>
                <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create Password">
                <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">
                <button type="Submit" name="submit" class="btn"> Sign Up</button>
                <small>Already have an account? <a href="./signin.php">Sign In</a></small>
            </form>
        </div>
    </section>


    <!-- <script src="./js/main.js"></script> -->
</body>

</html>