<?php
include './partials/header.php';
?>


    <section class="form_section">
        <div class="container form_section-container">
            <h2>Add Notice</h2>
            <div class="alert_message error">
                <p>This is an error messge!</p>
            </div>
            <form action="" enctype="multipart/form-data">
                <div class="form_control">
                    <label for="thumbnail">Add Thumbnail</label>
                    <input type="file" name="" id="thumbnail">
                </div>
                <input type="text" placeholder="Title">
                <textarea rows="10" placeholder="Body"></textarea>
                <button type="Submit" class="btn">Post Bulletin</button>

            </form>
        </div>
    </section>

    <?php
    include '../partials/footer.php';
    ?>