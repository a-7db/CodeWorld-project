<?php
require APPROOT . '/views/Parts/header.php';
?>

<!-- breadcrumb start -->
<div class="breadcrumb-nav">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">contact</li>
            </ol>
        </nav>
    </div>
</div>
<!-- breadcrumb end -->

<!-- contact section start -->
<section class="contact-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-title">
                    <p class="sub-title">Get In Touch</p>
                </div>
                <div class="contact-items">
                    <div class="contact-item">
                        <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
                        <h3>Address</h3>
                        <p>Dammam, Institute of Public Administration</p>
                    </div>
                    <div class="contact-item">
                        <div class="icon-box"><i class="fas fa-phone"></i></div>
                        <h3>Phone</h3>
                        <p>+966 5654 252 540</p>
                    </div>
                    <div class="contact-item">
                        <div class="icon-box"><i class="fas fa-envelope"></i></div>
                        <h3>Email</h3>
                        <p>codeworld@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-form box">
                    <h2 class="form-title text-center">Leave a Message</h2>
                    <form action="">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-block btn-theme btn-form">send message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact section end -->


<?php
require APPROOT . '/views/Parts/footer.php';
?>