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
                                <a class="js-toggle-sub-menu">courses <i class="fas fa-chevron-down"></i></a>
                                <ul class="sub-menu js-sub-menu">
                                    <li class="sub-menu-item"><a href="<?php echo URLROOT ?>/Pages/categories">course</a></li>
                                    <li class="sub-menu-item"><a href="<?php echo URLROOT ?>/Pages/course_details">course details</a></li>
                                </ul>
                            </li>
                            <li class="menu-item"><a href="<?php echo URLROOT ?>/Pages/contact">contact</a></li>

                            <!-- SESSION -->
                            <?php
                            if (isset($_SESSION['user_id']) && $_SESSION['Role'] == 3) : ?>
                                <li class="menu-item menu-item-has-children">
                                    <a class="js-toggle-sub-menu"><?php echo $_SESSION['user_name'] ?> <i class="fas fa-chevron-down"></i></a>
                                    <ul class="sub-menu js-sub-menu">
                                        <li class="sub-menu-item"><a href="<?php echo URLROOT ?>/Users/profile">profile</a></li>
                                        <li class="sub-menu-item"><a href="<?php echo URLROOT ?>/Users/logout">logout</a></li>
                                    </ul>
                                </li>

                            <?php elseif (isset($_SESSION['user_id']) && $_SESSION['Role'] == 2) : ?>

                                <li class="menu-item menu-item-has-children">
                                    <a class="js-toggle-sub-menu"><?php echo $_SESSION['user_name'] ?> <i class="fas fa-chevron-down"></i></a>
                                    <ul class="sub-menu js-sub-menu">
                                        <li class="sub-menu-item"><a href="<?php echo URLROOT ?>/Instructors/">Dashboard</a></li>
                                        <li class="sub-menu-item"><a href="<?php echo URLROOT ?>/Users/logout">logout</a></li>
                                    </ul>
                                </li>

                            <?php elseif (isset($_SESSION['user_id']) && $_SESSION['Role'] == 1) : ?>

                                <li class="menu-item menu-item-has-children">
                                    <a class="js-toggle-sub-menu"><?php echo $_SESSION['user_name'] ?> <i class="fas fa-chevron-down"></i></a>
                                    <ul class="sub-menu js-sub-menu">
                                        <li class="sub-menu-item"><a href="<?php echo URLROOT ?>/Admins/">Dashboard</a></li>
                                        <li class="sub-menu-item"><a href="<?php echo URLROOT ?>/Users/logout">logout</a></li>
                                    </ul>
                                </li>

                            <?php else : ?>

                                <li class="menu-item menu-item-has-children">
                                    <a class="js-toggle-sub-menu">Join <i class="fas fa-chevron-down"></i></a>
                                    <ul class="sub-menu js-sub-menu">
                                        <li class="sub-menu-item"><a href="<?php echo URLROOT ?>/Users/login">log in</a></li>
                                        <li class="sub-menu-item"><a href="<?php echo URLROOT ?>/Users/register">sign up</a></li>
                                    </ul>
                                </li>

                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <!-- header end -->