<?php
Class Pages extends Controller{
    private $crsModel;
    public function __construct()
    {
        $this->crsModel = $this->model('course');
    }

    public function index(){
        $course = $this->crsModel->showCourses();
        $data = [
            'course' => $course
        ];
        $this->view('User/Home', $data);
    }

    public function contact(){
        $this->view('User/contact');
    }
    
    public function registeration(){
        $this->view('User/regiAsInstuructor');
    }

    public function course_details(){
        $this->view('User/course_details');
    }

    public function categories(){
        $this->view('User/categories');
    }

    public function cart(){
        $this->view('User/cart');
    }
    public function profile(){
        $this->view('User/profile');
    }

    public function dashboard(){
        $this->view('Admin/content');
    }
    public function Instructor_Dashboard(){
        $this->view('Instructor/content');
    }
}
?>
