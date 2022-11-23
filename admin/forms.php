<?php
include './partials/header.php';

//fetch all forms from database
$query = "SELECT id, title, date_time FROM forms ORDER BY id DESC";
$forms = mysqli_query($dbconnect, $query);


?>

<section class="dashboard">
    <?php if (isset($_SESSION['edit-form'])) : // shows if edit post was Not successful 
    ?>
        <div class="alert_message error container">
            <p> <?= $_SESSION['edit-form'];
                unset($_SESSION['edit-form']);
                ?>
            </p>
        </div>
    <?php endif ?>
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
            <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                <li>
                    <a href="dashboard.php"><i class="uil uil-dashboard"></i>
                        <h5>Dashboard</h5>
                    </a>
                </li>
                <?php endif  ?>
                <li>
                    <a href="index.php"><i class="uil uil-user"></i>
                        <h5>User Profile</h5>
                    </a>
                </li>
                <li>
                    <a href="forms.php" class="active"><i class="uil uil-postcard"></i>
                        <h5>Forms</h5>
                    </a>
                </li>
                <li>
                    <a href="available-courses.php"><i class="uil uil-books"></i>
                        <h5>Available Subjects</h5>
                    </a>
                </li>
                <?php if ($_SESSION['user_is_admin'] == 2) :  ?>
                    <li>
                        <a href="manage-users.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage Students</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-admin.php"><i class="uil uil-edit"></i>
                            <h5>Manage Admins</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-posts.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage Post</h5>
                        </a>
                    </li>
                    <li>
                        <a href=" reports.php"><i class="uil uil-list-ul"></i>
                            <h5>Reports</h5>
                        </a>
                    </li>
                <?php elseif ($_SESSION['user_is_admin'] == 1) :  ?>
                    <li>
                        <a href="manage-users.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage Students</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-posts.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage Post</h5>
                        </a>
                    </li>
                <?php elseif ($_SESSION['user_is_admin'] == 0) :  ?>
                    <li>
                        <a href="registered-courses.php"><i class="uil uil-book"></i>
                            <h5>Registered Subjects</h5>
                        </a>
                    </li>
                    <li>
                        <a href="payment-history.php"><i class="uil uil-book"></i>
                            <h5>Payment History</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Available Forms</h2>
            <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                <button id="add-form" class="btn btn-edit">Upload Form</button>
            <?php endif ?>
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Download</th>
                        <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                            <th>Edit</th>
                            <th>Delete</th>
                        <?php endif  ?>
                    </tr>
                </thead>
                <tbody>


                    <?php if (mysqli_num_rows($forms) > 0) : ?>
                        <?php while ($form = mysqli_fetch_assoc($forms)) : ?>
                            <tr>
                                <td><?= $form['title'] ?></td>
                                <td><?= $form['date_time'] ?></td>
                                <td><a href="<?= ROOT_URL ?>php/download-form.php?id=<?= $form['id'] ?>" target="_blank" class="btn sm">Download</a></td>
                                <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                                    <td><button id="<?= $form['id'] ?>" name="edit-fomr-btn" class="edit-document-btn edtBtn">Edit</button></td>
                                    <td><a onclick="validate(this)" href="<?= ROOT_URL ?>php/delete-form.php?id=<?= $form['id'] ?>" class="btn sm danger">Delete</a></td>
                                <?php endif  ?>
                            </tr>
                        <?php endwhile ?>
                    <?php else :  ?>
                        <tr>
                            <td colspan="5"> No forms uploaded</td>
                        </tr>
                    <?php endif  ?>

                </tbody>
            </table>

        </main>
    </div>
</section>


<!-- ******************** End OF FORM SECTION *********************** -->


<!-- ******************** UPLOAD AND EDIT FORM SECTION *********************** -->
<div id="modal-edit-inactive4"></div>
<div id="modal-edit-form4">
    <section class="form_section ">
        <div class="container form_section-container">
            <h2>Edit Form Document</h2>
            <form action="" id="edit-document-form" enctype="multipart/form-data">
                <input type="hidden" name="id" value="" id="edit_id" placeholder="Subject Id">
                <input type="hidden" name="prev_form_name" value="" id="form_thumbnail" placeholder="Prev thumbnail">

                <div class="form_control">
                    <label for="thumbnail">Update Document</label>
                    <input type="file" name="document" id="thumbnail">
                </div>
                <input type="text" name="title" value="" id="form_title" placeholder="Title">

                <div class="control">
                    <button id="cancel-edit-form" class="btn-lg">Cancel</button>
                    <button type="submit" name="submit" id="update-form" class="btn-lg">Update Form</button>
                </div>

            </form>
        </div>
    </section>
</div>
<div id="modal-add-form4">
    <section class="form_section add-document-form">
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
            <form enctype="multipart/form-data">
                <div class="form_control">
                    <label for="thumbnail">Select Document</label>
                    <input type="file" name="document" id="thumbnail">
                </div>
                <input type="text" name="title" value="" placeholder="Title">
                <div class="control">
                    <button name="cancel" id="cancel-form" class="btn-lg">Cancel</button>
                    <button type="Submit" name="submit" id="save-form" class="btn-lg">Upload New Form</button>
                </div>

            </form>
        </div>
    </section>
</div>

<!-- ******************** UPLOAD AND EDIT FORM SECTION *********************** -->
<script src="../js/edit-form.js"></script>
<script src="../js/add-form.js"></script>
<?php
include '../partials/footer.php';
?>