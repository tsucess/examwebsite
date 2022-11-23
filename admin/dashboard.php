<?php
include './partials/header.php';
?>

<section class="dashboard">
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
            <?php if ($_SESSION['user_is_admin'] == 1 || $_SESSION['user_is_admin'] == 2) :  ?>
                <li>
                    <a href="dashboard.php" class="active"><i class="uil uil-dashboard"></i>
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
                        <a href="payment-history.php"><i class="uil uil-book"></i>
                            <h5>Payment History</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main class="report">
            <?php

            // ALL STUDENTS SIGNED UP 
            $count_all_sql = "SELECT COUNT(*) AS count FROM users";
            $conut_all_query = mysqli_query($dbconnect, $count_all_sql);

            while ($all_row = mysqli_fetch_assoc($conut_all_query)) {
                $all_result = $all_row['count'];
            }
            // REGISTERED STUDENTS 
            $count_reg_sql = "SELECT COUNT(*) AS count FROM registered_subjects";
            $conut_reg_query = mysqli_query($dbconnect, $count_reg_sql);

            while ($row = mysqli_fetch_assoc($conut_reg_query)) {
                $reg_result = $row['count'];
            }

            // SUCCESSFULL APPLICANTS 
            $count_success_sql = "SELECT COUNT(*) AS count FROM registered_subjects WHERE payment_status = 'success'";
            $conut_success_query = mysqli_query($dbconnect, $count_success_sql);

            while ($success_row = mysqli_fetch_assoc($conut_success_query)) {
                $success_result = $success_row['count'];
            }

            //PENDING APPLICANTS
            $count_pending_sql = "SELECT COUNT(*) AS count FROM registered_subjects WHERE payment_status = 'pending'";
            $conut_pending_query = mysqli_query($dbconnect, $count_pending_sql);

            while ($pending_row = mysqli_fetch_assoc($conut_pending_query)) {
                $pending_result = $pending_row['count'];
            }

            ?>
            <h2>Dashboard</h2>
            <div class="row">
                <div class="cards">
                    <div class="card one">
                        <h3>Total Number of Students</h3>
                        <span><?= $all_result ?></span>
                    </div>
                    <div class="card three">
                        <h3>Number of Registered Students</h3>
                        <span><?= $reg_result ?></span>
                    </div>
                    <div class="card two">
                        <h3>Number of Successful Applications</h3>
                        <span><?= $success_result ?></span>
                    </div>
                    <div class="card fourth">
                        <h3>Pending Applications</h3>
                        <span><?= $pending_result ?></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cards">
                    <div class="g-card" id="Chart">
                        <h3>Number of Registered Students</h3>
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>
</section>


<!-- ******************** End OF FORM SECTION *********************** -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc.1/dist/chartjs-plugin-datalabels.min.js" integrity="sha256-Oq8QGQ+hs3Sw1AeP0WhZB7nkjx6F1LxsX6dCAsyAiA4=" crossorigin="anonymous"></script>
<script src="../js/dashboardjs/chart.js"></script>
<?php
include '../partials/footer.php';
?>


