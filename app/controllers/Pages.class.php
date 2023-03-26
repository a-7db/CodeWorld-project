<?php
Class Pages extends Controller{
    private $crsModel;
    public function __construct()
    {
        $this->crsModel = $this->model('course');
    }

    public function index(){
    
        $data = [
            'name' => 'Ali',
            
        ];
        $this->view('User/Home', $data);
    }

    public function contact(){
        $this->view('User/contact');
    }
    
     public function login(){
        $this->view('User/login');
    }

    public function registeration(){
        $this->view('User/registeration');
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
}
?>
