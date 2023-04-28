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

}
?>
