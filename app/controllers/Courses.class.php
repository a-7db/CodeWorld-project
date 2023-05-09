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
    
    public function learn($crsID, $crs_slug, $vidID = '', $vid_Slug = ''){
        $course = $this->cmodel->Showdetails($crsID);
        if(isLoggedIn() && $this->traineeModel->find_order($crsID) || isLoggedIn() && $_SESSION['user_id'] == $course->userID){
            $allClips = $this->cmodel->getVideos($crsID);
            $stdTotal = $this->cmodel->stdTotal($crsID);
            $vid_count = $this->cmodel->vidTotal($crsID);
            $crs_count = $this->cmodel->crsTotal($course->userID);
            $firstVid = $this->cmodel->showlastVid($crsID);
            
            $data = [
                    'course' => $course,
                    'videos' => '',
                    'count' => $stdTotal,
                    'vid_count' => $vid_count,
                    'crs_count' => $crs_count,
                    'allClips' => $allClips
                ];
            if (empty($vidID) && empty($vid_Slug)) {
                $data['videos'] = $firstVid;
                $this->view('User/course_videos', $data);
            } else {
                $data['videos'] = $this->cmodel->getSelectedLecture($crsID, $vidID);
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
