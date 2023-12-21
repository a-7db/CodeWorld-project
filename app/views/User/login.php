<?php
require APPROOT . '/views/Parts/header.php';
?>
<!-- breadcrumb start -->
<div class="breadcrumb-nav">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="<?php echo URLROOT ?>/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Log In</li>
      </ol>
    </nav>
  </div>
</div>
<!-- breadcrumb end -->
<?php
flash('watit_acception');
flash('rege_success');
flash('updatePassword');
?>
<!-- login section start -->
<section class="login-section section-padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 col-lg-6 col-xl-5">
        <div class="login-form box">
          <h2 class="form-title text-center">Log In to Your Account</h2>
          <form onsubmit="onloading()" action="<?php echo URLROOT ?>/Users/login" method="POST">
            <div class="form-group">
              <input type="text" name="email" class="form-control <?php echo (empty($data['email_err']) ? '' : 'is-invalid') ?>" placeholder="Email">
              <p class="title invalid-feedback"><?php echo $data['email_err'] ?></p>
            </div>
            <div class="form-group">
              <input type="password" name="pass" class="form-control <?php echo (empty($data['pass_err']) ? '' : 'is-invalid') ?>" placeholder="Password">
              <p class="title invalid-feedback"><?php echo $data['pass_err'] ?></p>
              <div class="d-flex mb-2 mt-2 justify-content-end"><a href="forgot_password">Forgot Password ?</a></div>
            </div>
            <button class="btn btn-theme btn-block btn-form">log in</button>

            <p class="text-center mt-4 mb-0">Don't have an account ? <a href="register">Sign Up</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- login section end -->

<?php
require APPROOT . '/views/Parts/footer.php';
?>