<?php

 class Users extends Controller {

    protected $regx = '/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/';
    protected $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'email' => trim($_POST['email']),
                'pass' => trim($_POST['pass']),

                # ERROR MESSAGES
                'email_err' => '',
                'pass_err' => '',
            ];

            if (empty($data['email'])) {
                $data['email_err'] = 'Please Enter Your Email';
            } else {
                if (!preg_match($this->regx, $data['email'])) {
                    $data['email_err'] = 'Email Is Not Correct';
                }
            }

            if (empty($data['pass'])) {
                $data['pass_err'] = 'Please Enter Password';
            } elseif (strlen($data['pass']) < 6 || strlen($data['pass']) > 15) {
                $data['pass_err'] = 'Password Must Be Between 6 - 15 Characters';
            }

            if($this->userModel->findUserByEmail($data['email'])){

            } else{
                $data['email_err'] = 'No User Found';
            }

            if (
                empty($data['email_err']) &&
                empty($data['pass_err'])
            ) {
                $loggedInUser = $this->userModel->login($data['email'], $data['pass']);

                if($loggedInUser){
                    $this->createUserSession($loggedInUser);
                } else{
                    $data['pass_err'] = 'Incorrect Password';
                    $this->view('User/login', $data);
                }
            } else {
                $this->view('User/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'pass' => '',

                # ERROR MESSAGES
                'email_err' => '',
                'pass_err' => '',
            ];
            $this->view('User/login', $data);
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'fname' => trim($_POST['Fname']),
                'email' => trim($_POST['email']),
                'pass' => trim($_POST['pass']),
                'confirm_pass' => trim($_POST['confirm_pass']),

                # ERROR MESSAGES
                'fname_err' => '',
                'email_err' => '',
                'pass_err' => '',
                'confirm_pass_err' => '',
            ];

            if (empty($data['fname'])) {
                $data['fname_err'] = 'Please Enter Your Name';
            }

            if (empty($data['email'])) {
                $data['email_err'] = 'Please Enter Your Email';
            } else{
                if(!preg_match($this->regx, $data['email'])){
                    $data['email_err'] = 'Email Is Not Correct';
                } elseif($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email Is Already Taken';
                }
            }

            if (empty($data['pass'])) {
                $data['pass_err'] = 'Please Enter Password';
            } elseif(strlen($data['pass']) < 6 || strlen($data['pass']) > 15){
                $data['pass_err'] = 'Password Must Be Between 6 - 15 Characters';
            }

            if (empty($data['confirm_pass'])) {
                $data['confirm_pass_err'] = 'Please Confirm Your Password';
            } else{
                if($data['pass'] != $data['confirm_pass']){
                    $data['confirm_pass_err'] = 'Passwords Do Not Match';
                }
            }

            if (empty($data['fname_err']) &&
                empty($data['email_err']) &&
                empty($data['pass_err']) &&
                empty($data['confirm_pass_err']))
            {
                $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);
                
                if ($this->userModel->register($data)) {
                    redirect('Users/login');
                } else{
                    die('Something went wrong');
                }
            }
            else{
                $this->view('User/registeration', $data);
            }

        } else{
            $data = [
                'fname' => '',
                'email' => '',
                'pass' => '',
                'confirm_pass' => '',

                # ERROR MESSAGES
                'fname_err' => '',
                'email_err' => '',
                'pass_err' => '',
                'confirm_pass_err' => '',
            ];
            $this->view('User/registeration', $data);
        }
    }

    public function createUserSession($user){
        session_start();
        $_SESSION['user_id'] = $user->user_ID;
        $_SESSION['user_name'] = $user->fname;
        $_SESSION['user_email'] = $user->email;
        redirect();
    }

    public function logout(){
        session_start();
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('Users/login');
    }

    public function profile()
    {
        $this->view('User/profile');
    }

    public function EditProfile()
    {
    }

}

?>