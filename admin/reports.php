<?php
include './partials/header.php';
include "../php/filter-function.php";

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
                        <a href=" reports.php" class="active"><i class="uil uil-list-ul"></i>
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
        <main id="report">
            <h2>Report</h2>
            <form action="" enctype="multipart/form-data" method="POST">
                <div class="control">
                    <!-- <div class="form_control">
                        <button name="submit" class="btn-lg">Print Report</button>
                    </div> -->
                    <div class="form_control">
                        <select name="filter" id="filter">
                            <option value="" disabled hidden selected>FILTER</option>
                            <option value="default">ALL</option>
                            <option value="year">YEAR ONLY</option>
                            <option value="yearsession">YEAR AND SESSION</option>
                            <option value="others">OTHERS</option>
                        </select>
                    </div>
                </div>
                <div class="control">
                    <div class="form_control">
                        <select name="year" id="years">
                            <option disabled hidden selected>YEAR</option>
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
                    <div class="form_control">
                        <select name="session" id="sessions">
                            <option disabled hidden selected>SESSION</option>
                            <option value="1">MAY/JUNE</option>
                            <option value="0">OCT/NOV</option>
                        </select>
                    </div>

                </div>
                <div class="control">
                    <div class="form_control">
                        <select name="others" id="others">
                            <option disabled hidden selected>OTHERS</option>
                            <option value="success">SUCCESSFUL APPLICANTS</option>
                            <option value="pending">PENDING APPLICATIONS</option>
                        </select>
                    </div>
                </div>
                <div class="report" id="report-section">
                    <h2>Resgistered Students</h2>
                    <table id="madmin_tb">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Year/Session</th>
                                <th>Name</th>
                                <th>Registered Courses</th>
                                <th>Payment Status</th>

                            </tr>
                        </thead>
                        <tbody id="table_body">
                            <?php

                            $subjects = getAllData();

                            foreach ($subjects as $subject) {

                                $student_id = $subject['student_id'];
                                $user_query = "SELECT firstname, lastname FROM users WHERE id = $student_id";
                                $user_result = mysqli_query($dbconnect, $user_query);
                                $student = mysqli_fetch_assoc($user_result);
                            ?>
                                <tr>
                                    <td><?= $subject['date_time'] ?></td>
                                    <td><?= $subject['session'] ? 'MAY/JUNE' : 'OCT/NOV' ?></td>
                                    <td><?= "{$student['firstname']} {$student['lastname']}" ?></td>
                                    <td><?= $subject['subject'] ?></td>
                                    <td><?= $subject['payment_status'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <button class="btn lg btn-edit" onclick="window.print()">Print Report</button>
        </main>
    </div>
</section>

<!-- ******************** End OF FORM SECTION *********************** -->






<script src="../js/filter.js"></script>
<script src="../js/report.js"></script>
<?php
include '../partials/footer.php';
?>