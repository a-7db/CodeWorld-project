<?php require APPROOT . '/views/Admin/dashboard.php' ?>

<div class="container-fluid py-4">
    <div class="row">
        <nav class="col-12">
            <ul class="nav row" id="myTab" role="tablist">
                <li class="nav-item col-xl-3 col-sm-6 mb-xl-0 mb-4" role="presentation">
                    <a class="nav-item active" role="button" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                        <div class="">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold"> Profits</p>

                                                <h5 class="font-weight-bolder">

                                                    <?php echo $data['money']->price . ' SR' ?>

                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item col-xl-3 col-sm-6 mb-xl-0 mb-4" role="presentation">
                    <a role="button" href="<?php echo URLROOT ?>/Admins/users" class="nav-item" aria-selected="false">
                        <div class="">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold"> Trainees</p>
                                                <h5 class="font-weight-bolder">
                                                    <?php echo $data['users']->users . ' Users' ?>
                                                    </br>

                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item col-xl-3 col-sm-6 mb-xl-0 mb-4" role="presentation">
                    <a role="button" class="nav-item" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                        <div class="">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold"></p>
                                                <h5 class="font-weight-bolder">
                                                    <?php // echo $data['courses']->courses . ' Courses' 
                                                    ?>
                                                    Top Sales & Trainees
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item col-xl-3 col-sm-6" role="presentation">
                    <a role="button" class="nav-item" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" role="tab" aria-controls="disabled-tab-pane" aria-selected="true">
                        <div class="">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Incoming</p>
                                                <h5 class="font-weight-bolder">

                                                    <?php $total = $data['money']->price  ?>
                                                    <?php $Tax_Percentage = $data['Tax'] ?>
                                                    <?php $tax = $total * $Tax_Percentage ?>
                                                    <?php $total2 = $total + $tax ?>
                                                    <?php echo $total2  . ' SR' ?>
                                                    
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    </div></a>
    </li>
    </ul>
    </nav>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Sales & Profits</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Course Name</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tax</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['paid_users'] as $myusers) : ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="<?php echo URLROOT . './public/images/profile/' . $myusers->profile ?>" class="avatar avatar-sm me-3" alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm"><?php echo $myusers->fname ?></h6>
                                                            <p class="text-xs text-secondary mb-0"><?php echo $myusers->email ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0 text-wrap" style="width: 30%;"><?php echo $myusers->title ?></p>
                                                </td>
                                                <td class="align-middle text-center text-sm">

                                                    <span class="text-success text-xs font-weight-bold">SR <?php echo $myusers->price ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <?php $price = $myusers->price * 1;
                                                    $tax = $price * $Tax_Percentage;
                                                    $price = $tax - $price;
                                                    ?>
                                                    <span class="text-danger text-xs font-weight-bold">- SR <?php echo $tax ?></span>
                                                </td>
                                                <!-- <td class="align-middle">
													<a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
														Edit
													</a>
												</td> -->
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Sales & Profits</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">



                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            <div class="row mt-4">
                <div class="col-lg-7 mb-lg-0 mb-4">
                    <div class="card ">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2">Top Courses</h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center ">
                                <tbody>
                                    <tr>
                                        <th class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                </div>
                                                <div class="ms-4">
                                                    <p class="text-xs font-weight-bold mb-0">Course</p>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Sales</p>
                                            </div>
                                        </th>

                                    </tr>
                                    <?php foreach ($data['top_courses'] as $topc) : ?>
                                        <tr>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div>
                                                        <img width="100" src="<?php echo URLROOT . './public/images/courses/' . $topc->image ?>" alt="Country flag">
                                                    </div>
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0"><?php echo $topc->title ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <h6 class="text-sm mb-0"><?php echo $topc->count ?></h6>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Top Trainees</h6>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <?php foreach ($data['top_trainees'] as $topt) : ?>
                                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="<?php echo URLROOT . './public/images/profile/' . $topt->profile ?>" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark text-sm"><?php echo $topt->fname ?></h6>
                                                <span class="text-xs"><?php echo $topt->email ?><span class="font-weight-bold"></span></span>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <span class="text-xs"><?php echo $topt->count ?></span>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
    </div>


    <?php require APPROOT . '/views/Admin/footerDash.php' ?>