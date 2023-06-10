<?php require APPROOT . '/views/Instructor/dashboard.php' ?>
<?php admin_flash('update_course') ?>


<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <form onsubmit="ll()" action="<?php echo URLROOT . '/Instructors/edit/' . $data['course']->crs_ID . '/' . $data['course']->slug ?>" class="row g-3" id="editing" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Title</label>
                        <input type="text" value="<?php echo $data['course']->title ?>" name="title" class="form-control">
                        <p class="text-danger h6"><?php echo $data['title_err'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Course Fees</label>
                        <input type="number" maxlength="5" onkeypress="return onlyNum(event)" name="price" value="<?php echo $data['course']->price ?>" id="price" class="form-control">
                        <p class="text-danger h6"><?php echo $data['price_err'] ?></p>
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Description</label>
                        <textarea class="form-control" name="desc" cols="10" rows="4"><?php echo $data['course']->description ?></textarea>
                        <p class="text-danger h6" id="desc_err"><?php echo $data['desc_err'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Type</label>
                        <select name="cate" class="form-select">
                            <?php foreach ($allcate['cate'] as $cate) : ?>
                                <option <?php echo $data['course']->cate_ID == $cate->category_ID ? 'selected' : '' ?> value="<?php echo $cate->category_ID ?>"><?php echo $cate->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" type="file" name="image">
                        <p class="text-danger h6"><?php echo $data['image_err'] ?></p>
                    </div>
                    <div class="col-md-12 form-check form-switch">
                        <input class="form-check-input" id="value" type="checkbox" role="switch" data-on="1" data-off="0" <?php echo $data['course']->public == true ? 'checked' : '' ?>>
                        <input type="hidden" id="public" name="public">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Public</label>
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addVideo"><i class=" fas fa-plus"></i> Add New Video</button>

                    </div>
                    <div class="">
                        <table class="table table-hover align-items-center  mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Video Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Manage</th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['videos'] as $vid) : ?>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 text-sm"><?php echo $vid->name ?></h6>
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-danger text-xs remove">
                                                Remove
                                            </button>
                                            <button type="button" class="btn btn-primary text-xs edit_video">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-success text-xs paly">
                                                Play
                                            </button>
                                        </td>
                                        <td class="d-none">
                                            <?php echo $vid->vid_ID ?>
                                        </td>
                                        <td class="d-none">
                                            <?php echo $vid->filename ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>


                    <div class="row justify-content-between">
                        <div class="col-auto"><button type="submit" class="btn btn-primary">Update</button></div>
                        <div class="col-auto"><a href="<?php echo URLROOT ?>/Instructors/myCourses" class="btn btn-danger">Cancel</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addVideo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Video</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <!-- Here The Form -->
            <form onsubmit="ll()" action="#" method="POST" enctype="multipart/form-data" id="add_video">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="col-form-label">Video Name:</label>
                        <input type="text" class="form-control" name="video_name" id="video_name">
                        <p class="text-danger h6" id="name_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Uplaod Video</label>
                        <input class="form-control" type="file" name="video" id="video">
                        <p class="text-danger h6" id="vid_err"></p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editVidModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form onsubmit="ll()" id="update">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Video Name</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="col-form-label">Video Name:</label>
                        <input type="text" class="form-control" id="video_name1" name="video_name1">
                        <p class="text-danger h6" id="name_err1"></p>
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
<div class="modal fade" id="reomveVidModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form onsubmit="ll()" id="delete">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        You're gonna delete <b id="vname"></b> video from your course
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

<!-- course preview modal start -->
<div class="modal fade video-modal js-course-preview-modal" id="video-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <div class="ratio ratio-16x9">
                    <video id="video-plyr" src="" controls class="js-course-preview-video" data-poster="<?php echo URLROOT . '/images/courses/' . $data['course']->image ?>"></video>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- course preview modal end -->

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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

<script>
    $(document).ready(function() {
        $('#value').change(function() {
            if ($(this).prop("checked")) {
                $('#public').val(1);
            } else {
                $('#public').val(0);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('.paly').on('click', function() {

            $('#video-modal').modal('show');

            $tr = $(this).closest('tr');

            var videoData = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            let video = document.getElementById('video-plyr');
            video.src = "<?php echo URLROOT . '../public/videos/' ?>" + videoData[3].trim();

        });

    });
</script>


<script>
    var getID;
    $(document).ready(function() {

        $('.remove').on('click', function() {

            $('#reomveVidModal').modal('show');

            $tr = $(this).closest('tr');

            getID = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            const name = document.getElementById('vname');
            name.innerHTML = getID[0].trim();

        });

        $('#delete').on("submit", function(event) {

            $.ajax({
                url: "<?php echo URLROOT . '/Instructors/remove_vid/' ?>" + getID[2].trim(),
                type: "POST",
                contentType: false,
                processData: false,
                data: new FormData(this),

                success: function(data, status, err) {
                    location.reload();
                },
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

        $('.edit_video').on('click', function() {

            $('#editVidModal').modal('show');

            $tr = $(this).closest('tr');

            data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();


            $('#video_name1').val(data[0].trim());

        });
        const name_err1 = document.getElementById('name_err1');

        $('#update').on("submit", function(event) {
            event.preventDefault();

            if ($('#video_name1').val() == '') {
                name_err1.innerHTML = 'Video Name is Required *';
            } else {
                $.ajax({
                    url: "<?php echo URLROOT . '/Instructors/update_vid_name/' ?>" + data[2].trim(),
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


<script>
    function public_switch(id) {
        var crsID = id;
        $.ajax({
            url: '<?php echo URLROOT ?>/Instructors/edit_public/<?php echo $data['course']->crs_ID . '/' . $data['course']->slug ?>',
            type: 'POST',
            data: {
                value: crsID
            },
            success: function(result) {
                console.log(result);
                location.assign('<?php echo URLROOT ?>/Instructors/edit_public/<?php echo $data['course']->crs_ID . '/' . $data['course']->slug ?>')
            }
        });
    }
</script>

<script>
    const name_err = document.getElementById('name_err');
    const video_err = document.getElementById('vid_err');

    $(document).ready(function() {
        $('#add_video').on("submit", function(event) {
            event.preventDefault();

            var check_vid = $('#video').val();
            check_vid = check_vid.toLowerCase();

            if ($('#video_name').val() == '') {
                name_err.innerHTML = 'Video Name is Required *';
                video_err.innerHTML = '';
            } else if ($('#video').val() == '') {
                video_err.innerHTML = 'Video File is Required *';
                name_err.innerHTML = '';
            } else if (!check_vid.match(/(\.mp4|\.avi|\.wmv|\.mov|\.webm|\.flv)$/)) {

                video_err.innerHTML = 'Select MP4, AVI, WMV, or MOV Extensions';
                name_err.innerHTML = '';

            } else {
                $.ajax({
                    url: "<?php echo URLROOT . '/Instructors/add_video/' . $data['course']->crs_ID ?>",
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: new FormData(this),

                    success: function(data, status, err) {
                        $('#add_video')[0].reset();
                        $('#addVideo').modal('hide');
                        console.log(data);
                        location.reload();
                    },
                    error: function(data, status, err) {
                        alert(err);
                    }
                });

            }
        });
    })
</script>

<?php require APPROOT . '/views/Instructor/footerDash.php' ?>