<?php
include './partials/header.php';

// fetch all Subjectss from posts table
$query = "SELECT * FROM subjects ORDER BY date_time DESC";
$subjects = mysqli_query($dbconnect, $query);
?>
<section class="dashboard" hidden>
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
    </div>
</section>

<!-- ********************  Course Section *********************** -->
<section class="course">
    <h2 class="heading">Subjects</h2>
    <div class="container courses_container">

        <?php while($subject = mysqli_fetch_assoc($subjects)) : ?>
            <article class="course">
                <div class="course_thumbnail">
                <img src="./img/thumbnail/<?= $subject['thumbnail'] ?>">
                </div>
                <div class="course_info">
                    <a href="./category-posts.php" class="category_button">Register</a>
                    <h3 class="course_title">
                        <p><?= $subject['subject'] ?></p>
                    </h3>
                    <p class="course_body">
                       <b>DURATION: </b><?= $subject['option_code']?>
                    </p>
                </div>
            </article>
            <?php endwhile ?>
        
   
       

    </div>
</section>

<!-- ******************** End of POST Section *********************** -->

<?php
include './partials/footer.php';

?>