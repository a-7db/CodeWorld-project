<?php
require APPROOT . '/views/Parts/header.php';
?>

<?php flash('watit_acception'); ?>

<!-- banner section start -->
<section class="banner-section d-flex align-items-center position-relative">
    <!-- bubble animation start -->
    <div class="bubble-animation">
        <div class="bubble-animation-item"></div>
        <div class="bubble-animation-item"></div>
        <div class="bubble-animation-item"></div>
        <div class="bubble-animation-item"></div>
        <div class="bubble-animation-item"></div>
        <div class="bubble-animation-item"></div>
        <div class="bubble-animation-item"></div>
        <div class="bubble-animation-item"></div>
        <div class="bubble-animation-item"></div>
    </div>
    <!-- bubble animation end -->
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="banner-text">
                    <h2 class="mb-3">Learn without limits</h2>
                    <h1 class="mb-3 text-capitalize">Start solving the world's problem</h1>
                    <p class="mb-4">Take the next step toward your personal and professional goals with Code World</p>
                    <?php if (!isLoggedIn()) : ?>
                        <a href="<?php echo URLROOT ?>/Users/register" class="btn btn-theme">join free</a>
                    <?php endif ?>

                </div>
            </div>
            <div class="col-md-6 order-first order-md-last mb-5 mb-md-0">
                <div class="banner-img">
                    <div class="circular-img">
                        <div class="circular-img-inner">

                        </div>
                    </div>
                </div>
                <lottie-player class="lottie-size" src="/CodeWorld-project/lottiefiles/laptop.json" background="transparent" speed="1" loop autoplay></lottie-player>
            </div>
        </div>
    </div>
</section>
<!-- banner section end -->

<!-- fun facts section start -->
<section class="fun-facts-section">
    <div class="container">
        <div class="box py-2">
            <div class="row text-center">
                <div class="col-md-6 col-lg-3">
                    <div class="fun-facts-item">
                        <h2 class="style-1"> <?php echo $data['users']->users ?>+</h2>
                        <p>students we've</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="fun-facts-item">
                        <h2 class="style-2"><?php echo $data['courses']->courses ?>+</h2>
                        <p>courses</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="fun-facts-item">
                        <h2 class="style-3"><?php echo $data['ratings']->rating ?>+</h2>
                        <p>rating</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="fun-facts-item">
                        <h2 class="style-4"><?php echo $data['instructors']->instructors ?>+</h2>
                        <p>skilled instructors</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- fun facts section end -->


<!-- courses section start -->
<section class="courses-section section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="section-title text-center">
                    <h2 class="title">courses</h2>
                    <p class="sub-title">Find the right course for you</p>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- courses item start -->
            <?php foreach ($data['course'] as $crs) : ?>
                <div class="col-md-6 col-lg-3">
                    <div class="courses-item">
                        <a href="/CodeWorld-project<?php echo in_array($crs->crs_ID, $data['IDs']) ?  '/courses/learn/' . $crs->crs_ID . '/' . $crs->slug : '/courses/details/' . $crs->crs_ID . '/' . $crs->slug ?>" class="link">
                            <div class="courses-item-inner">
                                <div class="img-box">
                                    <img src="/CodeWorld-project<?php echo '/images/courses/' . $crs->image ?>" alt="course img">
                                </div>
                                <h3 class="title" style="
                                overflow: hidden;
                                display: -webkit-box;
                                -webkit-line-clamp: 2;
                                -webkit-box-orient: vertical;
                                min-height: 50px;
                                "><?php echo $crs->title ?></h3>
                                <div class="instructor">
                                    <img src="/CodeWorld-project/images/instructor/<?php echo $crs->profile ?>" alt="instructor img">
                                    <span class="instructor-name"><?php echo $crs->fname ?></span>
                                </div>
                                <div class="rating">
                                    <span class="average-rating">(<?php echo number_format($crs->rating, 1) ?>)</span>
                                    <span class="average-stars">
                                        <?php
                                        if ($crs->rating > 0) {
                                            $rating = explode('.', $crs->rating);
                                            $count = empty($rating[1]) ? 0 : 1;
                                            $empty = 5 - ($rating[0] + $count);
                                            while ($rating[0] > 0) {
                                                echo '<i style="margin-right: 3px;"  class="fas fa-star"></i>';
                                                $rating[0]--;
                                            }
                                            echo !empty($rating[1]) ? '<i style="margin-right: 3px;"  class="fas fa-star-half-alt"></i>' : '';
                                            while ($empty > 0) {
                                                echo '<i style="margin-right: 3px;"  class="far fa-star fa-sm"></i>';
                                                $empty--;
                                            }
                                        } else {
                                            for ($i = 0; $i <= 5; $i++) {
                                                echo '<i style="margin-right: 3px;"  class="far fa-star fa-sm"></i>';
                                            }
                                        }
                                        ?>
                                    </span>
                                    <span class="reviews">(<?php echo $crs->count_rating ?>)</span>
                                </div>
                                <div class="price"><?php echo in_array($crs->crs_ID, $data['IDs']) ? 'Watch' : 'SR ' . $crs->price ?></div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- courses item end -->
        </div>
        <div class="row">
            <div class="col-12 text-center mt-3">
                <a href="courses" class="btn btn-theme">view all courses</a>
            </div>
        </div>
    </div>
