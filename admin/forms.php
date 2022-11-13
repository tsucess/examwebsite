<?php
include './partials/header.php';

//fetch all forms from database
$query = "SELECT id, title, date_time FROM forms ORDER BY id DESC";
$forms = mysqli_query($dbconnect, $query);
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
                    <a href="forms.php" class="active"><i class="uil uil-postcard"></i>
                        <h5>Forms</h5>
                    </a>
                </li>
                <li>
                    <a href="registered-courses.php"><i class="uil uil-book"></i>
                        <h5>Registered Subjects</h5>
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
            <h2>Available Forms</h2>
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($form = mysqli_fetch_assoc($forms)) : ?>
                        <tr>
                            <td><?= $form['title'] ?></td>
                            <td><?= $form['date_time'] ?></td>
                            <td><a href="<?= ROOT_URL ?>php/download-form.php?id=<?= $form['id'] ?>" target="_blank" class="btn sm">Download</a></td>
                        </tr>
                    <?php endwhile ?>

                </tbody>
            </table>
            <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
            <a href="add-form.php" class="btn lg btn-edit">Upload Form</a>
            <a href="manage-forms.php" class="btn lg btn-edit">Manage Forms</a>
            <?php endif  ?>

        </main>
    </div>
</section>


<!-- ******************** End OF FORM SECTION *********************** -->

<?php
include '../partials/footer.php';
?>