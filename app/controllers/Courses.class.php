<?php

class Courses extends Controller {
    
    private $cmodel;
    private $traineeModel;

    public function __construct()
    {
         $this->cmodel = $this->model('course');
        $this->traineeModel = $this->model('Trainee');
    }


    public function index($cate)
    {
        $course = $this->cmodel->get_courses_by_cate($cate);
        $data = [
            'course' => $course
        ];
        $this->view('User/categories', $data);
    }


    public function details($slug)
    {
        $course = $this->cmodel->Showdetails($slug);
        $videos = $this->cmodel->getVideos($course->crs_ID);
        $count = $this->cmodel->stdTotal($course->crs_ID);
        $vid_count = $this->cmodel->vidTotal($course->crs_ID);
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
            if (empty($params[2]) && empty($params[3])) {
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
        $course = $this->cmodel->get_courses_by_cate($cate);
        $data = [
            'course' => $course
        ];
        $this->view('User/categories', $data);
    }

}

?>
