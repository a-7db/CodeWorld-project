<?php

 class User extends Controller {

    protected $User_ID;
    protected $Role_ID;
    protected $Fname;
    protected $Useranme;
    protected $Email;
    protected $Password;

    public function index()
    {
        $this->view('User/login');
    }

    public function registeration()
    {
        $this->view('User/registeration');
    }

    public function ShowProfile()
    {
    }

    public function EditProfile()
    {
    }

}

?>