<?php
include './partials/header.php';



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
    <!-- ******************** End OF POST Section *********************** -->

    <section class="notice">
        <div class="container notice_container">
            <div class="notice_thumbnail">
                <img src="./img/nodp.png" alt="">
            </div>
            <div class="notice_info">
                <h2 class="notice_title heading"><a href="post.php">Notice Bulletin</a></h2>
                <p class="notice_body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum asperiores accusantium, voluptas
                    dignissimos enim autem molestiae blanditiis! Eveniet quibusdam ducimus praesentium quisquam ea
                    quidem, eum placeat impedit voluptatibus officiis? Quam.
                    <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum asperiores accusantium, voluptas
                    dignissimos enim autem molestiae blanditiis! Eveniet quibusdam ducimus praesentium quisquam ea
                    quidem, eum placeat impedit voluptatibus officiis? Quam.
                    <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum asperiores accusantium, voluptas
                    dignissimos enim autem molestiae blanditiis! Eveniet quibusdam ducimus praesentium quisquam ea
                    quidem, eum placeat impedit voluptatibus officiis? Quam.
                </p>
                <div class="post_author">
                    <div class="post_author_info">
                        <h5>By: Ogunsanya Taofeeq</h5>
                        <small>September 19, 2022 - 08:30</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ******************** End OF Notice Bulletin SECTION *********************** -->
    <div id="contact"></div> <br> <br>
    <section class="contact">
        <div class="container contact_form">
            <h2 class="heading">Contact Us</h2>
            <form action="">
                <input type="text" class="field" placeholder="Enter Name">
                <input type="text" class="field" placeholder="Enter Email">
                <textarea name="" class="field" id="" cols="30" rows="10" placeholder="Message"></textarea>
            </form>
        </div>
    </section>

    <!-- ******************** End OF CONTACT SECTION *********************** -->

<?php
include './partials/footer.php';

?>