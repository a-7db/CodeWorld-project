<?php

class Courses extends Controller {
    
    private $cmodel;
    private $traineeModel;

    public function __construct()
    {
         $this->cmodel = $this->model('course');
        $this->traineeModel = $this->model('Trainee');
    }


    public function index()
    {

        $showctc = $this->cmodel->ShowCourses();

        $data =[
            'dd' => $showctc
        ]; 
    }

    public function details($id)
    {
        $course = $this->cmodel->Showdetails($id);
        $videos = $this->cmodel->getVideos($id);
        $count = $this->cmodel->stdTotal($id);
        $vid_count = $this->cmodel->vidTotal($id);
        $crs_count = $this->cmodel->crsTotal($course->userID);
        $data = [
            'course' => $course,
            'videos' => $videos,
            'count' => $count,
            'vid_count' => $vid_count,
            'crs_count' => $crs_count,
        ];
        $this->view('User/course_details', $data);

    }
    
    public function learn($params){
        if(isLoggedIn() && $this->traineeModel->find_order($params[0])){
            $course = $this->cmodel->Showdetails($params[0]);
            $allClips = $this->cmodel->getVideos($params[0]);
            $count = $this->cmodel->stdTotal($params[0]);
            $vid_count = $this->cmodel->vidTotal($params[0]);
            $crs_count = $this->cmodel->crsTotal($course->userID);
            $lastVid = $this->cmodel->showlastVid($params[0]);
            $data = [
                    'course' => $course,
                    'videos' => '',
                    'count' => $count,
                    'vid_count' => $vid_count,
                    'crs_count' => $crs_count,
                    'allClips' => $allClips
                ];
            if (empty($params[1])) {
                $data['videos'] = $lastVid;
                $this->view('User/course_videos', $data);
            } else {
                $data['videos'] = $this->cmodel->getSelectedLecture($params[0], $params[1]);
                $this->view('User/course_videos', $data);
            }
        } else{
            redirect();
        }

    }

    public function categories($cate){
        $this->view('User/categories');
    }

    

}

?>
