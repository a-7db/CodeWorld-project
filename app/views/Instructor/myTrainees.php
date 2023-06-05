<?php require APPROOT . '/views/Instructor/dashboard.php' ?>
<div class="col-12 text-end mt-3 mb-3">
    <a class="btn bg-gradient-dark mb-0" href="<?php echo URLROOT ?>/Instructors"><i class="ni ni-bold-left text-light text-sm opacity-10"></i>&nbsp;&nbsp;Back</a>
</div>
<div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card ">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-2"><?php echo $data[0]->title ?></h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Course Name</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $myusers) : ?>
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
                                            <p class="text-xs font-weight-bold mb-0 text-wrap"><?php echo $myusers->title ?></p>
                                        </td>

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

<?php require APPROOT . '/views/Instructor/footerDash.php' ?>