<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?php echo URLROOT ?> ./css/font-awesome.css">
    <link rel="stylesheet" href=" <?php echo URLROOT ?> ./css/bootstrap.min.css">
    <link rel="stylesheet" href=" <?php echo URLROOT ?> ./css/style.css">
    <link rel="stylesheet" href=" <?php echo URLROOT ?> ./css/responsive.css">
    <link rel="stylesheet" class="js-color-style" href=" <?php echo URLROOT ?> ./css/colors/color-1.css">
    <link rel="stylesheet" class="js-glass-style" href=" <?php echo URLROOT ?> ./css/glass.css" disabled>


    <title><?php echo SITENAME ?></title>
</head>

<body>


    <!-- page loader start -->
    <div class="page-loader js-page-loader">
        <div></div>
    </div>
    <!-- page loader end -->

    <!-- main wrapper start -->
    <div class="main-wrapper">

        <!-- header start -->
        <header class="header">
            <div class="container">
                <div class="header-main d-flex justify-content-between align-items-center">
                    <div class="header-logo">
                        <a href="<?php echo URLROOT ?>/"><span>Code</span> World</a>
                    </div>
                    <button type="button" class="header-hamburger-btn js-header-menu-toggler">
                        <span></span>
                    </button>
                    <div class="header-backdrop js-header-backdrop"></div>
                    <nav class="header-menu js-header-menu">
                        <button type="button" class="header-close-btn js-header-menu-toggler">
                            <i class="fas fa-times"></i>
                        </button>
                        <ul class="menu">
                            <li class="menu-item"><a href="<?php echo URLROOT ?>/">home</a></li>
                            <li class="menu-item menu-item-has-children">
                                <a href="" class="js-toggle-sub-menu">courses <i class="fas fa-chevron-down"></i></a>
                                <ul class="sub-menu js-sub-menu">
                                    <li class="sub-menu-item"><a href="<?php echo URLROOT ?>/Pages/categories">course</a></li>
                                    <li class="sub-menu-item"><a href="<?php echo URLROOT ?>/Pages/course_details">course details</a></li>
                                </ul>
                            </li>
                            <li class="menu-item"><a href="<?php echo URLROOT ?>/Pages/contact">contact</a></li>
                            <li class="menu-item menu-item-has-children">
                                <a href="" class="js-toggle-sub-menu">Join <i class="fas fa-chevron-down"></i></a>
                                <ul class="sub-menu js-sub-menu">
                                    <li class="sub-menu-item"><a href="<?php echo URLROOT ?>/User">log in</a></li>
                                    <li class="sub-menu-item"><a href="<?php echo URLROOT ?>/User/registeration">sign up</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <!-- header end -->