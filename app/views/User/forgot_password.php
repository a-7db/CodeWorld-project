<?php
$mode = $data['mode'];

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
<section class="login-section section-padding section-title">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5">
                <div class="login-form box">
                    <?php
                    if (count($_POST) >= 0) {
                        switch ($mode) {
                            case 'enter_code':
                    ?>
                                <h2 class="form-title fs-6 text-center">We've send you a 4 digit code. Please check <span class="title fs-6 "> <?php echo $data['email'] ?></span> and enter the code here.</h2>
                                <p class="text-center">expires in <span id="CountDown"></span> <span style="margin-right: 15px;"></span> <a href="<?php echo URLROOT ?>/Users/resend">Resend</a></p>
                                <form action="<?php echo URLROOT ?>/Users/forgot_password" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="enter_code" style="text-align: center;" class="w-50 mx-auto form-control <?php echo (empty($data['code_err']) ? '' : 'is-invalid') ?>" placeholder="1234">
                                        <p class="invalid-feedback text-center"><?php echo $data['code_err'] ?></p>
                                    </div>

                                    <button class="btn btn-theme btn-block btn-form">Continue</button>
                                </form>

                                <?php
                                break;
                                ?>
                            <?php
                            case 'change_pass':
                            ?>

                                <h2 class="form-title text-center">New Password</h2>
                                <form action="<?php echo URLROOT ?>/Users/forgot_password" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="password" class="form-control <?php echo (empty($data['password_err']) ? '' : 'is-invalid') ?>" placeholder="Enter new Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="password2" class="form-control <?php echo (empty($data['password_err']) ? '' : 'is-invalid') ?>" placeholder="Re-enter Password">
                                        <p class="invalid-feedback"><?php echo $data['password_err'] ?></p>
                                    </div>

                                    <button class="btn btn-theme btn-block btn-form">Change Password</button>
                                </form>

                                <?php
                                break;
                                ?>
                            <?php
                            default:
                            ?>

                                <h2 class="form-title text-center">Enter Your Email</h2>
                                <form action="<?php echo URLROOT ?>/Users/forgot_password" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="enter_email" class="form-control <?php echo (empty($data['email_err']) ? '' : 'is-invalid') ?>" placeholder="exmaple@email.com">
                                        <p class="invalid-feedback"><?php echo $data['email_err'] ?></p>
                                    </div>

                                    <button class="btn btn-theme btn-block btn-form">Continue</button>
                                </form>

                    <?php
                                break;
                        }
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>
</section>

<script src=" <?php echo URLROOT ?> ./js/seconds.js"></script>

<?php
require APPROOT . '/views/Parts/footer.php';
?>