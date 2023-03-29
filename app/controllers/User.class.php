<?php

 class User extends Controller {

    protected $regx = '/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/';

    public function login()
    {
        $this->view('User/login');
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
                $this->view('User/Home');
            }
            else{
                $this->view('User/registeration', $data);
            }

        } else{
            $data = [
                'username' => '',
                'fname' => '',
                'email' => '',
                'pass' => '',
                'confirm_pass' => '',

                # ERROR MESSAGES
                'username_err' => '',
                'fname_err' => '',
                'email_err' => '',
                'pass_err' => '',
                'confirm_pass_err' => '',
            ];
            $this->view('User/registeration', $data);
        }
    }

    public function ShowProfile()
    {
    }

    public function EditProfile()
    {
    }

}

?>