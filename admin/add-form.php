<?php
include './partials/header.php';

// get back form data if there was form upload error
$title = $_SESSION['add-form-data']['title'] ?? null;

 

unset($_SESSION['add-form-data']);
?>

    <section class="form_section">
        <div class="container form_section-container">
            <h2>Upload Document</h2>
            <?php if (isset($_SESSION['add-form'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['add-form'];
                        unset($_SESSION['add-form']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>php/add-form-logic.php" enctype="multipart/form-data" method="POST">
                <div class="form_control">
                    <label for="thumbnail">Select Document</label>
                    <input type="file" name="document" id="thumbnail">
                </div>
                <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
                <button type="Submit" name="submit" class="btn">Upload Form</button>

            </form>
        </div>
    </section>


  
    <?php
    include '../partials/footer.php';
    ?>