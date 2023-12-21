<?php require APPROOT . '/views/Admin/dashboard.php' ?>
<?php admin_flash('isActivated'); ?>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6 class="">Users table</h6>
                <div class="mx-auto w-25">
                    <ul class="nav nav-pills " id="pills-tab" role="tablist">
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link w-100 active mx-auto" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#showUsers" type="button" role="tab" aria-controls="showUsers" aria-selected="true">Users</button>
                        </li>
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link mx-auto" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#showInstructors" type="button" role="tab" aria-controls="showInstructors" aria-selected="false">instructors</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2 ">
                <div class="table-responsive p-0 tab-content" id="pills-tabContent">
                    <div class=" tab-pane fade show active" id="showUsers" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['users'] as $user) : ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="<?php echo URLROOT . './public/images/profile/' . $user->profile ?>" class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo $user->fname ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo $user->user_ID ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo $user->email ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm <?php echo $user->statu == true ? 'bg-gradient-success' : 'bg-gradient-danger' ?>">
                                                <?php
                                                echo $user->statu == false ? 'Not verified' : 'Verified'
                                                ?>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">Trainne</span>
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-primary text-xs editButton">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>


                    <div class=" tab-pane fade" id="showInstructors" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['instu'] as $inst) : ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="<?php echo URLROOT . './public/images/instructor/' . $inst->profile ?>" class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo $inst->fname ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo $inst->user_ID ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?php echo $inst->email ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm <?php echo $inst->Role_ID != 4 ? 'bg-gradient-success' : 'bg-gradient-danger' ?>">
                                                <?php
                                                echo $inst->Role_ID == 4 ? 'Unactive' : 'Active'
                                                ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">instructor</span>
                                        </td>
                                        <td class="align-middle">

                                            <button type="button" class="btn btn-primary text-xs editButton">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="editmodel" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are sure?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    You are going to active <b id="userEmail"></b> to be able to access his account.

                                </div>
                                <div class="modal-footer">

                                    <form onsubmit="ll()" action="<?php echo URLROOT . '/Admins/deleteUser' ?>" method="GET">
                                        <input type="hidden" name="user_id" id="user_id">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>


                                    <form onsubmit="ll()" action="<?php echo URLROOT . '/Admins/activeUser' ?>" method="POST">
                                        <input type="hidden" name="user_id_active" id="user_id_active">
                                        <input type="hidden" name="email_active" id="email_active">
                                        <button type="submit" class="btn btn-primary">Active</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {

        $('.editButton').on('click', function() {

            $('#editmodel').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);
            const email = document.getElementById('userEmail');
            email.innerHTML = data[2];

            $('#user_id').val(data[1]);
            $('#user_id_active').val(data[1]);
            $('#email_active').val(data[2]);

        });
    });
</script>

<?php require APPROOT . '/views/Admin/footerDash.php' ?>