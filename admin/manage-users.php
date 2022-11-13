<?php
include './partials/header.php';

//fetch all forms from database
$query = "SELECT id, full_name, passport_no, nationality, dob, gender  FROM users ORDER BY id DESC";
$users = mysqli_query($dbconnect, $query);

?>

<section class="dashboard m-users">
    <?php if (isset($_SESSION['signup-success'])) : ?>
        <div class="alert_message success container">
            <p> <?= $_SESSION['signup-success'];
                unset($_SESSION['signup-success']);
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
                    <a href="available-courses.php"><i class="uil uil-books"></i>
                        <h5>Available Subjects</h5>
                    </a>
                </li>
                <?php if ($_SESSION['user_is_admin'] == 2) :  ?>
                    <li>
                        <a href="manage-users.php" class="active"><i class="uil uil-users-alt"></i>
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
                        <a href="manage-users.php" class="active"><i class="uil uil-users-alt"></i>
                            <h5>Manage Students</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Students</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>NIRC/Passport Number</th>
                        <th>Nationality</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                            <tr>
                                <td><?= $user['full_name'] ?></td>
                                <td><?= $user['dob'] ?></td>
                                <td><?= $user['gender'] ? 'Male' : 'Female'; ?></td>
                                <td><?= $user['passport_no'] ?></td>
                                <td><?= $user['nationality'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>php/delete-user.php?id=<?= $user['id'] ?>" class="btn sm danger">Delete</a></td>
                            </tr>
                        <?php endwhile ?>
                </tbody>
            </table>
            <a href="add-user.php" class="btn lg btn-edit">Register Student</a>
        </main>
    </div>
</section>


<!-- ******************** End OF CATEGORY BUTTONS *********************** -->




<?php
include '../partials/footer.php';
?>