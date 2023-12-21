<?php
require APPROOT . '/views/Parts/header.php';
?>

<?php flash('checkout') ?>

<section class="h-100 h-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="">
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-7 section-title">
                                <h5 class="mb-3">Shopping cart</h5>
                                <hr>

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
                                                        <p class="small mb-0"><?php echo  $cart->title ?></p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center">

                                                    <div style="width: 80px;">
                                                        <h5 class="mb-0">SR <?php echo  $cart->price ?></h5>
                                                    </div>
                                                    <a href="<?php echo URLROOT . '/Trainees/delete_Item/' . $cart->cart_ID ?>" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
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
                                        <nav>
                                            <ul class="nav justify-content-start" id="nav-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-item active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fab fa-cc-visa fa-2x me-2"></i></a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-item" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fab fa-cc-paypal fa-2x"></i></a>
                                                </li>
                                                <!-- <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fab fa-cc-visa fa-2x me-2"></i></button> -->
                                                <!-- <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fab fa-cc-paypal fa-2x"></i></button> -->
                                            </ul>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                                                <form class="mt-4">
                                                    <div class="form-outline form-white mb-4">
                                                        <input type="text" id="typeName" class="form-control form-control-lg" siez="17" />
                                                        <label class="form-label" for="typeName">Name On Card</label>
                                                    </div>

                                                    <div class="form-outline form-white mb-4">
                                                        <input type="number" id="typeText" class="form-control form-control-lg" siez="17" placeholder="1234 5678 1234 5678" minlength="19" maxlength="19" />
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

                                                    <?php $subtotal = 0; ?>
                                                    <!-- foreach start -->

                                                    <?php foreach ($data['cart'] as $cart) : ?>

                                                        <!-- calculate total -->

                                                        <?php $pro = $cart->price * 1;
                                                        $subtotal = $subtotal + $pro; ?>

                                                    <?php endforeach; ?>

                                                    <!-- foreach end -->
                                                    <?php $total = $subtotal * $data['cart'][0]->Tax ; ?>
                                                    <?php $total2 = $total + $subtotal; ?>

                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-2">Subtotal: </p>
                                                        <p class="mb-2"> SR <?php echo $subtotal ?></p>
                                                    </div>

                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-2">Tax: </p>
                                                        <p class="mb-2"> SR <?php echo $total ?></p>
                                                    </div>

                                                    <div class="d-flex justify-content-between mb-4">
                                                        <p class="mb-2">Total: </p>
                                                        <p class="mb-2"> SR <?php echo $total2 ?></p>
                                                    </div>

                                                    <a href="<?php echo  URLROOT ?>/Trainees/checkout/">
                                                        <button type="button" class="btn-theme btn btn-block btn-lg">

                                                            <div class="d-flex justify-content-between">
                                                                <span> SR <?php echo $total2 ?></span>
                                                                <span>Pay<i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                            </div>

                                                        </button>
                                                    </a>

                                                </form>
                                            </div>


                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                                                <form class="mt-4">
                                                    <div class="form-outline form-white mb-4">
                                                        <input type="email" placeholder="email" id="email" class="form-control form-control-lg" siez="17" />
                                                    </div>

                                                    <hr class="my-4">





                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-2">Subtotal: </p>
                                                        <p class="mb-2"> SR <?php echo $subtotal ?></p>
                                                    </div>

                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-2">Tax: </p>
                                                        <p class="mb-2"> SR <?php echo $total ?></p>
                                                    </div>

                                                    <div class="d-flex justify-content-between mb-4">
                                                        <p class="mb-2">Total: </p>
                                                        <p class="mb-2"> SR <?php echo $total2 ?></p>
                                                    </div>



                                                    <!-- Set up a container element for the button -->
                                                    <div id="paypal-button-container"></div>

                                                </form>
                                            </div>
                                        </div>
                                        <!-- <a href="#!" type="submit"><i class="fab fa-cc-visa fa-2x me-2"></i></a>
                                        <a href="#!" type="submit"><i class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                                        <a href="#!" type="submit"><i class="fab fa-cc-amex fa-2x me-2"></i></a>
                                        <a href="#!" type="submit"><i class="fab fa-cc-paypal fa-2x"></i></a> -->





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

<br /><br /><br />
<br /><br /><br />
<br /><br /><br />
<br /><br /><br />
<br /><br /><br />
<br /><br /><br />
<?php
require APPROOT . '/views/Parts/footer.php';
?>

<!-- Replace "test" with your own sandbox Business account app client ID -->
<script src="https://www.paypal.com/sdk/js?client-id=AeVsTmH7yrlZI7bviF3O0oQSjKJqbxhHYad-0MUirXo2VNrcG7B5Ms9tdKfJHOV9xJYRFKJP9G_CSNB1&currency=USD"></script>


<script>
    paypal.Buttons({
        onInit() {

            var email = $('#email').val();

            if (email.length == 0) {
                alert("email is require");
                return false;
            } else {
                return true;
            }
        },
        // Order is created on the server and the order id is returned
        createOrder(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $total2 ?>'
                    }
                }]
            });


        },
        // Finalize the transaction on the server after payer approval
        onApprove(data, actions) {
            return actions.order.capture().then(function(orderData) {
                // Successful capture! For dev/demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];

                window.location.href = '<?php echo URLROOT ?>/Trainees/checkout'
            });
        }
    }).render('#paypal-button-container');
</script>