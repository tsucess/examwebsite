<?php
include './partials/header.php';

// fetch form data from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $users = mysqli_query($dbconnect, $query);
    $user = mysqli_fetch_assoc($users);

}else {
    header('location: '. ROOT_URL . 'admin/forms.php');
    die();
}

?>

    <section class="form_section">
        <div class="container form_section-container">
            <h2>Edit User</h2>
            <?php if (isset($_SESSION['edit-user'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['edit-user'];
                        unset($_SESSION['edit-user']) 
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>php/edit-user-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $user['id'] ?>" placeholder="Subject Title">
                <input type="hidden" name="prev_avatar_name" value="<?= $user['passport'] ?>" placeholder="Previous avatar">

                <input type="text" name="fname" value="<?= $user['full_name'] ?>" placeholder="Full Name">
                <input type="text" name="pnumber" value="<?= $user['passport_no'] ?>" placeholder="NRIC/Passport Number:">
                <input type="text" name="nationality" value="<?= $user['nationality'] ?>" placeholder="Nationality:">
                <select name="gender">
                    <option value="0">Female</option>
                    <option value="1">Male</option>
                </select>
                <div class="control">
                    <div class="form_control">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" min="1997-01-01" max="2019-12-31" value="<?= $user['dob'] ?>" placeholder="dd-mm-yyyy" name="dob" id="dob">
                    </div>
                    <div class="form_control">
                        <label for="avatar">Upload Passport</label>
                        <input type="file" name="avatar" id="avatar">
                    </div>
                </div>
                <input type="password" name="createpassword" value="<?= $user['password'] ?>" placeholder="Create Password">
                <input type="password" name="confirmpassword" value="<?= $user['password'] ?>"  placeholder="Confirm Password">
                <button type="Submit" name="submit" class="btn"> Update User</button>
            </form>
        </div>
    </section>


    <!-- <script src="./js/main.js"></script> -->
</body>

</html>