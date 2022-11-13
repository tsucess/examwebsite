<?php
include './partials/header.php';

//fetch all forms from database
$query = "SELECT id, title, date_time FROM forms ORDER BY id DESC";
$users = mysqli_query($dbconnect, $query);

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
            <h2>Edit Forms</h2>
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($form = mysqli_fetch_assoc($forms)) : ?>
                        <tr>
                            <td><?= $form['title'] ?></td>
                            <td><?= $form['date_time'] ?></td>
                            <td><a href="<?= ROOT_URL ?>admin/edit-form.php?id=<?= $form['id'] ?>" class="btn sm">Edit</a></td>
                            <td><a href="<?= ROOT_URL ?>php/delete-form.php?id=<?= $form['id'] ?>" class="btn sm danger">Delete</a></td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </main>
    </div>
</section>


<!-- ******************** End OF FORM SECTION *********************** -->

<?php
include '../partials/footer.php';
?>