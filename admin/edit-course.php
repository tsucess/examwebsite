<?php
include './partials/header.php';


// fetch form data from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM subjects WHERE id=$id";
    $subjects = mysqli_query($dbconnect, $query);
    $subject = mysqli_fetch_assoc($subjects);

}else {
    header('location: '. ROOT_URL . 'admin/available-courses.php');
    die();
}


?>


    <section class="form_section">
        <div class="container form_section-container">
            <h2>Edit Subject</h2>
            <?php if (isset($_SESSION['edit-subject'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['edit-subject'];
                        unset($_SESSION['edit-subject']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>php/edit-course-logic.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="id" value="<?= $subject['id'] ?>" placeholder="Subject Title">
                <input type="hidden" name="prev_thumbnail_name" value="<?= $subject['thumbnail'] ?>" placeholder="Previous Subject Thumbnail">
                <input type="text" name="subject" value="<?= $subject['subject'] ?>" placeholder="Subject Title">
                <input type="text" name="subjectcode" value="<?= $subject['subject_code'] ?>" placeholder="Code"> 
                <input type="text" name="optioncode" value="<?= $subject['option_code'] ?>" placeholder="Subject Duration">
                <input type="text" name="fee" value="<?= $subject['fee'] ?>" placeholder="Fee">
                <div class="form_control">
                    <label for="thumbnail">edit Course Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail">
                </div>
                <button type="Submit" name="submit" class="btn">Update Subject</button>

            </form>
        </div>
    </section>

  
    <?php
    include '../partials/footer.php';
    ?>