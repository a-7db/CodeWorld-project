<?php

class Instructors extends Users {

    private $InsturctorModel;
    private $cmodel;
    public function __construct()
    {
        $this->cmodel = $this->model('course');
        $this->userModel = $this->model('User');
        $this->InsturctorModel = $this->model('Instructor');
    }

     public function index(){
        if (!isInstructor()) {
            redirect();
            
        }
        $money  = $this->cmodel->instructor_Money();
        $users =  $this->cmodel->count_users();
        $courses =  $this->cmodel->count_courses();
        $myTrainees = $this->InsturctorModel->getMyUsers();
        $crsUsers = $this->InsturctorModel->getEachCourseUsers();
        $myCourses = $this->InsturctorModel->git_crs_with_count();
        $topCourses = $this->InsturctorModel->top_courses();
        $topTrainees = $this->InsturctorModel->top_trainees();
        $profitsTotal = 0;
        $tax = 0;
        $row=$this->InsturctorModel->getTax();
        foreach($myTrainees as $user){
            $price = $user->price * 0.15;
            $tax = $user->price - $price;
            $profitsTotal += $user->price;
        }

        $data = [ 
            'money' => $money,
            'myUsers' => $myTrainees,
            'users' => $users,
            'courses' => $courses,
            'crsUsers' => $crsUsers,
            'crs' => $myCourses,
            'top_courses' => $topCourses,
            'top_trainees' => $topTrainees,
            'profit_total' => $profitsTotal,
            'tax' => $tax,
            'Tax' => $row->Tax
            ];

            $this->view('Instructor/instructorHome', $data);
        
    }

    public function myCourses(){
        if (!isInstructor()) {
            redirect();
        }
        $myCourses = $this->InsturctorModel->ViewMyCourses($_SESSION['user_id']);
        $cate = $this->InsturctorModel->get_categories();

        $data = [
            'crs' => $myCourses,
            'cate' => $cate
        ];

        $this->view('Instructor/myCourses', $data);
    }

