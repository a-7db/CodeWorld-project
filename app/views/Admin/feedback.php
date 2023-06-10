<?php require APPROOT . '/views/Admin/dashboard.php' ?>

<div class="row mt-4">

    <div class="col-lg-6">
        <div class="card" style="height: 75vh;">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Last Feedbacks</h6>
            </div>
            <div class="card-body p-3">
                <form action="<?php echo URLROOT ?>/Admins/feedback" method="POST">
                    <select style="height: 58vh;" name="feedbacks[]" class="form-select" multiple>
                        <?php foreach ($data['comments'] as $comm) : ?>
                            <optgroup label="<?= $comm->fname . ':' ?>">
                                <option value="<?php echo $comm->commID ?>"><?php echo $comm->content ?></option>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>

                    <span class="row">
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-dark text-xs mt-3">
                                Display
                            </button>
                        </div>
                        <div class="col-lg-10 mt-3">
                            <p class="text-danger text-bold"><?php echo $data['error'] ?></p>
                        </div>
                    </span>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Selected Feedbacks</h6>
            </div>
            <div class="card-body p-3">
                <ul class="list-group" style="height: 65vh;">
                    <?php foreach ($data['selectedFeddbacks'] as $comm) : ?>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3  shadow text-center">
                                    <img src="<?php echo URLROOT . './public/images/profile/' . $comm->profile ?>" class="avatar avatar-sm me-3" alt="user1">
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm"><?php echo $comm->fname ?></h6>
                                    <span class="text-xs"><?php echo $comm->content ?></span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <span class="text-xs"><?php echo $comm->dateTime ?></span>
                                <a href="<?php echo URLROOT . '/Admins/delete_comment/' . $comm->commID ?>" type="button" class="mx-2"><i class="ni ni-fat-remove ni-lg" aria-hidden="true"></i></a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/Admin/footerDash.php' ?>