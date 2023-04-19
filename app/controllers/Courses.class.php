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


    public function __construct()   //hdb
    {
         $this->cmodel = $this->model('course');


    }


    public function index()  //hdb
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

    public function AddToCart($Course_ID){
      
        if($Course_ID != null){
          
        if(isLoggedIn()){
           
            $data = $this->cmodel->Showdetails($Course_ID);
            $cmodel = $this->cmodel->fill_Cart($Course_ID);
            // $this->view('User/course_details', $data);
            redirect('User/course_details/'.$data->crs_ID);

        }
        else{
            echo' you have to log in first or something is wrong';
        }

        }

    }


    public function cart(){

        $cart = $this->cmodel->getCart();

        $data =[
            'cart' => $cart
        ]; 

        $this->view('User/cart',$data);

    }

   





}

?>
