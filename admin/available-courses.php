<?php
include './partials/header.php';



//fetch all subjects from database
$query = "SELECT id, subject, subject_code, option_code, fee FROM subjects ORDER BY id DESC";
$subjects = mysqli_query($dbconnect, $query);

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
    <?php endif ?>
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="index.php"><i class="uil uil-user"></i>
                        <h5>User Information</h5>
                    </a>
                </li>
                <li>
                    <a href="forms.php"><i class="uil uil-postcard"></i>
                        <h5>Forms</h5>
                    </a>
                </li>
                <li>
                    <a href="registered-courses.php"><i class="uil uil-book"></i>
                        <h5>Registered Subjects</h5>
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
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Available Subjects</h2>
            <form class="except" action="<?= ROOT_URL ?>admin/summary.php" method="POST">
                <table class="tb-courses">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Code</th>
                            <th>Duration</th>
                            <th>Fee (MYR)</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($subject = mysqli_fetch_assoc($subjects)) : ?>
                            <tr>
                                <td><?= $subject['subject'] ?></td>
                                <td><?= $subject['subject_code'] ?></td>
                                <td><?= $subject['option_code'] ?></td>
                                <td><?= $subject['fee'] ?>.00</td>
                                <td><input type="checkbox" name="subjects[]" value="<?= $subject['id'] ?>"></td>
                            </tr>
                        <?php endwhile ?>

                        <tr>
                            <td colspan="3"><b>Total</b></td>
                            <td colspan="2"><input class="btn" type="submit" name="submit" value="Register"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                <a href="add-course.php" class="btn lg btn-edit">Add Subject</a>
                <a href="manage-courses.php" class="btn lg btn-edit">Manage Subject</a>
            <?php endif ?>
        </main>
    </div>
</section>


<!-- ******************** End OF FORM SECTION *********************** -->

<?php
include '../partials/footer.php';
?>