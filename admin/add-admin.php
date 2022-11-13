<?php
include './partials/header.php';

// get back form data if there was registeratio error
$fname = $_SESSION['add-admin-data']['firstname'] ?? null;
$lname = $_SESSION['add-admin-data']['lastname'] ?? null;
$pNumber = $_SESSION['add-admin-data']['pnumber'] ?? null;
$nationality = $_SESSION['add-admin-data']['nationality'] ?? null;
$createpassword = $_SESSION['add-admin-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-admin-data']['confirmpassword'] ?? null;


unset($_SESSION['add-admin-data']);
?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Add Admin</h2>
        <?php if (isset($_SESSION['add-admin'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['add-admin'];
                        unset($_SESSION['add-admin']) 
                        ?>
                    </p>
                </div>
            <?php endif ?>
        <form action="<?= ROOT_URL ?>php/add-admin-logic.php" enctype="multipart/form-data" method="POST">
            <div class="control">
                <input type="text" name="firstname" value="<?= $fname ?>" placeholder="First Name">
                <input type="text" name="lastname" value="<?= $lname ?>" placeholder="Last Name">
            </div>
            <div class="control">
                <input type="text" name="pnumber" value="<?= $pNumber ?>" placeholder="NIRC/Passport Number">
                <input type="Text" name="nationality" value="<?= $nationality ?>" placeholder="Nationality">
            </div>
            <div class="control">
                <select name="gender">
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                </select>
                <select name="userrole">
                    <option value="1">Admin</option>
                    <option value="2">Super Admin</option>
                </select>
            </div>

            <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create Password">
            <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">


            <div class="form_control">
                <label for="avatar">Profile Picture</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="Submit" name="submit" class="btn"> Add New Admin</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php';
?>