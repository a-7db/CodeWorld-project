<?php
require APPROOT . '/views/Parts/header.php';
?>


<!-- courses section start -->
<section class="courses-section section-padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">

      </div>
      <div class="col-md-8">
        <div class="section-title text-center mb-4">
          <h2 class="title">our courses</h2>
          <p class="sub-title">Find the right course for you</p>
        </div>
        <div class="input-group mb-5 w-75 mx-auto">
          <span class="input-group-text text-body myActive" style="
          background-color: var(--main-color) !important;
    color: var(--WHITE) !important;
    border: 0px;
          "><i class="fas fa-search" aria-hidden="true"></i></span>
          <input type="text" class="form-control" placeholder="Type here...">
        </div>
        
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <nav>
          <div class="nav nav-tabs border-0 justify-content-center mb-4" id="nav-tab" role="tablist">
            <?php echo $data['tabs'] ?>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <?php echo $data['content'] ?>

        </div>
      </div>
    </div>

  </div>
</section>
<!-- courses section end -->

<?php
require APPROOT . '/views/Parts/footer.php';
?>