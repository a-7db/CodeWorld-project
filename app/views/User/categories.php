<?php
require APPROOT . '/views/Parts/header.php';
?>


<!-- courses section start -->
<section class="courses-section section-padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">

      </div>
      <div class="col-md-8">
        <div class="section-title text-center mb-4">
          <h2 class="title">our courses</h2>
          <p class="sub-title">Find the right course for you</p>
        </div>
        <div class="row">
          <div class="input-group w-75 mx-auto">
            <span class="input-group-text text-body myActive" style="
            background-color: var(--main-color) !important;
      color: var(--WHITE) !important;
      border: 0px;
            "><i class="fas fa-search" aria-hidden="true"></i></span>
            <input type="search" id="search_box" class="form-control" placeholder="Search...">
          </div>
          <div class="col-md-5 w-75 mx-auto">
            <div class="list-group mb-5" id="show_data">

            </div>
          </div>

        </div>

      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <nav>
          <div class="nav nav-tabs border-0 justify-content-center mb-4" id="nav-tab" role="tablist">
            <?php echo $data['tabs'] ?>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <?php echo $data['content'] ?>

        </div>
      </div>
    </div>

  </div>
</section>
<!-- courses section end -->


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

<script>
  $(document).ready(function() {
    $('#search_box').keyup(function() {
      var searchText = $(this).val();
      if (searchText != '') {
        $.ajax({
          url: '<?php echo URLROOT ?>/Courses/search',
          method: 'POST',
          data: {
            text: searchText
          },
          success: function(response) {
            $('#show_data').html(response);
          }
        });
      } else {
        $('#show_data').html('');
      }
    });
  });
</script>

<?php
require APPROOT . '/views/Parts/footer.php';
?>