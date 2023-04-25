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
        $this->view('Instructor/instructorHome');
    }

    public function myCourses(){
        $myCourses = $this->InsturctorModel->ViewMyCourses($_SESSION['user_id']);
        $cate = $this->InsturctorModel->get_categories();

        $data = [
            'crs' => $myCourses,
            'cate' => $cate
        ];

        $this->view('Instructor/myCourses', $data);
    }

    public function create_course(){
        if(isset($_POST['title'])){
            $date = date("j, n, Y");
            print_r($_FILES['video']);
            $data = [
                'title' => $_POST['title'],
                'desc' => $_POST['desc'],
                'price' => $_POST['price'],
                'cate' => $_POST['cate'],
                'image' => '',
                'video' => $_FILES['video'],
                'public' => $_POST['public'] == 'on' ? 1 : 0,
                'time' => $date
            ];

            $img_name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];

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

            } else{
                echo '<script> alret("Something went error with your image") </script>';
            }

            if($this->InsturctorModel->createCousre($data)){
                $this->myCourses();
            }{

            }

        } else{
            $this->myCourses();
        }
    }

    public function delete_course(){
        if(isset($_GET['crsID'])){
            $crs = $this->cmodel->Showdetails($_GET['crsID']);
            $img_name = $crs->image;
            if ($this->InsturctorModel->delete($_GET['crsID'])) {
                unlink('../public/images/courses/' . $img_name);
                $this->myCourses();
            } {
                $this->myCourses();
            }
        } else{
            $this->myCourses();
        }
    }

    public function register(){
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
                    flash('watit_acception', 'Wait Email', 'Please wait for our acceptance and then you can log in');
                    redirect();
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
}