<?php require APPROOT . '/views/Admin/dashboard.php' ?>

<style>
    <?php if (!empty($data['cate_err'])) : ?>.cateInput::-webkit-input-placeholder {
        color: #f00;
    }

    .cateInput {
        border-color: #f00;
    }

    <?php endif; ?>
</style>

<form onsubmit="ll()" action="<?php echo URLROOT ?>/Admins/edit_categories" method="POST" class="row g-3">
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
                                        <button type="button" class="btn btn-secondary text-xs edit_cate">
                                            Edit
                                        </button>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button type="button" class="btn btn-danger text-xs remove">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editCateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="ll()" id="update">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category Name</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">Category Name:</label>
                            <input type="text" class="form-control" id="cate_name" name="cate_name">
                            <p class="text-danger h6" id="cate_err"></p>
                            <input type="hidden" id="cateID" name="cateID">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="reomveCateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="ll()" id="delete">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="cateID" name="cateID">
                        <div class="mb-3">
                            You're gonna delete <b id="name"></b> category
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>


    <script>
        $(document).ready(function() {
            var cateData
            $('.remove').on('click', function() {

                $('#reomveCateModal').modal('show');

                $tr = $(this).closest('tr');

                cateData = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                const name = document.getElementById('name');
                name.innerHTML = cateData[1].trim();
                $('#cateID').val(cateData[0].trim());

            });

            $('#delete').on("submit", function(event) {
                $.ajax({
                    url: "<?php echo URLROOT . '/Admins/remove_category/' ?>" + cateData[0].trim(),
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: new FormData(this),

                    error: function(data, status, err) {
                        alert(err);
                    }
                });

            });

        });
    </script>

    <script>
        var data;
        $(document).ready(function() {

            $('.edit_cate').on('click', function() {

                $('#editCateModal').modal('show');

                $tr = $(this).closest('tr');

                data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                $('#cate_name').val(data[1].trim());
                $('#cateID').val(data[0].trim());

            });
            const cate_err = document.getElementById('cate_err');

            $('#update').on("submit", function(event) {
                event.preventDefault();

                if ($('#cate_name').val() == '') {
                    cate_err.innerHTML = 'Category Name is Required *';
                } else {
                    $.ajax({
                        url: "<?php echo URLROOT . '/Admins/update_cate_name/' ?>",
                        type: "POST",
                        contentType: false,
                        processData: false,
                        data: new FormData(this),

                        success: function(data, status, err) {
                            location.reload();
                            console.log(data);
                        },
                        error: function(data, status, err) {
                            alert(err);
                        }
                    });

                }
            });

        });
    </script>

    <?php require APPROOT . '/views/Admin/footerDash.php' ?>