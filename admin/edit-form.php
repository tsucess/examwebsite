<?php
include './partials/header.php';

// fetch form data from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM forms WHERE id=$id";
    $forms = mysqli_query($dbconnect, $query);
    $form = mysqli_fetch_assoc($forms);

}else {
    header('location: '. ROOT_URL . 'admin/forms.php');
    die();
}


?>

    <section class="form_section">
        <div class="container form_section-container">
            <h2>Edit Form</h2>
            <form action="<?= ROOT_URL ?>php/edit-form-logic.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="id" value="<?= $form['id'] ?>" placeholder="Title">
                <input type="hidden" name="prev_form_name" value="<?= $form['document'] ?>" >
                <div class="form_control">
                    <label for="thumbnail">Update Document</label>
                    <input type="file" name="document" id="thumbnail">
                </div>
                <input type="text" name="title" value="<?= $form['title'] ?>" placeholder="Title">
                <button type="Submit" name="submit" class="btn">Update Form</button>

            </form>
        </div>
    </section>


  
    <?php
    include '../partials/footer.php';
    ?>