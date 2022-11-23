<?php
include './partials/header.php';
include "../php/filter-function.php";


//fetch all forms from database
// $query = "SELECT * FROM registered_subjects ORDER BY id DESC LIMIT 5";
// $subjects = mysqli_query($dbconnect, $query);


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
                        <a href="payment-history.php" class="active"><i class="uil uil-book"></i>
                            <h5>Payment History</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main id="report">
            <h2>Payment History</h2>
            <form action="" enctype="multipart/form-data" method="POST">

                <div class="report">
                    <table id="madmin_tb">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Year/Session</th>
                                <th>Registered Courses</th>
                                <th>Amount</th>
                                <th>Payment Status</th>

                            </tr>
                        </thead>
                        <tbody id="table_body">
                            <?php
                            $current_user_id = $_SESSION['id'];

                                $user_query = "SELECT rs.subject, rs.session, rs.year, rs.date_time, rs.payment_status, rs.amount, u.firstname, u.lastname  FROM registered_subjects rs, users u WHERE rs.student_id = $current_user_id ";
                                $user_result = mysqli_query($dbconnect, $user_query);
                                $student = mysqli_fetch_assoc($user_result)
                            ?>
                                <tr>
                                    <td><?= $student['date_time'] ?></td>
                                    <td><?= $student['session'] ? 'MAY/JUNE' : 'OCT/NOV' ?></td>
                                    <td><?= $student['subject'] ?></td>
                                    <td><?= $student['amount'] ?></td>
                                    <td><?= $student['payment_status'] ?></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
        </main>
    </div>
</section>

<!-- ******************** End OF FORM SECTION *********************** -->

<?php
include '../partials/footer.php';
?>