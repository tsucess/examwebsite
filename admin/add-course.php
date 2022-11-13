<?php
include './partials/header.php';

// get back form data if there was subject upload error
$subject = $_SESSION['add-subject-data']['subject'] ?? null;
$subject_code = $_SESSION['add-subject-data']['subjectcode'] ?? null;
$option_code = $_SESSION['add-subject-data']['optioncode'] ?? null;
$fee = $_SESSION['add-subject-data']['fee'] ?? null;


 

unset($_SESSION['add-subject-data']);
?>


    <section class="form_section">
        <div class="container form_section-container">
            <h2>Add Subject</h2>
            <?php if (isset($_SESSION['add-subject'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['add-subject'];
                        unset($_SESSION['add-subject']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>php/add-course-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="subject" value="<?= $subject ?>" placeholder="Subject Title">
                <input type="text" name="subjectcode" value="<?= $subject_code ?>" placeholder="Code"> 
                <input type="text" name="optioncode" value="<?= $option_code ?>" placeholder="Subject Duration">
                <input type="text" name="fee" value="<?= $fee ?>" placeholder="Fee">
                <div class="form_control">
                    <label for="thumbnail">Add Course Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail">
                </div>
                <button type="Submit" name="submit" class="btn">Add Subject</button>

            </form>
        </div>
    </section>

  
    <?php
    include '../partials/footer.php';
    ?>