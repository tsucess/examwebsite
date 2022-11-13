<?php
include './partials/header.php';

// fetch all users except the current user 

$current_admin_id = $_SESSION['id'];
// $current_admin_id = 3;

$query = "SELECT * FROM admins WHERE NOT id = $current_admin_id";
$admins = mysqli_query($dbconnect, $query);

?>

<section class="dashboard m-users">
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
                        <a href="manage-users.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage Students</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-admin.php" class="active"><i class="uil uil-edit"></i>
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
            <h2>Manage Admin</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>NIRC/Passport Number</th>
                        <th>Nationality</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($admin = mysqli_fetch_assoc($admins)): ?>
                    <tr>
                        <td><?= "{$admin['firstname']} {$admin['lastname']}" ?></td>
                        <td><?= $admin['gender'] ? 'Male' : 'Female' ?></td>
                        <td><?= $admin['passport_no'] ?></td>
                        <td><?= $admin['nationality'] ?></td>
                        <td><?= $admin['is_super_admin'] == 2 ? 'Super Admin' : 'Admin' ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-admin.php?id=<?= $admin['id'] ?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>php/delete-admin.php?id=<?= $admin['id'] ?>" class="btn sm danger">Delete</a></td>
                    </tr>
                   <?php endwhile ?>
                </tbody>
            </table>
            <a href="add-admin.php" class="btn lg btn-edit">Add Admin</a>
        </main>
    </div>
</section>


<!-- ******************** End OF CATEGORY BUTTONS *********************** -->




<?php
include '../partials/footer.php';
?>