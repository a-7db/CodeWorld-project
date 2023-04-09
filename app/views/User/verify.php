<?php
if (!isset($_SESSION['emailverify'])) : redirect() ?>

<?php else : require APPROOT . '/views/Parts/header.php'; ?>

    <section class="login-section section-padding section-title">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-6 col-xl-5">
                    <div class="login-form box">

                        <h2 class="form-title fs-6 text-center">We've send you a verification code. Please check <span class="title fs-6 "> <?php echo $verifyData['email'] ?></span> and enter the code here.</h2>
                        <p class="text-center">expires at 60s. <span style="margin-right: 15px;"></span> <a href="<?php echo URLROOT ?>/Users/resend/">Resend</a></p>
                        <form action="<?php echo URLROOT ?>/Users/verifyEmail" method="POST">
                            <div class="form-group">
                                <input type="number" maxlength="4" name="enter_code" style="text-align: center;" class="w-50 mx-auto form-control <?php echo (empty($verifyData['code_err']) ? '' : 'is-invalid') ?>" placeholder="1234">
                                <p class="invalid-feedback text-center"><?php echo $data['code_err'] ?></p>
                            </div>

                            <button class="btn btn-theme btn-block btn-form">Verify</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
    require APPROOT . '/views/Parts/footer.php';
endif;
?>