<?php
include './partials/header.php';

// get back form data if there was registeratio error
$fname = $_SESSION['add-user-data']['fname'] ?? null;
$pNumber = $_SESSION['add-user-data']['pnumber'] ?? null;
$nationality = $_SESSION['add-user-data']['nationality'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;


unset($_SESSION['add-user-data']);

?>

    <section class="form_section">
        <div class="container form_section-container">
            <h2>Register Student</h2>
            <?php if (isset($_SESSION['add-user'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['add-user'];
                        unset($_SESSION['add-user']) 
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>php/add-user-logic.php" enctype="multipart/form-data" method="POST">
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
                <button type="Submit" name="submit" class="btn"> Register Student</button>
                <small>Already have an account? <a href="./signin.php">Sign In</a></small>
            </form>
        </div>
    </section>


    <!-- <script src="./js/main.js"></script> -->
</body>

</html>