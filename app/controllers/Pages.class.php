<?php
Class Pages extends Controller{
    private $crsModel;
    private $traineeModel;
    public function __construct()
    {
        $this->crsModel = $this->model('course');
        $this->traineeModel = $this->model('Trainee');
    }

    public function index(){
        $courseIDs = [];
        $course = $this->crsModel->showCourses();
        $Count_courses =  $this->crsModel->countAllcourses();
        $users =  $this->crsModel->Count_student();
        $instructors =  $this->crsModel->Count_instructor();
        $ratings =  $this->crsModel->Count_ratings();
        $feedbacks = $this->crsModel->get_selected_feedbacks();

        foreach($course as $crs){
            if($this->traineeModel->find_order($crs->crs_ID)){
                $courseIDs[] = $crs->crs_ID;
            }
        }

        $data = [
            'course' => $course,
            'courses' => $Count_courses,
            'users' => $users,
            'instructors' => $instructors,
            'IDs' => $courseIDs,
            'ratings' => $ratings,
            'feedbacks' => $feedbacks
        ];
        $this->view('User/Home', $data);
    }

    public function contact(){
        $this->view('User/contact');
    }

}
?>
