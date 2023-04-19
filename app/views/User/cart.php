<?php
require APPROOT . '/views/Parts/header.php';
?>


<section class="h-100 h-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="">
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-7 section-title">
                                <h5 class="mb-3"><a href="#!" class="title"><i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                                <hr>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <p class="mb-1 title">Shopping cart</p>

                                    </div>
                                </div>

                                <!-- COURSE CARD -->




                                <!-- foreach start -->

                              <?php foreach ($data['cart'] as $cart) : ?>

                               

                                 <div class="col mb-3" style="max-width: 540px;">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <div>
                                                <img width="333px" hight="333px" src="<?php echo URLROOT . '/images/courses/' . $cart->image ?> " alt="course img">
                                                </div>
                                                <div class="ms-3">
                                                    <h5>Course</h5>
                                                    <p class="small mb-0"><?php echo  $cart->title ?></p>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center">

                                                <div style="width: 80px;">
                                                    <h5 class="mb-0">SR <?php echo  $cart->price ?></h5>
                                                </div>
                                                <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                               <?php endforeach; ?>
                               
                                <!-- foreach end -->

                               
                            </div>

                            

                            <div class="col-lg-5 box">

                                <div class="section-title rounded-3">
                                    <div class="card-body bai-section">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <h5 class="mb-0">Card details</h5>
                                        </div>

                                        <p class="small mb-2 banner-text">Card type</p>
                                        <a href="#!" type="submit"><i class="fab fa-cc-visa fa-2x me-2"></i></a>
                                        <a href="#!" type="submit"><i class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                                        <a href="#!" type="submit"><i class="fab fa-cc-amex fa-2x me-2"></i></a>
                                        <a href="#!" type="submit"><i class="fab fa-cc-paypal fa-2x"></i></a>

                                        <form class="mt-4">
                                            <div class="form-outline form-white mb-4">
                                                <input type="text" id="typeName" class="form-control form-control-lg" siez="17" />
                                                <label class="form-label" for="typeName">Name On Card</label>
                                            </div>

                                            <div class="form-outline form-white mb-4">
                                                <input type="text" id="typeText" class="form-control form-control-lg" siez="17" placeholder="1234 5678 1234 5678" minlength="19" maxlength="19" />
                                                <label class="form-label" for="typeText">Card Number</label>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="form-outline form-white">
                                                        <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                                                        <label class="form-label" for="typeExp">Expiration</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-outline form-white">
                                                        <input type="password" id="typeText" class="form-control form-control-lg" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                                                        <label class="form-label" for="typeText">CVV/CVC</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                  <hr class="my-4">
                                        

                                         

                                         <?php $subtotal = 0 ;?>
                                          <!-- foreach start -->

                                        <?php foreach ($data['cart'] as $cart) : ?>

                                           <!-- calculate total -->

                                           <?php  $pro = $cart->price * 1 ;
                                           $subtotal = $subtotal + $pro ;?>

                                          <?php endforeach; ?>
                               
                                        <!-- foreach end -->
                                        <?php $total = $subtotal * 0.15 ;?>
                                        <?php $total2 = $total + $subtotal  ;?>

                                        <div class="d-flex justify-content-between">
                                            <p class="mb-2">Subtotal: </p>
                                            <p class="mb-2"> SR <?php echo $subtotal?></p>
                                        </div>
                                       
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-2">Tax: </p>
                                            <p class="mb-2"> SR <?php echo $total?></p>
                                        </div>
                                       
                                        <div class="d-flex justify-content-between mb-4">
                                            <p class="mb-2">Total: </p>
                                            <p class="mb-2"> SR <?php echo $total2?></p>
                                        </div>

                                        <button type="button" class="btn-theme btn btn-block btn-lg">
                                            <div class="d-flex justify-content-between">
                                                <span> SR <?php echo $total2?></span>
                                                <span>Pay <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                            </div>
                                        </button>
                                      
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<br/><br/><br/>
<br/><br/><br/>
<br/><br/><br/>
<br/><br/><br/>
<br/><br/><br/>
<br/><br/><br/>
<?php
require APPROOT . '/views/Parts/footer.php';
?>
