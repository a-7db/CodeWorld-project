<?php
require APPROOT . '/views/Parts/header.php';
?>

<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-12 col-xl-4">

        <div class="box" style="border-radius: 15px;">
          <div class="card-body text-center">
            <div class="mt-3 mb-4">
              <img src="<?php echo URLROOT ?>/public/images/profile/<?php echo $data['avatar'] ?>" class="rounded-circle img-fluid" style="width: 100px;" />
            </div>
            <h4 class="mb-2"><?php echo $data['name'] ?></h4>

            <a href=""><?php echo $data['email'] ?></a></p>
            <button data-bs-toggle="modal" data-bs-target="#edit" type="button" class="btn btn-primary btn-rounded btn-lg">
              Edit
            </button>
            <div class="d-flex justify-content-evenly text-center mt-5 mb-2">
              <div>
                <p class="mb-2 h5"><?php echo $data['count_crs']->count ?></p>
                <p class="text-muted mb-0">Courses</p>
              </div>
              <div class="px-3">
                <p class="mb-2 h5"><?php echo $data['count_reviews']->count ?></p>
                <p class="text-muted mb-0">Reviews</p>
              </div>
              <div>
                <p class="mb-2 h5"><?php echo $data['count_rating']->count ?></p>
                <p class="text-muted mb-0">Rating</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>





<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="box">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

<?php
require APPROOT . '/views/Parts/footer.php';
?>