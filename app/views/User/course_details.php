<?php
require APPROOT . '/views/Parts/header.php';
?>
<?php flash('AddToCart') ?>

<!-- course details section start -->
<section class="course-details section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <!-- course header start -->
        <div class="course-header box">
          <h2 class="text-capitalize"><?php echo $data['course']->title ?></h2>
          <div class="rating">
            <span class="average-rating">(4.5)</span>
            <span class="average-stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </span>
            <span class="reviews">(<?php echo $data['review_count']->count ?> Reviews)</span>
          </div>
          <ul>
            <li>enrolled students - <span><?php echo $data['count']->total ?></span></li>
            <li>created by - <span><a href="#"><?php echo $data['course']->fname ?></a></span></li>
            <li>last updated - <span><?php echo date('Y-m-d', strtotime($data['course']->last_updated)) ?></span></li>
            <li>language - <span>english</span></li>
          </ul>
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
                        <?php foreach ($data['videos'] as $vid) : ?>
                          <li>
                            <i class="fas fa-play-circle"></i>
                            <?php echo $vid->name ?>
                            <!-- <span>06:00</span> -->
                          </li>
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
                      <li><i class="fas fa-certificate"></i> <?php echo $data['review_count']->count ?> Reviews</li>
                    </ul>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- course instructor end -->

          <!-- course reviews start -->
          <div class="tab-pane fade" id="course-reviews" role="tabpanel" aria-labelledby="course-reviews-tab">
            <div class="course-reviews box">
              <!-- rating summary start -->
              <div class="rating-summary">
                <h3 class="mb-4 text-capitalize">students feedback</h3>

                <div class="row">
                  <div class="col-md-4 d-flex align-items-center justify-content-center text-center">
                    <div class="rating-box">
                      <div class="average-rating"><?php echo number_format($data['avg']->avg, 1) ?></div>
                      <div class="average-stars">
                        <?php
                        if (!empty($data['avg']->avg)) {
                          $rating = explode('.', $data['avg']->avg);
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
                        }
                        ?>
                      </div>
                      <div class="reviews"><?php echo $data['review_count']->count ?> Reviews</div>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="rating-bars">
                      <!-- rating bars item start -->
                      <div class="rating-bars-item">
                        <div class="star-text">5 Star</div>
                        <div class="progress">
                          <div class="progress-bar" style="width: <?php echo $data['stu_feedback'][0] ?>%;"></div>
                        </div>
                        <div class="percent"><?php echo empty($data['stu_feedback'][0]) ? 0 : number_format($data['stu_feedback'][0], 0) ?>%</div>
                      </div>
                      <!-- rating bars item end -->
                      <!-- rating bars item start -->
                      <div class="rating-bars-item">
                        <div class="star-text">4 Star</div>
                        <div class="progress">
                          <div class="progress-bar" style="width: <?php echo $data['stu_feedback'][1] ?>%;"></div>
                        </div>
                        <div class="percent"><?php echo empty($data['stu_feedback'][1]) ? 0 : number_format($data['stu_feedback'][1], 0) ?>%</div>
                      </div>
                      <!-- rating bars item end -->
                      <!-- rating bars item start -->
                      <div class="rating-bars-item">
                        <div class="star-text">3 Star</div>
                        <div class="progress">
                          <div class="progress-bar" style="width: <?php echo $data['stu_feedback'][2] ?>%;"></div>
                        </div>
                        <div class="percent"><?php echo empty($data['stu_feedback'][2]) ? 0 : number_format($data['stu_feedback'][2], 0) ?>%</div>
                      </div>
                      <!-- rating bars item end -->
                      <!-- rating bars item start -->
                      <div class="rating-bars-item">
                        <div class="star-text">2 Star</div>
                        <div class="progress">
                          <div class="progress-bar" style="width: <?php echo $data['stu_feedback'][3] ?>%;"></div>
                        </div>
                        <div class="percent"><?php echo empty($data['stu_feedback'][3]) ? 0 : number_format($data['stu_feedback'][3], 0) ?>%</div>
                      </div>
                      <!-- rating bars item end -->
                      <!-- rating bars item start -->
                      <div class="rating-bars-item">
                        <div class="star-text">1 Star</div>
                        <div class="progress">
                          <div class="progress-bar" style="width: <?php echo $data['stu_feedback'][4] ?>%;"></div>
                        </div>
                        <div class="percent"><?php echo empty($data['stu_feedback'][4]) ? 0 : number_format($data['stu_feedback'][4], 0) ?>%</div>
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

              </div>
              <!-- reviews filter end -->
              <style>
                .scrol::-webkit-scrollbar {
                  width: 0;
                }
              </style>
              <!-- reviews list start -->
              <div class="reviews-list scrol" style="max-height: 200px; overflow-y: scroll;">
                <?php
                if (!empty($data['allFeedbacks'])) {
                  foreach ($data['allFeedbacks'] as $comm) : ?>
                    <!-- reviews item start -->
                    <div class="reviews-item">
                      <div class="img-box">
                        <img src="<?php echo URLROOT . './public/images/profile/' . $comm->profile ?>" alt="review img">
                      </div>
                      <h4><?php echo $comm->fname ?></h4>
                      <div class="stars-rating">
                        <?php $rating = explode('.', $comm->rating);
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
                        ?>

                        <span class="col-md-8 date"><?php echo date('Y-m-d', strtotime($comm->dateTime)) ?></span>
                      </div>
                      <p><?php echo $comm->content ?></p>
                    </div>
                    <!-- reviews item end -->
                <?php endforeach;
                }
                ?>
              </div>

              <!-- reviews list end -->

            </div>
          </div>
          <!-- course reviews end -->
        </div>
        <!-- tab panes end -->
      </div>
      <div class="col-lg-4">
        <!-- course sidebar start -->
        <div class="course-sidebar box">
          <div class="img-box position-relative" data-bs-toggle="modal" data-bs-target="#video-modal">
            <img src="<?php echo 'http://localhost:4433/CodeWorld-project/images/courses/' . $data['course']->image ?>" class="w-100" alt="course img">

          </div>
          <div class="price d-flex align-items-center mb-3">
            <!-- <span class="price-old text-decoration-line-through">SR 100</span> -->
            <span class="price-new">SR <?php echo $data['course']->price ?></span>
            <!-- <span class="price-discount">51% Off</span> -->
          </div>
          <h3 class="mb-3">Course Features</h3>
          <ul class="features-list">
            <li>Total <?php echo $data['vid_count']->vid_count ?> lessons</li>
          </ul>
          <div class="btn-wrap">
            <a class="btn btn-theme btn-block" href="<?php echo URLROOT . '/Trainees/AddToCart/' . $data['course']->crs_ID ?>">Add to cart</a>

          </div>
        </div>
        <!-- course sidebar end -->
      </div>
    </div>
  </div>
</section>
<!-- course details section end -->


<?php
require APPROOT . '/views/Parts/footer.php';
?>