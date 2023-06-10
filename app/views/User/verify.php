<?php require APPROOT . '/views/Parts/header.php'; ?>

<section class="login-section section-padding section-title">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5">
                <div class="login-form box">

                    <h2 class="form-title fs-6 text-center">We've send you a verification code. Please check <span class="title fs-6 "> <?php echo $data['email'] ?></span> and enter the code here.</h2>

                    <form action="<?php echo $data['type'] == 0 ? URLROOT . '/Users' : URLROOT . '/Instructors' ?>/verifyEmail" method="POST">
                        <div class="form-group">
                            <input type="text" onkeypress="return onlyNum(event)" maxlength="4" name="code" style="text-align: center;" class="w-50 mx-auto form-control <?php echo (empty($data['code_err']) ? '' : 'is-invalid') ?>" placeholder="1234">
                            <p class="invalid-feedback text-center"><?php echo $data['code_err'] ?></p>
                        </div>

                        <button class="btn btn-theme btn-block btn-form">Verify</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function onlyNum(e) {
        var x = e.which || e.keycode;
        if (x >= 48 && x <= 57) {
            return true;
        } else {
            return false;
        }
    }
</script>

<?php
require APPROOT . '/views/Parts/footer.php'
?>