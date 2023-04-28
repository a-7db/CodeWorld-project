<?php

class Courses extends Controller {
    
    private $cmodel;


    public function __construct()
    {
         $this->cmodel = $this->model('course');
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

    

    public function categories($cate){
        $this->view('User/categories');
    }





}

?>
