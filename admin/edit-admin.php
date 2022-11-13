<?php
include './partials/header.php';

// fetch form data from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM admins WHERE id=$id";
    $admins = mysqli_query($dbconnect, $query);
    $admin = mysqli_fetch_assoc($admins);

}else {
    header('location: '. ROOT_URL . 'admin/manage-admin.php');
    die();
}

?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Edit Admin</h2>
        <?php if (isset($_SESSION['edit-admin'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['edit-admin'];
                        unset($_SESSION['edit-admin']) 
                        ?>
                    </p>
                </div>
            <?php endif ?>
        
        <form action="<?= ROOT_URL ?>php/edit-user-logic.php" enctype="multipart/form-data" method="POST">

        <input type="hidden" name="id" value="<?= $admin['id'] ?>" placeholder="Subject Title">
        <input type="hidden" name="prev_avatar_name" value="<?= $admin['avatar'] ?>" placeholder="Previous avatar">

            <div class="control">
                <input type="text" name="firstname" value="<?= $admin['firstname'] ?>" placeholder="First Name">
                <input type="text" name="lastname" value="<?= $admin['lastname'] ?>" placeholder="Last Name">
            </div>
            <div class="control">
                <input type="text" name="pnumber" value="<?= $admin['passport_no'] ?>"  placeholder="NIRC/Passport Number">
                <input type="Text" name="nationality" value="<?= $admin['nationality'] ?>" placeholder="Nationality">
            </div>
            <div class="control">
                <select name="gender">
                    <option value="">Gender</option>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
                <select name="userrole">
                    <option value="0">Admin</option>
                    <option value="1">Super Admin</option>
                </select>
            </div>

            <input type="password" name="resetpassword" placeholder="Reset Password">
            <input type="password"  name="confirmresetpassword" placeholder="Confirm Reset Password">


            <div class="form_control">
                <label for="avatar">Profile Picture</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="Submit" name="submit" class="btn"> Update User</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php';
?>