    public function create_course(){
        if (!isInstructor()) {
            redirect();
        }
        if(isset($_POST['title'])){
            $date = date_create();
            
            $data = [
                'title' => $_POST['title'],
                'desc' => $_POST['desc'],
                'price' => $_POST['price'],
                'cate' => $_POST['cate'],
                'image' => '',
                'video' => $_FILES['video'],
                'public' => $_POST['public'] == 'on' ? 1 : 0,
                'time' => date_format($date, 'Y-m-d g:i:s A'),
                'slug' => ''
            ];
            $data['slug'] = slug($data['title']);
            $img_name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];

            $video_name = $_FILES['video']['name'];
            $vid_tmp_name = $_FILES['video']['tmp_name'];
            $vid_error = $_FILES['video']['error'];

            if($error === 0){
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_img_ex = array('jpg', 'png', 'jpeg');

                if(in_array($img_ex_lc, $allowed_img_ex)){
                    $new_img_name = uniqid('CRS-', true) . '.' . $img_ex_lc;
                    $img_path = '../public/images/courses/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_path);
                    $data['image'] = $new_img_name;
                }
            }
            
            if($this->InsturctorModel->createCousre($data)){
                if ($row = $this->InsturctorModel->return_course_byDate($data['time'])) {
                    $videoData = [
                        'crsID' => $row->crs_ID,
                        'vname' => $row->title,
                        'filename' => '',
                        'slug' => slug($row->title)
                    ];

                    if ($vid_error === 0) {
                        $Vid_ex = pathinfo($video_name, PATHINFO_EXTENSION);
                        $vid_ex_lc = strtolower($Vid_ex);

                        $allowed_vid_ex = array('mp4', 'avi', 'wmv', 'mov', 'webm', 'flv');

                        if (in_array($vid_ex_lc, $allowed_vid_ex)) {
                            $new_vid_name = uniqid('VID-' . $row->crs_ID, true) . '.' . $vid_ex_lc;
                            $vid_path = '../public/videos/' . $new_vid_name;
                            move_uploaded_file($vid_tmp_name, $vid_path);
                            $videoData['filename'] = $new_vid_name;
                        }
                        if ($this->InsturctorModel->addVideo($videoData)) {
                            redirect('Instructors/myCourses');
                        } else {
                            admin_flash('careate_course', 'Error!', 'video did not add..');
                            redirect('Instructors/myCourses');
                        }
                    }
                } else {
                    admin_flash('careate_course', 'Error!', 'there is no course found..');
                    redirect('Instructors/myCourses');
                }
            } else{
                admin_flash('careate_course', 'Error!', 'sowething went wrong..');
                redirect('Instructors/myCourses');
            }


            
        } else{
            redirect('Instructors/myCourses');
        }
    }

    public function add_video($crsID){
        if (!isInstructor()) {
            redirect();
        }
        $data = $this->cmodel->Showdetails($crsID);

        $video_name = $_FILES['video']['name'];
        $vid_tmp_name = $_FILES['video']['tmp_name'];
        $vid_error = $_FILES['video']['error'];

        $videoData = [
            'crsID' => $crsID,
            'vname' => trim($_POST['video_name']),
            'filename' => '',
            'slug' => slug($_POST['video_name'])
        ];

        if ($vid_error === 0) {
            $Vid_ex = pathinfo($video_name, PATHINFO_EXTENSION);
            $vid_ex_lc = strtolower($Vid_ex);

            $allowed_vid_ex = array('mp4', 'avi', 'wmv', 'mov', 'webm', 'flv');

            if (in_array($vid_ex_lc, $allowed_vid_ex)) {
                $new_vid_name = uniqid('VID-' . $crsID, true) . '.' . $vid_ex_lc;
                $vid_path = '../public/videos/' . $new_vid_name;
                move_uploaded_file($vid_tmp_name, $vid_path);
                $videoData['filename'] = $new_vid_name;
            }
            if ($this->InsturctorModel->addVideo($videoData)) {
                
                redirect('Instructors/edit', $data->crs_ID . '/' . $data->slug);
            } else {
                echo 'something went wrong';
                redirect('Instructors/edit', $data->crs_ID . '/' . $data->slug);
            }
        }
    }

    public function delete_course(){
        if (!isInstructor()) {
            redirect();
        }
        if(isset($_GET['crsID'])){
            $crsID = $_GET['crsID'];
            $crs = $this->cmodel->Showdetails($crsID);
            $videos = $this->InsturctorModel->getVideos($crsID);

            $img_name = $crs->image;
            if ($this->InsturctorModel->delete($crsID)) {
                unlink('../public/images/courses/' . $img_name);
                
            foreach($videos as $vid){
                unlink('../public/videos/' . $vid->filename);
            }
                redirect('Instructors/myCourses');
                exit;
            } else{
                redirect('Instructors/myCourses');
            }
            
        } else{
            $this->myCourses();
        }
    }

    public function edit($crsID, $slug){
        if (!isInstructor()) {
            redirect();
        }
        $course = $this->InsturctorModel->Showdetails($crsID);
        $videos = $this->cmodel->getVideos($crsID);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $date = date_create();
            $data = [
                    'course' => $course,
                    'videos' => $videos,

                    'title' => trim($_POST['title']),
                    'price' => trim($_POST['price']),
                    'desc' => trim($_POST['desc']),
                    'cate' => $_POST['cate'],
                    'public' => $_POST['public'],
                    'time' => date_format($date, 'Y-m-d g:i:s A'),
                    'crsID' => $crsID,
                    'slug' => slug($_POST['title']),
                    'image' => '',

                    # errors
                    'title_err' => '',
                    'price_err' => '',
                    'desc_err' => '',
                    'image_err' => '',
                ];

            if(empty($data['title'])){
                $data['title_err'] = 'Title cannot be empty!';
                $this->view('Instructor/edit_course', $data);
            }

            if (empty($data['price'])) {
                $data['price_err'] = 'Price cannot be empty!';
                $this->view('Instructor/edit_course', $data);
            }

            if (empty($data['desc'])) {
                $data['desc_err'] = 'Description cannot be empty!';
                $this->view('Instructor/edit_course', $data);
            }

            $img_name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];

            if($_FILES['image']['error'] != 0 &&
               empty($data['title_err']) &&
               empty($data['price_err']) &&
               empty($data['desc_err']))
               {
                if($this->InsturctorModel->update_without_image($data)){
                    admin_flash('update_course', 'Updated', 'Your course is updated successfully');
                    redirect('instructors/edit/' . $crsID . '/' . $slug);
                } else{
                    admin_flash('update_course', 'Error!', 'Your course is not updated, something went wrong');
                    redirect('instructors/edit/' . $crsID . '/' . $slug);

                }
               } else{
                
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_img_ex = array('jpg', 'png', 'jpeg');

                if (in_array($img_ex_lc, $allowed_img_ex)) {
                    $new_img_name = uniqid('CRS-' . $crsID, true) . '.' . $img_ex_lc;
                    $img_path = '../public/images/courses/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_path);
                    $data['image'] = $new_img_name;
                    if ($this->InsturctorModel->update_all($data)) {
                        admin_flash('update_course', 'Updated', 'Your course is updated successfully');
                        redirect('instructors/edit/' . $crsID . '/' . $slug);
                    } else{
                        admin_flash('update_course', 'Error!', 'Your course is not updated, something went wrong');
                        redirect('instructors/edit/' . $crsID . '/' . $slug);
                    }
                } else{
                    $data['image_err'] = 'Select jpg, png, or jpeg Extensions';
                }
                    
               }


        }else{
            $data = [
                'course' => $course,
                'videos' => $videos,

                # errors
                'title_err' => '',
                'price_err' => '',
                'desc_err' => '',
                'image_err' => '',
            ];
            $this->view('Instructor/edit_course', $data);
        }
    }

    public function update_vid_name($vid_ID){
        if (!isInstructor()) {
            redirect();
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = [
                'vidID' => $vid_ID,
                'vidName' => trim($_POST['video_name1'])
            ];

            $this->InsturctorModel->update_vid_name($data);
        }
    }

    public function remove_vid($vidID){
        if (!isInstructor()) {
            redirect();
        }
        $this->InsturctorModel->remove_video($vidID);
    }

    public function show_my_trainees($crsID, $slug)
    {
        if (!isInstructor()) {
            redirect();
        }
        $data = $this->InsturctorModel->getTrainees($crsID);

        $this->view('Instructor/myTrainees', $data);
    }

    public function register(){
        if (isLoggedIn()) {
            redirect();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'fname' => trim($_POST['Fname']),
                'email' => trim($_POST['email']),
                'pass' => trim($_POST['pass']),
                'confirm_pass' => trim($_POST['confirm_pass']),

                # ERROR MESSAGES
                'fname_err' => '',
                'email_err' => '',
                'pass_err' => '',
                'confirm_pass_err' => '',
            ];

            if (empty($data['fname'])) {
                $data['fname_err'] = 'Please Enter Your Name';
            }

            if (empty($data['email'])) {
                $data['email_err'] = 'Please Enter Your Email';
            } else {
                if (!preg_match($this->regx, $data['email'])) {
                    $data['email_err'] = 'Email Is Not Correct';
                } elseif ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email Is Already Taken';
                }
            }

            if (empty($data['pass'])) {
                $data['pass_err'] = 'Please Enter Password';
            } elseif (strlen($data['pass']) < 6 || strlen($data['pass']) > 15) {
                $data['pass_err'] = 'Password Must Be Between 6 - 15 Characters';
            }

            if (empty($data['confirm_pass'])) {
                $data['confirm_pass_err'] = 'Please Confirm Your Password';
            } else {
                if ($data['pass'] != $data['confirm_pass']) {
                    $data['confirm_pass_err'] = 'Passwords Do Not Match';
                }
            }

            if (
                empty($data['fname_err']) &&
                empty($data['email_err']) &&
                empty($data['pass_err']) &&
                empty($data['confirm_pass_err'])
            ) {
                $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);

                if ($this->InsturctorModel->register($data)) {
                    $this->send_email($data['email']);
                    $_SESSION['data'] = $data['email'];
                    redirect('Instructors/verifyEmail');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('User/register_as_insturctor', $data);
            }
        } else {
            $data = [
                'fname' => '',
                'email' => '',
                'pass' => '',
                'confirm_pass' => '',

                # ERROR MESSAGES
                'fname_err' => '',
                'email_err' => '',
                'pass_err' => '',
                'confirm_pass_err' => '',
            ];
            $this->view('User/register_as_insturctor', $data);
        }
    }

    public function verifyEmail()
    {
        if (isLoggedIn()) {
            redirect();
        }
        $data = [
            'email' => $_SESSION['data'],
            'code' => '',
            'code_err' => '',
            'type' => 1
        ];

        if (!empty($data['email'])) {
            if (isset($_POST['code'])) {
                $data['code'] = trim($_POST['code']);

                if (empty($data['code'])) {
                    $data['code_err'] = 'Please Enter The Code';
                    $this->view('User/verify', $data);
                } else {
                    if ($row = $this->userModel->getCodeFromUser($data['email'], $data['code'])) {
                        unset($_SESSION['data']);
                        flash('watit_acception', 'Wait Email', 'Please wait for our acceptance and then you can log in');
                        redirect();
                        if ($this->userModel->udpdate_status($row->user_ID)) {
                            flash('watit_acception', 'Wait Email', 'Please wait for our acceptance and then you can log in');
                            redirect();
                        } else {
                            flash('rege_success', 'Error', 'Something went wrong.');
                            redirect();
                        }
                    } else {
                        $data['code_err'] = 'The Code Is Incorrect';
                        $this->view('User/verify', $data);
                    }
                }
            } else {
                $this->view('User/verify', $data);
            }
        } else {
            redirect();
        }
    }

    private function send_email($email)
    {
        $expire = time() + (60 * 1);
        $code = rand(1000, 9999);

        $this->userModel->forgotpass($email, $code, $expire);

        $message = '<p>Your code is <b style="font-size: 25px;">' . $code . '<b/><p/>';
        send_mail($email, 'Password Reset', $message);
    }
    
}
