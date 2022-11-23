<?php
include './partials/header.php';

$current_user_id = $_SESSION['id'];

// fetch Subject Registered from registered table 
$fetch_subjects_query = "SELECT subject_id FROM registered_subjects Where student_id = $current_user_id";
$fetch_subject_result = mysqli_query($dbconnect, $fetch_subjects_query);
$subject_ids = mysqli_fetch_assoc($fetch_subject_result);



?>

<section class="dashboard">
    <?php if (isset($_SESSION['register-success'])) : ?>
        <div class="alert_message success">
            <p> <?= $_SESSION['register-success'];
                unset($_SESSION['register-success']);
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
                        <a href="registered-courses.php" class="active"><i class="uil uil-book"></i>
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
            <h2>Registered Subjects</h2>
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Subject</th>

                    </tr>
                </thead>
                <tbody id="reg">
                    <?php
                    $subjectId_array = $subject_ids['subject_id'];
                    $sub_ids = explode(',', $subjectId_array);

                    foreach ($sub_ids as $item) {
                        $query = "SELECT subject, subject_code FROM subjects WHERE id = $item";
                        $subject_result = mysqli_query($dbconnect, $query);

                        while ($subject = mysqli_fetch_assoc($subject_result)) {
                    ?>
                            <tr>
                                <td><?= $subject['subject_code'] ?></td>
                                <td><?= $subject['subject'] ?></td>

                            </tr>
                    <?php    }
                    }

                    ?>

                </tbody>
            </table>
            <a href="invoice.php" class="btn lg btn-edit">Print Invoice</a>
        </main>
    </div>
</section>


<!-- ******************** End OF FORM SECTION *********************** -->

<?php
include '../partials/footer.php';
?>