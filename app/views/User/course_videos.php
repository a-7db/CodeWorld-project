<?php
require APPROOT . '/views/Parts/header.php';
?>
<?php flash('AddToCart') ?>

<!-- course details section start -->
<section class="course-details section-padding">
    <div class="container">
        <div class="row">
            <div>
                <!-- course header start -->
                <div class="row box">
                    <div class="col-lg-8">
                        <video id="player" width="100%" playsinline controls data-poster="<?php echo URLROOT . '/images/courses/' . $data['course']->image ?>">
                            <source src="<?php echo URLROOT . '../public/videos/' . $data['videos']->filename ?>" />

                        </video>

                        <p class="mt-2"><?php echo $data['videos']->name ?></p>
                    </div>
                    <div class="course-header col-xl-4 pt-3">
                        <h3 class="text-capitalize"><?php echo $data['course']->title ?></h3>
                        <div class="rating mt-4">
                            <span class="average-rating">(4.5)</span>
                            <span class="average-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </span>
                            <span class="reviews">(230 Reviews)</span>
                        </div>
                        <ul>
                            <li>enrolled students - <span><?php echo $data['count']->total ?></span></li>
                            <li>created by - <span><a href="#"><?php echo $data['course']->fname ?></a></span></li>
                            <li>last updated - <span><?php echo date('Y-m-d', strtotime($data['course']->last_updated)) ?></span></li>
                            <li>language - <span>english</span></li>
                        </ul>
                    </div>
                </div>
                <!-- course header end -->

                <!-- course tabs start -->
                <nav class="course-tabs">
                    <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="course-curriculum-tab" data-bs-toggle="tab" data-bs-target="#course-curriculum" type="button" role="tab" aria-controls="course-curriculum" aria-selected="true">Lectures</button>
                        <button class="nav-link" id="course-description-tab" data-bs-toggle="tab" data-bs-target="#course-description" type="button" role="tab" aria-controls="course-description" aria-selected="false">description</button>
                        <button class="nav-link" id="course-instructor-tab" data-bs-toggle="tab" data-bs-target="#course-instructor" type="button" role="tab" aria-controls="course-instructor" aria-selected="false">instructor</button>
                        <button class="nav-link" id="course-reviews-tab" data-bs-toggle="tab" data-bs-target="#course-reviews" type="button" role="tab" aria-controls="course-reviews" aria-selected="false">reviews</button>
                    </div>
                </nav>
                <!-- course tabs end -->

                <!-- tab panes start -->
                <div class="tab-content" id="nav-tabContent">

                    <!-- course curriculum start -->
                    <div class="tab-pane fade show active" id="course-curriculum" role="tabpanel" aria-labelledby="course-curriculum-tab">
                        <div class="course-curriculum box">
                            <h3 class="text-capitalize mb-4">Lectures</h3>
                            <!-- accordion start -->
                            <div class="accordion" id="accordion">
                                <!-- accordion item start -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                            Course content <span><?php echo $data['vid_count']->vid_count ?> lesssons</span>
                                        </button>
                                    </h2>
                                    <div id="collapse-1" class="accordion-collapse collapse show" aria-labelledby="heading-1" data-bs-parent="#accordion">
                                        <div class="accordion-body">
                                            <ul>
                                                <?php foreach ($data['allClips'] as $vid) : ?>
                                                    <a class="text-white" href="<?php echo URLROOT . '/courses/learn/' . $vid->crs_ID . '/' . $data['course']->slug . '/' .$vid->vid_ID . '/' . $vid->slug ?>">
                                                        <li class="mb-4">
                                                            <i class="fas fa-play-circle"></i>
                                                            <?php echo $vid->name ?>
                                                            <!-- <span>06:00</span> -->
                                                        </li>
                                                    </a>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- accordion item end -->
                            </div>
                            <!-- accordion end -->
                        </div>
                    </div>
                    <!-- course curriculum end -->

                    <!-- course description start -->
                    <div class="tab-pane fade " id="course-description" role="tabpanel" aria-labelledby="course-description-tab">
                        <div class="course-description box">
                            <h3 class="text-capitalize mb-4">description</h3>
                            <p><?php echo $data['course']->description ?></p>

                        </div>
                    </div>
                    <!-- course description end -->

                    <!-- course instructor start -->
                    <div class="tab-pane fade " id="course-instructor" role="tabpanel" aria-labelledby="course-instructor-tab">
                        <div class="course-instructor box">
                            <h3 class="mb-3 text-capitalize">instructor</h3>
                            <div class="instructor-details">
                                <div class="details-wrap d-flex align-items-center flex-wrap">
                                    <div class="left-box me-4">
                                        <div class="img-box">
                                            <img src="<?php echo URLROOT . './public/images/instructor/' . $data['course']->profile ?>" class="rounded-circle" alt="instructor img">
                                        </div>
                                    </div>
                                    <div class="right-box">
                                        <h4><?php echo $data['course']->fname ?></h4>
                                        <ul>
                                            <li><i class="fas fa-star"></i> 4.5 Rating</li>
                                            <li><i class="fas fa-play-circle"></i> <?php echo $data['crs_count']->crs_count ?> Courses</li>
                                            <li><i class="fas fa-certificate"></i> 3000 Reviews</li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- course instructor end -->

                    <!-- course reviews start -->
                    <div class="tab-pane fade " id="course-reviews" role="tabpanel" aria-labelledby="course-reviews-tab">
                        <div class="course-reviews box">
                            <!-- rating summary start -->
                            <div class="rating-summary">
                                <h3 class="mb-4 text-capitalize">students feedback</h3>
                                <div class="row">
                                    <div class="col-md-4 d-flex align-items-center justify-content-center text-center">
                                        <div class="rating-box">
                                            <div class="average-rating">4.5</div>
                                            <div class="average-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </div>
                                            <div class="reviews">230 Reviews</div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="rating-bars">
                                            <!-- rating bars item start -->
                                            <div class="rating-bars-item">
                                                <div class="star-text">5 Star</div>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 50%;"></div>
                                                </div>
                                                <div class="percent">50%</div>
                                            </div>
                                            <!-- rating bars item end -->
                                            <!-- rating bars item start -->
                                            <div class="rating-bars-item">
                                                <div class="star-text">4 Star</div>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 30%;"></div>
                                                </div>
                                                <div class="percent">30%</div>
                                            </div>
                                            <!-- rating bars item end -->
                                            <!-- rating bars item start -->
                                            <div class="rating-bars-item">
                                                <div class="star-text">3 Star</div>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 10%;"></div>
                                                </div>
                                                <div class="percent">10%</div>
                                            </div>
                                            <!-- rating bars item end -->
                                            <!-- rating bars item start -->
                                            <div class="rating-bars-item">
                                                <div class="star-text">2 Star</div>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 7%;"></div>
                                                </div>
                                                <div class="percent">7%</div>
                                            </div>
                                            <!-- rating bars item end -->
                                            <!-- rating bars item start -->
                                            <div class="rating-bars-item">
                                                <div class="star-text">1 Star</div>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 3%;"></div>
                                                </div>
                                                <div class="percent">3%</div>
                                            </div>
                                            <!-- rating bars item end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- rating summary end -->

                            <!-- reviews filter start -->
                            <div class="reviews-filter">
                                <h3 class="mb-4 text-capitalize">reviews</h3>
                                <form action="">
                                    <div class="form-group">
                                        <i class="fas fa-chevron-down select-icon"></i>
                                        <select class="form-control">
                                            <option value="">All Reviews</option>
                                            <option value="1">1 Star</option>
                                            <option value="2">2 Star</option>
                                            <option value="3">3 Star</option>
                                            <option value="4">4 Star</option>
                                            <option value="5">5 Star</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <!-- reviews filter end -->

                            <!-- reviews list start -->
                            <div class="reviews-list">
                                <!-- reviews item start -->
                                <div class="reviews-item">
                                    <div class="img-box">
                                        <img src="img/profile/user.png" alt="review img">
                                    </div>
                                    <h4>john doe</h4>
                                    <div class="stars-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="date">1 week ago</span>
                                    </div>
                                    <p>Great work. I learnt lot of things about javascript in this course.</p>
                                </div>
                                <!-- reviews item end -->
                                <!-- reviews item start -->
                                <div class="reviews-item">
                                    <div class="img-box">
                                        <img src="img/review/1.png" alt="review img">
                                    </div>
                                    <h4>john doe</h4>
                                    <div class="stars-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="date">1 week ago</span>
                                    </div>
                                    <p>Great work. I learnt lot of things about javascript in this course.</p>
                                </div>
                                <!-- reviews item end -->
                                <!-- reviews item start -->
                                <div class="reviews-item">
                                    <div class="img-box">
                                        <img src="img/profile/user.png" alt="review img">
                                    </div>
                                    <h4>john doe</h4>
                                    <div class="stars-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="date">1 week ago</span>
                                    </div>
                                    <p>Great work. I learnt lot of things about javascript in this course.</p>
                                </div>
                                <!-- reviews item end -->
                            </div>
                            <!-- reviews list end -->
                            <button type="button" class="btn btn-theme">more reviews</button>
                        </div>
                    </div>
                    <!-- course reviews end -->
                </div>
                <!-- tab panes end -->
            </div>

        </div>
    </div>
</section>
<!-- course details section end -->

<script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
<script>
    // Change the second argument to your options:
    // https://github.com/sampotts/plyr/#options
    const player = new Plyr('video', {
        captions: {
            active: true
        }
    });

    // Expose player so it can be used from the console
    window.player = player;
</script>

<?php
require APPROOT . '/views/Parts/footer.php';
?>