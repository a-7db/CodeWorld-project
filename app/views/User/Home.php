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
                    <a href="<?php echo URLROOT ?>/Users/register" class="btn btn-theme">join free</a>

                </div>
            </div>
            <div class="col-md-6 order-first order-md-last mb-5 mb-md-0">
                <div class="banner-img">
                    <div class="circular-img">
                        <div class="circular-img-inner">

                        </div>
                    </div>
                </div>
                <lottie-player class="lottie-size" src="<?php echo URLROOT ?>/lottiefiles/laptop.json" background="transparent" speed="1" loop autoplay></lottie-player>
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
                        <p>students we've hehehe</p>
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
                        <h2 class="style-3">50+</h2>
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
                        <a href="<?php echo URLROOT . '/courses/details/' . $crs->crs_ID ?>" class="link">
                            <div class="courses-item-inner">
                                <div class="img-box">
                                    <img src="<?php echo URLROOT . '/images/courses/' . $crs->image ?>" alt="course img">
                                </div>
                                <h3 class="title"><?php echo $crs->title ?></h3>
                                <div class="instructor">
                                    <img src="<?php echo URLROOT . '/images/instructor/' . $crs->profile?>" alt="instructor img">
                                    <span class="instructor-name"><?php echo $crs->fname ?></span>
                                </div>
                                <div class="rating">
                                    <span class="average-rating">(4.5)</span>
                                    <span class="average-stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </span>
                                    <span class="reviews">(230)</span>
                                </div>
                                <div class="price">SR <?php echo $crs->price ?></div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- courses item end -->
        </div>
        <div class="row">
            <div class="col-12 text-center mt-3">
                <a href="courses.html" class="btn btn-theme">view all courses</a>
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
                    <img src="<?php echo URLROOT ?>/images/testimonial/1.png" class="w-100 js-testimonial-img rounded-circle" alt="testimonial img">
                </div>
                <div id="carouselOne" class="carousel slide text-center" data-bs-ride="carousel">
                    <div class="carousel-inner mb-4">
                        <div class="carousel-item active" data-js-testimonial-img="<?php echo URLROOT ?>/images/testimonial/1.png">
                            <div class="testimonials-item">
                                <p class="text-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus et nisi fuga, repudiandae vero id sint necessitatibus eveniet? At, labore.</p>
                                <h3>john doe</h3>
                                <p class="text-2">web developer</p>
                            </div>
                        </div>
                        <div class="carousel-item" data-js-testimonial-img="<?php echo URLROOT ?>/images/testimonial/2.png">
                            <div class="testimonials-item">
                                <p class="text-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus et nisi fuga, repudiandae vero id sint necessitatibus eveniet? At, labore.</p>
                                <h3>john doe</h3>
                                <p class="text-2">web developer</p>
                            </div>
                        </div>
                        <div class="carousel-item" data-js-testimonial-img="<?php echo URLROOT ?>/images/testimonial/3.png">
                            <div class="testimonials-item">
                                <p class="text-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus et nisi fuga, repudiandae vero id sint necessitatibus eveniet? At, labore.</p>
                                <h3>john doe</h3>
                                <p class="text-2">web developer</p>
                            </div>
                        </div>
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
                                <lottie-player class="lottie-size" src="<?php echo URLROOT ?>/lottiefiles/online-learning.json" background="transparent" speed="1" loop autoplay></lottie-player>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="section-title m-0">
                                <h2 class="title">become an instructor</h2>
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



<?php
require APPROOT . '/views/Parts/footer.php';
?>
