<?php
require APPROOT . '/views/Parts/header.php';
?>

<?php flash('checkout') ?>

<section class="h-100 h-custom">
    <div class="container py-5 h-100">
        <div class=" ">

            <div class="">
                <div class="card-body p-4">

                    <div class="col-lg-7 section-title">
                        <h5 class="mb-3">My Learning</h5>
                        <hr>
                    </div>
                    <div class="row">


                        <!-- courses item start -->
                        <?php foreach ($data['course'] as $crs) : ?>
                            <div class="col-md-6 col-lg-3">
                                <div class="courses-item">
                                    <a href="<?php echo URLROOT . '/courses/learn/' . $crs->crs_ID . '/' . $crs->slug ?>" class="link">
                                        <div class="courses-item-inner">
                                            <div class="img-box">
                                                <img src="<?php echo URLROOT . '/images/courses/' . $crs->image ?>" alt="course img">
                                            </div>
                                            <h6 class="title"><?php echo $crs->title ?></h6>
                                            <p><?php echo $crs->name ?></p>
                                            <div class="instructor">
                                                <img src="<?php echo URLROOT . '/images/instructor/' . $crs->profile ?>" alt="instructor img">
                                                <span class="instructor-name"><?php echo $crs->fname ?></span>
                                            </div>
                                            <div class="price">SR <?php echo $crs->price ?></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- courses item end -->


                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<?php
require APPROOT . '/views/Parts/footer.php';
?>