<?php require APPROOT . '/views/Admin/dashboard.php' ?>

<style>
    <?php if (!empty($data['cate_err'])) : ?>
    .cateInput::-webkit-input-placeholder {
        color: #f00;
    }

    .cateInput {
        border-color: #f00;
    }

    <?php endif; ?>
</style>

<form action="<?php echo URLROOT ?>/Admins/edit_categories" method="POST" class="row g-3">
    <div class="col-3">
        <input type="text" class="form-control cateInput" name="cate" placeholder="<?php echo empty($data['cate_err']) ? 'Category name' : $data['cate_err'] ?>">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-success mb-3 addcate">Add</button>
    </div>
</form>

<div class="row">
    <div class="col-12">
        <div class="card mb-4 row">
            <div class="card-header pb-0">
                <h6 class="">Categories</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2 ">
                <div class="table-responsive p-0 tab-content" id="pills-tabContent">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category Name</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Edit</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Remove</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($allcate['cate'] as $category) : ?>
                                <tr>
                                    <td>
                                        <div class="d-flex px-4 py-1">

                                            <div class="d-flex flex-column justify-content-center">
                                                <h5 class="mb-0 text-sm"><?php echo $category->category_ID ?></h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="text-sm font-weight-bold mb-0"><?php echo $category->name ?></h6>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <button type="button" class="btn btn-secondary text-xs editButton">
                                            Edit
                                        </button>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button type="button" class="btn btn-danger text-xs editButton">
                                            Remove
                                        </button>
                                    </td>
                                    <!-- <td class="align-middle">
                                        <button type="button" class="btn btn-primary text-xs editButton">
                                            Edit
                                        </button>
                                    </td> -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php require APPROOT . '/views/Admin/footerDash.php' ?>