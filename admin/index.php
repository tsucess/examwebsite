<?php
include './partials/header.php';

//fetch current user's Information from database
if (isset($_SESSION['user_is_admin'])) {

    $current_user_id = $_SESSION['id'];

    if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) {
        $admin_query = "SELECT firstname, lastname, passport_no, nationality, gender FROM admins WHERE id = $current_user_id LIMIT 1";
        $admin_info = mysqli_query($dbconnect, $admin_query);
        $admin = mysqli_fetch_assoc($admin_info);

    } else {
        $user_query = "SELECT full_name, passport_no, nationality, dob, gender FROM users WHERE id = $current_user_id LIMIT 1";
        $user_info = mysqli_query($dbconnect, $user_query);
        $user = mysqli_fetch_assoc($user_info);
    }
}

?>

<section class="dashboard">
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="index.php" class="active"><i class="uil uil-user"></i>
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
        <main id="user">
            <h2>User Information</h2>
            <table>
                <tbody>
                    <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                        <tr>
                            <td><b> Name:</b></td>
                            <td><?= "{$admin['firstname']} {$admin['lastname']}" ?></td>
                        </tr>
                        <tr>
                            <td><b> Nationality:</b></td>
                            <td><?= $admin['nationality'] ?></td>
                        </tr>
                        <tr>
                            <td><b> Gender:</b></td>
                            <td><?= $admin['gender'] ? 'Male' : 'Female'  ?></td>
                        </tr>
                        <tr>
                            <td><b> NIRC/Passport ID Number:</b></td>
                            <td><?= $admin['passport_no'] ?></td>
                        </tr>
                    <?php else : ?>
                        <tr>
                            <td><b> Name:</b></td>
                            <td><?= $user['full_name'] ?></td>
                        </tr>
                        <tr>
                            <td><b> Date of Birth:</b></td>
                            <td><?= $user['dob'] ?></td>
                        </tr>
                        <tr>
                            <td><b> Nationality:</b></td>
                            <td><?= $user['nationality'] ?></td>
                        </tr>
                        <tr>
                            <td><b> Gender:</b></td>
                            <td><?= $user['gender'] ? 'Male' : 'Female'  ?></td>
                        </tr>
                        <tr>
                            <td><b> NIRC/Passport ID Number:</b></td>
                            <td><?= $user['passport_no'] ?></td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
            <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                <a href="<?= ROOT_URL ?>admin/edit-admin.php?id=<?= $current_user_id ?>" class="btn lg btn-edit">Edit</a>
                <a href="add-notice.php" class="btn lg btn-edit">Add Notice</a>
                <?php else :  ?>
                    <a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $current_user_id ?>"  class="btn lg btn-edit">Edit</a>
            <?php endif  ?>
        </main>
    </div>
</section>
<!-- ******************** End OF CATEGORY BUTTONS *********************** -->

<?php
include '../partials/footer.php';
?>