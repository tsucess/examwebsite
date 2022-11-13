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
                    <a href="registered-courses.php" class="active"><i class="uil uil-book"></i>
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
                        <a href="manage-users.php" ><i class="uil uil-users-alt"></i>
                            <h5>Manage Students</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Registerd Subjects</h2>
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Subject</th>
                        
                    </tr>
                </thead>
                <tbody id="reg">
                    <tr>
                        <td>0417</td>
                        <td>Mathematics</td>
                        
                    </tr>
                    <tr>
                        <td>0450</td>
                        <td>Information and Communication Technology</td>
                        
                    </tr>
                    <tr>
                        <td>0412</td>
                        <td>Biology</td>
                       
                    </tr>
                    <tr>
                        <td>20411</td>
                        <td>Business Studies</td>
                    </tr>
                    <tr>
                        <td>0412</td>
                        <td>Information and Communication Technology(Practical)</td>
                    </tr>
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