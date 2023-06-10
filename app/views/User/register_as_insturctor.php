<?php
require APPROOT . '/views/Parts/header.php'
?>

<!-- breadcrumb start -->
<div class="breadcrumb-nav">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
      </ol>
    </nav>
  </div>
</div>
<!-- breadcrumb end -->

<!-- signup section start -->
<section class="signup section-padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 col-lg-6 col-xl-5">
        <div class="signup-form box">
          <div>
            <lottie-player class="lottie-size" src="<?php echo URLROOT ?>/lottiefiles/teaching.json" background="transparent" speed="1" loop autoplay></lottie-player>
          </div>

          <h2 class="form-title text-center">Join as instructor</h2>

          <form onsubmit="onloading()" action="<?php echo URLROOT ?>/Instructors/register" method="POST">
            <div class="form-group">
              <input type="text" class="form-control <?php echo (empty($data['fname_err']) ? '' : 'is-invalid') ?>" placeholder="First Name" name="Fname" value="<?php echo $data['fname'] ?>">
              <p class="title invalid-feedback">dd</p>
            </div>
            <div class="form-group">
              <input type="text" class="form-control <?php echo (empty($data['email_err']) ? '' : 'is-invalid') ?>" placeholder="Email" name="email" value="<?php echo $data['email'] ?>">
              <p class="title invalid-feedback"><?php echo $data['email_err'] ?></p>
            </div>
            <div class="form-group">
              <input type="password" class="form-control <?php echo (empty($data['pass_err']) ? '' : 'is-invalid') ?>" placeholder="Password" name="pass" value="<?php echo $data['pass'] ?>">
              <p class="title invalid-feedback"><?php echo $data['pass_err'] ?></p>
            </div>
            <div class="form-group">
              <input type="password" class="form-control <?php echo (empty($data['confirm_pass_err']) ? '' : 'is-invalid') ?>" placeholder="Confirm Password" name="confirm_pass" value="<?php echo $data['confirm_pass'] ?>">
              <p class="title invalid-feedback"><?php echo $data['confirm_pass_err'] ?></p>
            </div>
            <button type="submit" class="btn btn-block btn-theme btn-form">sign up</button>
            <p class="text-center mt-4 mb-0">Already have an account ? <a href="<?php echo URLROOT ?>/Users/login">Log In</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- signup section end -->

<?php
require APPROOT . '/views/Parts/footer.php';
?>