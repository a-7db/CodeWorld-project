<?php
Class Pages extends Controller{
    private $crsModel;
    public function __construct()
    {
        $this->crsModel = $this->model('course');
    }

    public function index(){
        $course = $this->crsModel->showCourses();
        $Count_courses =  $this->crsModel->countAllcourses();
        $users =  $this->crsModel->Count_student();
        $instructors =  $this->crsModel->Count_instructor();
        $data = [
            'course' => $course,
             'courses' => $Count_courses,
            'users' => $users,
            'instructors' => $instructors
        ];
        $this->view('User/Home', $data);
    }

    public function contact(){
        $this->view('User/contact');
    }

}
?>