</section>
<!-- courses section end -->

<!-- testimonials section start -->
<section class="testimonials-section section-padding position-relative">
    <div class="decoration-circles d-none d-lg-block">
        <div class="decoration-circles-item"></div>
        <div class="decoration-circles-item"></div>
        <div class="decoration-circles-item"></div>
        <div class="decoration-circles-item"></div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="section-title text-center">
                    <h2 class="title">students feedback</h2>
                    <p class="sub-title">What our students say</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="img-box rounded-circle position-relative">
                    <img src="<?php echo '/CodeWorld-project/images//profile/' . $data['feedbacks'][0]->profile ?>" class="w-100 js-testimonial-img rounded-circle" alt="testimonial img">
                </div>
                <div id="carouselOne" class="carousel slide text-center" data-bs-ride="carousel">
                    <div class="carousel-inner mb-4">
                        <div class="carousel-item active" data-js-testimonial-img="<?php echo URLROOT . '/images/profile/' . $data['feedbacks'][0]->profile ?>">
                            <div class="testimonials-item">
                                <p class="text-1"><?php echo $data['feedbacks'][0]->content ?></p>
                                <h3><?php echo $data['feedbacks'][0]->fname ?></h3>
                                <p class="text-2"><?php echo $data['feedbacks'][0]->orders ?> courses</p>
                            </div>
                        </div>
                        <?php foreach ($data['feedbacks'] as $comm) : ?>
                            <?php if ($comm != $data['feedbacks'][0]) : ?>
                                <div class="carousel-item" data-js-testimonial-img="<?php echo '/CodeWorld-project/images/profile/' . $comm->profile ?>">
                                    <div class="testimonials-item">
                                        <p class="text-1"><?php echo $comm->content ?></p>
                                        <h3><?php echo $comm->fname ?></h3>
                                        <p class="text-2"><?php echo $comm->orders ?> courses</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselOne" data-bs-slide="prev">
                        <i class="fas fa-arrow-left"></i>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselOne" data-bs-slide="next">
                        <i class="fas fa-arrow-right"></i>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- testimonials section end -->

<?php if (!isLoggedIn()) : ?>
    <!-- become a instructor section start -->
    <section class="bai-section section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="box">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-4 m-md-0">
                                <div class="circular-img">
                                    <!-- <div class="circular-img-inner">
                                    <div class="circular-img-circle"></div>
                                    <img src="img/bai-img.png" alt="bai img">
                                </div> -->
                                    <lottie-player class="lottie-size" src="/CodeWorld-project/lottiefiles/online-learning.json" background="transparent" speed="1" loop autoplay></lottie-player>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="section-title m-0">
                                    <h2 class="title">Are you Teacher?</h2>
                                    <p class="sub-title">Become an Instructor</p>
                                </div>
                                <a href="<?php echo URLROOT ?>/Instructors/register" class="btn btn-theme">apply now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- become a instructor section end -->
<?php endif; ?>


<?php
require APPROOT . '/views/Parts/footer.php';
?>