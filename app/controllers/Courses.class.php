<?php

class Courses extends Controller {
    private $cmodel;
    private $Course_ID;
    private $InstructorID;
    private $Videos = [];
    private $Title;
    private $Description;
    private $Questions = [];
    private $IsLocked;

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
        $data = $this->cmodel->Showdetails($id);

        $data2 = [
            // 'details' => $details
        ];

        $this->view('User/course_details', $data);
    }



}

?>