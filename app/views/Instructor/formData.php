<form action="<?php echo URLROOT ?>/Instructors/create_course" method="POST" enctype="multipart/form-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Creating a New Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <!-- Here The Form -->

            <div class="modal-body">
                <div class="mb-3">
                    <label class="col-form-label">Course Title:</label>
                    <input type="text" class="form-control" name="title" id="title">
                    <p class="title invalid-feedback"><?php echo $data['title_err'] ?></p>
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
                            <input type="number" class="form-control" name="price" id="price">
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
                <button type="submit"  class="btn btn-primary">Create</button>
            </div>

        </div>
    </div>
</form>