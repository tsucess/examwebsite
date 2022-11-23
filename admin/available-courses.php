<?php
include './partials/header.php';


if (isset($_SESSION['user_is_admin'])) {

    //fetch all subjects from database
    $query = "SELECT id, subject, subject_code, start_date, end_date, fee FROM subjects ORDER BY id DESC";
    $subjects = mysqli_query($dbconnect, $query);
}
?>

<section class="dashboard">
    <?php if (isset($_SESSION['select'])) : // shows if edit post was Not successful 
    ?>
        <div class="alert_message error container">
            <p> <?= $_SESSION['select'];
                unset($_SESSION['select']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['register'])) : // shows if Register subject post was Not successful 
    ?>
        <div class="alert_message error container">
            <p> <?= $_SESSION['register'];
                unset($_SESSION['register']);
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
                    <a href="forms.php"><i class="uil uil-postcard"></i>
                        <h5>Forms</h5>
                    </a>
                </li>
                <li>
                    <a href="available-courses.php" class="active"><i class="uil uil-books"></i>
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
            <div class="control">
                <h2>Registeration</h2>
                <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                    <button id="add-course" class="btn btn-edit">Add Subject</button>
                <?php endif ?>
            </div>
            <table class="tb-courses">
                <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Code</th>
                            <th>Duration</th>
                            <th>Fee (MYR)</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($subjects) > 0) : ?>
                            <?php while ($subject = mysqli_fetch_assoc($subjects)) : ?>
                                <?php
                                $_SESSION['rowId'] = $subject['id'];
                                ?>
                                <tr>
                                    <td><?= $subject['subject'] ?></td>
                                    <td><?= $subject['subject_code'] ?></td>
                                    <td><b>From:</b> <?= $subject['start_date'] ?> <br><b>To:</b> <?= $subject['end_date'] ?></td>
                                    <td><?= $subject['fee'] ?>.00</td>
                                    <td><button id="<?= $subject['id'] ?>" name="edit-btn" class=" edit-course edtBtn">Edit</button></td>
                                    <td><a onclick="validate(this)" href="<?= ROOT_URL ?>php/delete-course.php?id=<?= $subject['id'] ?>" class="btn sm danger">Delete</a></td>
                                </tr>
                            <?php endwhile ?>

                            <tr>
                                <td colspan="6"></td>
                            </tr>
                        <?php else :  ?>
                            <tr>
                                <td colspan="6"> No forms uploaded</td>
                            </tr>
                            <tr>
                                <td colspan="6"></td>
                            </tr>
                        <?php endif  ?>
                    </tbody>
                <?php else :  ?>

                    <form action="<?= ROOT_URL ?>admin/summary.php" method="POST">
                        <div class="control" id="session_year">
                            <div class="form_control">
                                <label for="">SESSION</label>
                                <select name="session">
                                    <!-- <option value="">SESSION</option> -->
                                    <option value="1">MAY/JUNE</option>
                                    <option value="0">OCT/NOV</option>
                                </select>
                            </div>
                            <div class="form_control">
                                <label>YEAR</label>
                                <select name="year">
                                    <!-- <option value="">SESSION</option> -->
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2020">2020</option>
                                    <option value="2030">2030</option>
                                    <option value="2031">2031</option>
                                    <option value="2032">2032</option>
                                </select>

                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Code</th>
                                <th>Duration</th>
                                <th>Fee (MYR)</th>
                                <th><input type="checkbox" onchange="checkAll(this)" class="checkboxes" id="markall"> <br> <label for="markall">Select</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($subjects) > 0) : ?>
                                <?php while ($subject = mysqli_fetch_assoc($subjects)) : ?>
                                    <tr>
                                        <td><?= $subject['subject'] ?></td>
                                        <td><?= $subject['subject_code'] ?></td>
                                        <td><b>From:</b> <?= $subject['start_date'] ?> <br><b>To:</b> <?= $subject['end_date'] ?></td>
                                        <td><?= $subject['fee'] ?>.00</td>
                                        <td><label for="<?= $subject['id'] ?>"></label> <input type="checkbox" name="subjects[]" class="checkboxes" value="<?= $subject['id'] ?>"></td>
                                    </tr>
                                <?php endwhile ?>

                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2"> <input class="btn" type="submit" name="submit" value="Register"></td>
                                </tr>
                            <?php else :  ?>
                                <tr>
                                    <td colspan="5"> No forms uploaded</td>
                                </tr>
                            <?php endif  ?>
                        </tbody>
                    <?php endif  ?>
            </table>
            </form>

        </main>
    </div>
</section>

<script>
    let checkboxes = document.querySelectorAll(".checkboxes");

    function checkAll(markAll) {
        if (markAll.checked == true) {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
            });
        } else {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
    }
</script>

<!-- ******************** End OF AVAILABLE COURSES SECTION *********************** -->

<div id="modal-edit-inactive"></div>
<div id="modal-add">
    <section class="form_section add-course-form">
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
            <form action="" enctype="multipart/form-data" method="POST">
                <input type="text" name="subject" value="" placeholder="Subject Title">
                <input type="text" name="subjectcode" value="" placeholder="Code">
                <div class="control">
                    <div class="form_control">
                        <label for="thumbnail">Start Date</label>
                        <input type="date" min="2022-01-01" max="2050-12-31" id name="start_date" value="" placeholder="dd-mm-yyyy">
                    </div>
                    <div class="form_control">
                        <label for="thumbnail">End Date</label>
                        <input type="date" min="2022-01-01" max="2050-12-31" id name="end_date" value="" placeholder="dd-mm-yyyy">
                    </div>
                </div>
                <input type="text" name="fee" value="" placeholder="Fee">
                <div class="form_control">
                    <label for="thumbnail">Add Course Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail">
                </div>
                <div class="control">
                    <button name="cancel" id="cancel-add" class="btn-lg">Cancel</button>
                    <button type="Submit" name="submit" id="save" class="btn-lg">Add New Subject</button>
                </div>

            </form>
        </div>
    </section>
</div>
<div id="modal-edit">
    <section class="form_section edit-course-form">
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

            <form id="edit-subject-form" enctype="multipart/form-data">
                <input type="hidden" name="id" value="" id="edit_id" placeholder="Subject Id">
                <input type="hidden" name="prev_thumbnail_name" value="" id="edit_thumbnail" placeholder="Prev thumbnail">

                <input type="text" name="subject" value="" id="edit_subject" placeholder="Subject Title">
                <input type="text" name="subjectcode" value="" id="edit_subjectcode" placeholder="Code">
                <div class="control">
                    <div class="form_control">
                        <label for="thumbnail">Start Date</label>
                        <input type="date" min="2022-01-01" max="2050-12-31" id="start_date" name="start_date" value="" placeholder="dd-mm-yyyy">
                    </div>
                    <div class="form_control">
                        <label for="thumbnail">End Date</label>
                        <input type="date" min="2022-01-01" max="2050-12-31" id="end_date" name="end_date" value="" placeholder="dd-mm-yyyy">
                    </div>
                </div>
                <input type="text" name="fee" value="" id="edit_fee" placeholder="Fee">
                <div class="form_control">
                    <label for="thumbnail">Edit Course Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail">
                </div>
                <div class="control">
                    <button id="cancel-edit" name="" class="btn-lg">Cancel</button>
                    <button type="submit" id="update" class="btn-lg">Update Subject</button>
                </div>

            </form>
        </div>
    </section>
</div>

<script src="../js/edit-course.js"></script>
<script src="../js/add-course.js"></script>
<?php
include '../partials/footer.php';
?>