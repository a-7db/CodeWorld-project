<?php
Class Pages extends Controller{
    private $crsModel;
    public function __construct()
    {
        $this->crsModel = $this->model('course');
    }

    public function index(){
<<<<<<< HEAD
    
        $data = [
            'name' => 'Ali',
            
=======
        $getdata = $this->crsModel->getData();
        $data = [
            'name' => 'Ali',
            'crs' => $getdata
>>>>>>> 04b9b82013a8f67dbb4da6b702876832b2be670c
        ];
        $this->view('User/Home', $data);
    }

    public function about(){
        $this->view('User/about');
    }
}
?>