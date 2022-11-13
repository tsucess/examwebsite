<?php
include './partials/header.php';


?>

<section class="invoice_section">
    <div class="container invoice_section-container">
        <h2>Selected Subjects</h2>
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
                                

                        } else{
                            $_SESSION['select'] = "Please Select your Subjects";
                            header('location: '. ROOT_URL . 'admin/available-courses.php');
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

            <input type="submit" class="btn btn-edit" name="submit" value="Proceed to Payment">
        </form>

    </div>
</section>

<script src="./js/main.js"></script>
</body>

</html>