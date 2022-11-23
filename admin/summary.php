<?php
include './partials/header.php';



   
if (isset($_POST['submit'])) {
    $session = $_POST['session'];
    $year = $_POST['year'];
}

?>

<section class="invoice_section">
    <div class="top_head">
        <img id="logo" src="<?= ROOT_URL ?>/img/logo.png" alt="logo">
        <h2 class="nav_logo">SEVEN SKIES IGCSE EXAM CENTER</h2>
    </div>
    <div id="summary" class="container invoice_section-container ">
        <div class="control">
            <h2>Selected Subjects</h2>
            <div class="form-control">
                <h3>Year: <?= $year ?></h3>
                <h3>Session: <?= $session ? 'MAY/JUNE' : 'OCT/NOV'?></h3>
            </div>
        </div>
        
        <form action="<?= ROOT_URL ?>php/summary-logic.php" method="POST">
            <table class="invoice">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Subject</th>
                        <th id="fee">Fee (MYR)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['submit'])) {
                        $subjects = $_POST['subjects']; 
                        $price = 0.0;

                        if (!empty($subjects)) {
                            foreach ($subjects as $item) {
                                //fetch all subjects from database
                                $query = "SELECT  subject, subject_code, fee FROM subjects WHERE id= $item ORDER BY id DESC";
                                $subject_result = mysqli_query($dbconnect, $query);
                                while ($subject = mysqli_fetch_assoc($subject_result)) {


                    ?>

                                    <tr>
                                        <td><?= $subject['subject_code'] ?></td>
                                        <td><?= $subject['subject'] ?></td>
                                        <td><?= $subject['fee'] ?>.00</td>
                                    </tr>
                    <?php
                                    $price = $price + $subject['fee'];
                                }
                            }
                            $_SESSION['subjects'] = $subjects;
                            $_SESSION['session'] = $session;
                            $_SESSION['year'] = $year;
                            $_SESSION['price'] = $price;
                        } else {
                            $_SESSION['select'] = "Please Select your Subjects";
                            header('location: ' . ROOT_URL . 'admin/available-courses.php');
                            die();
                        }
                    }
                    ?>


                    <tr>
                        <td colspan="2"><b>Total</b></td>
                        <td><b><?= $price ?>.00</b></td>

                    </tr>
                </tbody>
            </table>
            <div class="control">
                <a href="available-courses.php" class="btn-lg" name="cancel">Cancel</a>
                <input type="submit" class="btn-lg" name="submit" value="Proceed to Payment">
            </div>

        </form>

    </div>
</section>

<script src="./js/main.js"></script>
</body>

</html>