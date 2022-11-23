<?php
include './partials/header.php';


// get back form data if there was add user error
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;



unset($_SESSION['add-post-data']);

?>


    <section class="form_section">
        <div class="container form_section-container">
            <h2>Add Notice</h2>
            <?php if (isset($_SESSION['add-post'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['add-post'];
                        unset($_SESSION['add-post']) 
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL?>php/add-notice-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
                <textarea rows="10" name="body" value="<?= $body ?>" placeholder="Body"></textarea>
                <div class="form_control">
                    <label for="thumbnail">Upload Thumbnail</label>
                    <input type="file" name="thumbnail"  id="thumbnail">
                </div>
                <div class="form_control inline">
                <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
                <label for="is_featured">Featured</label>
            </div>
                <div class="control">
                   <a href="<?= ROOT_URL ?>admin/manage-posts.php"class="btn-lg">Back</a>
                    <button type="submit" name="submit" class="btn-lg">Post Bulletin</button>
                </div>

            </form>
        </div>
    </section>
