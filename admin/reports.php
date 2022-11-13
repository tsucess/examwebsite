<?php
include './partials/header.php';
?>

<section class="dashboard">
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="dashboard.php"><i class="uil uil-user"></i>
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
                <li>
                    <a href="manage-admin.php"><i class="uil uil-edit"></i>
                        <h5>Manage Admins</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-users.php" ><i class="uil uil-users-alt"></i>
                        <h5>Manage Students</h5>
                    </a>
                </li>
                <li>
                    <a href=" reports.php" class="active"><i class="uil uil-list-ul"></i>
                        <h5>Reports</h5>
                    </a>
                </li>
            </ul>
        </aside>
        <main class="report">
            <h2>Report</h2>
            <h3>Date: 01 November 2022</h3>
            <table>
                <thead>
                    <tr>
                        <th>Number of Registerd Students</th>
                        <th>Number of Successful Applicants</th>
                        <th>Pending Application as a result of Payment</th>
                        <th>Pending Application as a result of Document</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1400</td>
                        <td>700</td>
                        <td>450</td>
                        <td>250</td>
                    </tr>
                </tbody>
            </table>
            <a href="" class="btn lg btn-edit">Print Report</a>
        </main>
    </div>
</section>


<!-- ******************** End OF FORM SECTION *********************** -->

<?php
include '../partials/footer.php';
?>