<?php require APPROOT . '/views/Instructor/dashboard.php' ?>

<?php admin_flash('careate_course') ?>
<div class="col-12 text-end mt-3 mb-3">
    <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#createCourse"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create Course</button>
</div>

<div class="modal fade" id="createCourse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Creating a New Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <!-- Here The Form -->
            <form onsubmit="ll()" action="#" method="POST" enctype="multipart/form-data" id="insertData">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="col-form-label">Course Title:</label>
                        <input type="text" class="form-control" name="title" id="title">
                        <p class="text-danger h6" id="title_err"></p>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Description:</label>
                        <textarea class="form-control" name="desc" id="desc"></textarea>
                        <p class="text-danger h6" id="desk_err"></p>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-7 row">
                            <div class="col-form-label col-6">Course Fees:</div>
                            <div class="input-group col">
                                <input type="number" maxlength="5" onkeypress="return onlyNum(event)" class="form-control" name="price" id="price">
                            </div>
                            <p class="text-danger h6" id="price_err"></p>
                        </div>
                        <div class="col row">
                            <div class="col-form-label col-3">Type: </div>
                            <div class="col">
                                <select class="form-select" name="cate" id="cate">
                                    <option value="" disabled selected>Choose...</option>
                                    <?php foreach ($data['cate'] as $cate) : ?>
                                        <option value="<?php echo $cate->category_ID ?>"><?php echo $cate->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <p class="text-danger h6 text-end" id="cate_err"></p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Course Image:</label>
                        <input class="form-control" type="file" name="image" id="image">
                        <p class="text-danger h6" id="img_err"></p>
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">First Video:</label>
                        <input class="form-control" type="file" name="video" id="video">
                        <p class="text-danger h6" id="vid_err"></p>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" name="public" id="public" type="checkbox" role="switch" checked>
                        <label class="form-check-label">Public?</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>



        </div>
    </div>
</div>






<div class="container">
    <div class="row align-items-start">
        <?php foreach ($data['crs'] as $crs) : ?>

            <div class="col-md-3 mt-5 ml-3">
                <div class="card card-profile">
                    <img style="width: 100%;" src="<?php echo URLROOT . './public/images/courses/' . $crs->image ?>" alt="Image placeholder" class="card-img-top">

                    <div class="card-body pt-0">
                        <div class="h6 mt-2" style="
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            ">
                            <i class="ni business_briefcase-24 mr-2"></i><?php echo $crs->title ?>
                        </div>

                        <div class="mt-1">
                            Category - <span class="text-dark font-weight-bold"><?php echo $crs->category ?></span>
                        </div>
                        <div class="mt-1">
                            Price - <span class="text-dark font-weight-bold">SR <?php echo $crs->price ?></span>
                        </div>
                        <div class="mt-1">
                            Status - <span class="<?php echo $crs->public == 1 ? 'text-success' : 'text-warning' ?> font-weight-bold"><?php echo $crs->public == 1 ? 'Public' : 'Private' ?></span>
                        </div>
                        <div class="mt-1"><?php echo date('Y-m-d', strtotime($crs->ddate)) ?></div>
                        <?php if($crs->public != false): ?>
                        <div><a class="mt-1" href="<?php echo URLROOT . '/Courses/learn/' . $crs->crs_ID . '/' . $crs->slug ?>">Preview</a></div>
                            <?php endif; ?>
                    </div>

                    <div class="card-header text-center border-0 pt-0 pb-4 pb-lg-3">
                        <div class="d-flex justify-content-evenly">
                            <table class="d-flex justify-content-evenly">
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="<?php echo URLROOT . '/instructors/edit/' . $crs->crs_ID . '/' . $crs->slug ?>" class="btn btn-sm btn-dark mb-0 d-none d-lg-block">Edit</a>
                                    </td>
                                    <td class="d-none"><?php echo $crs->crs_ID ?></td>
                                    <td>
                                        <button type="button" class="delete-crs btn btn-sm btn-danger float-right mb-0 d-none d-lg-block">Delete</button>

                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You will delete this course and will not be able to return
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="<?php echo URLROOT ?>/Instructors/delete_course" method="GET">
                    <input type="hidden" id="crs_id" name="crsID">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function onlyNum(e) {
        var x = e.which || e.keycode;
        if (x >= 48 && x <= 57) {
            return true;
        } else {
            return false;
        }
    }
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>


<script>
    $(document).ready(function() {

        $('.delete-crs').on('click', function() {

            $('#delete').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#crs_id').val(data[1]);

        });
    });
</script>




<script type="text/javascript">
    const title_err = document.getElementById('title_err');
    const desk_err = document.getElementById('desk_err');
    const price_err = document.getElementById('price_err');
    const cate_err = document.getElementById('cate_err');
    const img_err = document.getElementById('img_err');
    const vid_err = document.getElementById('vid_err');


    $(document).ready(function() {
        $('#insertData').on("submit", function(event) {
            event.preventDefault();
            var check_img = $('#image').val();
            check_img = check_img.toLowerCase();


            var check_vid = $('#video').val();
            check_vid = check_vid.toLowerCase();

            if ($('#title').val() == "") {
                title_err.innerHTML = 'Title is Required *';
                desk_err.innerHTML = '';
                price_err.innerHTML = '';
                cate_err.innerHTML = '';
                img_err.innerHTML = '';
                vid_err.innerHTML = '';
            } else if ($('#desc').val() == "") {
                desk_err.innerHTML = 'Description is Required *';
                title_err.innerHTML = '';
                price_err.innerHTML = '';
                cate_err.innerHTML = '';
                img_err.innerHTML = '';
                vid_err.innerHTML = '';
            } else if ($('#price').val() == "") {
                price_err.innerHTML = 'Fees is Required *';
                title_err.innerHTML = '';
                desk_err.innerHTML = '';
                cate_err.innerHTML = '';
                img_err.innerHTML = '';
                vid_err.innerHTML = '';
            } else if ($('#image').val() == "") {
                img_err.innerHTML = 'Image is Required *';
                title_err.innerHTML = '';
                desk_err.innerHTML = '';
                price_err.innerHTML = '';
                cate_err.innerHTML = '';
                vid_err.innerHTML = '';
            } else if (!check_img.match(/(\.jpg|\.png|\.JPG|\.PNG|\.jpeg|\.JPEG)$/)) {
                img_err.innerHTML = 'Select jpg, png, or jpeg Extensions';
                title_err.innerHTML = '';
                desk_err.innerHTML = '';
                price_err.innerHTML = '';
                cate_err.innerHTML = '';
                vid_err.innerHTML = '';
            } else if ($('#video').val() == "") {

                vid_err.innerHTML = 'First Video is Required *';
                title_err.innerHTML = '';
                desk_err.innerHTML = '';
                price_err.innerHTML = '';
                cate_err.innerHTML = '';
                img_err.innerHTML = '';
            } else if (!check_vid.match(/(\.mp4|\.avi|\.wmv|\.mov|\.webm|\.flv)$/)) {

                vid_err.innerHTML = 'Select MP4, AVI, WMV, or MOV Extensions';
                title_err.innerHTML = '';
                desk_err.innerHTML = '';
                price_err.innerHTML = '';
                cate_err.innerHTML = '';
                img_err.innerHTML = '';

            } else {
                $.ajax({
                    url: "<?php echo URLROOT ?>/Instructors/create_course",
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: new FormData(this),

                    success: function(data, status, err) {
                        $('#insertData')[0].reset();
                        $('#createCourse').modal('hide');
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



<?php require APPROOT . '/views/Instructor/footerDash.php' ?>