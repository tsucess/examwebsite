<?php
include './partials/header.php';


// fetch data from database 
$featured_query = "SELECT * FROM posts WHERE is_featured";
$featured_result = mysqli_query($dbconnect, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);


// fetch 3 posts from posts table
$query = "SELECT * FROM subjects ORDER BY date_time DESC LIMIT 3";
$subjects = mysqli_query($dbconnect, $query);

?>

<section class="dashboard" hidden>
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
    </div>
</section>

<!-- ******************** Start OF Carousel Section *********************** -->
<section class="carousel">
    <div class="carousel_container">
        <div class="carousel_image fade">
            <img src="./img/img1.jpeg" alt="">
        </div>
        <div class="carousel_image fade">
            <img src="./img/img2.jpeg" alt="">
        </div>
        <div class="carousel_image fade">
            <img src="./img/img3.jpeg" alt="">
        </div>
        <!--
            <div class="carousel_image fade">
                <img src="./img/image5.jpg" alt="">
            </div>
            <div class="carousel_image fade">
                <img src="./img/image6.jpg" alt="">
            </div>
            -->
        <i id="prev" onclick="showImage(-1)" class="fa-solid fa-angle-left"></i>
        <i id="next" onclick="showImage(1)" class="fa-solid fa-angle-right"></i>

    </div>
</section>
<!-- ******************** End OF Carousel Section *********************** -->

<!-- ********************  Course Section *********************** -->
<section class="courses">

    <h2 class="heading">Available subjects</h2>
    <div class="container courses_container">
        <?php while ($subject = mysqli_fetch_assoc($subjects)) : ?>
            <article id="course">
                <div class="course_thumbnail">
                    <img src="./img/thumbnail/<?= $subject['thumbnail'] ?>">
                </div>
                <div class="course_info">
                    <form action="<?= ROOT_URL ?>php/reg-redirect-logic.php" method="POST">
                        <input type="submit" name="submit" class="category_button" value="Register">
                    </form>
                    <h3 class="course_title">
                        <p><?= $subject['subject'] ?></p>
                    </h3>
                    <p class="course_body">
                        <b>DURATION: </b><?= $subject['duration'] ?>
                    </p>
                </div>
            </article>
        <?php endwhile ?>

    </div>
</section>
<!-- ******************** End OF POST Section *********************** -->

<?php if(mysqli_num_rows($featured_result) == 1) : ?>
<section class="notice">
    <div class="container notice_container">
        <div class="notice_thumbnail">
            <img src="./img/thumbnail/<?= $featured['post_thumbnail']?>" alt="">
        </div>
        <div class="notice_info">
            <h2 class="notice_title heading"><a href="post.php"><?= $featured['title']?></a></h2>
            <p class="notice_body"> <?= $featured['body']?>
            </p>
            <div class="post_author">
                <div class="post_author_info">
                    <small><?= date("M, d, Y - H:i", strtotime($featured['date_time']))?></small>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif ?>
<!-- ******************** End OF Notice Bulletin SECTION *********************** -->
<div id="contact"></div> <br> <br>
<section class="contact">
    <div class="container contact_form">
        <h2 class="heading">Contact Us</h2>
        <form action="">
            <input type="text" class="field" placeholder="Enter Name">
            <input type="text" class="field" placeholder="Enter Email">
            <textarea name="" class="field" id="" cols="30" rows="10" placeholder="Message"></textarea>
            <input type="submit" class="field btn btn-edit" value="Submit" placeholder="Enter Email">
            <!-- <a href="add-notice.php" class="btn btn-edit">Submit</a> -->
        </form>
    </div>
</section>

<!-- ******************** End OF CONTACT SECTION *********************** -->
<script src="./js/carousel.js"></script>
<?php
include './partials/footer.php';
?>