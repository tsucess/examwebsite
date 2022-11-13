<?php
include './partials/header.php';

//fetch all forms from database
$query = "SELECT id, subject, subject_code, option_code, fee FROM subjects ORDER BY id DESC";
$subjects = mysqli_query($dbconnect, $query);

?>

<section class="dashboard">
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
            <h2>Manage Subjects</h2>
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Code</th>
                        <th>Option Code</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <form class="except" action="">
                        <?php while ($subject = mysqli_fetch_assoc($subjects)) : ?>
                            <tr>
                                <td><?= $subject['subject'] ?></td>
                                <td><?= $subject['subject_code'] ?></td>
                                <td><?= $subject['option_code'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-course.php?id=<?= $subject['id'] ?>" class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>php/delete-course.php?id=<?= $subject['id'] ?>" class="btn sm danger">Delete</a></td>
                            </tr>
                        <?php endwhile ?>
                    </form>

                </tbody>
            </table>
            <a href="available-courses.php" class="btn lg btn-edit">Back</a>
        </main>
    </div>
</section>

<!-- ******************** End OF FORM SECTION *********************** -->

<?php
include '../partials/footer.php';
?>