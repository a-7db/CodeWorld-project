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
        if(isLoggedIn()){
            redirect();
        }
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
                    if($loggedInUser->statu == true & $loggedInUser->Role_ID != 4){
                        $this->createUserSession($loggedInUser);
                    } else{
                        flash('watit_acception', 'Wait Email', 'Please wait for our acceptance and then you can log in');
                        redirect('Users/login');
                    }
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
        if (isLoggedIn()) {
            redirect();
        }
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
                    $this->send_email($data['email']);
                    $_SESSION['data'] = $data['email'];
                    redirect('Users/verifyEmail');
                } else{
                    flash('rege_success', 'Erorr', 'Something went wrong!.');
                    redirect('Users/login');
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
    
    public function verifyEmail()
    {
        if (isLoggedIn()) {
            redirect();
        }
        $data = [
            'email' => $_SESSION['data'],
            'code' => '',
            'code_err' =>'',
            'type' => 0
        ];
        
        if(!empty($data['email']))
        {
            if(isset($_POST['code'])){
                $data['code'] = trim($_POST['code']);

                if (empty($data['code'])) {
                    $data['code_err'] = 'Please Enter The Code';
                    $this->view('User/verify', $data);
                } else {
                    if ($row = $this->userModel->getCodeFromUser($data['email'], $data['code'])) {
                        unset($_SESSION['data']);
                        
                        if($this->userModel->udpdate_status($row->user_ID)){
                            flash('rege_success', 'Well done', 'You are registered and can log in.');
                            redirect('Users/login');
                        } else{
                            flash('rege_success', 'Error', 'Something went wrong.');
                            redirect('Users/login');
                        }
                    } else {
                        $data['code_err'] = 'The Code Is Incorrect';
                        $this->view('User/verify', $data);
                    }
                }
            }else{
                $this->view('User/verify', $data);
            }
        } else{
            redirect();
        }
    }
    

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->user_ID;
        $_SESSION['user_name'] = $user->fname;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['Role'] = $user->Role_ID;
        redirect();
    }

    public function logout(){
        session_start();
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        unset($_SESSION['Role']);
        session_destroy();
        redirect('Users/login');
    }

    public function profile()
    {
        if(!isLoggedIn() || !isTrainee()){
            redirect();
        }
        if(isset($_SESSION['user_id'])){
        
        $row = $this->userModel->getInfo($_SESSION['user_id']);
        $count_crs = $this->userModel->count_crs($_SESSION['user_id']);
        $count_reviews = $this->userModel->count_reviews($_SESSION['user_id']);
        $count_rating = $this->userModel->count_rating($_SESSION['user_id']);

        $data =[
            'name' =>$row->fname,
            'email' =>$row->email,
            'avatar' =>$row->profile,
            'count_crs' => $count_crs,
            'count_reviews' => $count_reviews,
            'count_rating' => $count_rating,
        ];

        $this->view('User/profile',$data);
       
       }
       else{
        $data =[
            'name' =>'',
            'email' =>'',
           
        ];

        $this->view('User/profile',$data);
       }
    }

    public function EditProfile()
    {
    }

    public function forgot_password(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = [
                'email' => '',
                'email_err' => '',

                'code' => '',
                'code_err' => '',

                'password' => '',
                'password2' => '',
                'password_err' => '',

                'mode' => '',
            ];


            
            // ENTER EMAIL
            if(isset($_POST['enter_email'])){
                $data['email'] = trim($_POST['enter_email']);

                if (empty($data['email'])) {
                    $data['email_err'] = 'Please Enter Your Email';
                    $this->view('User/forgot_password', $data);
                } else {
                    $_SESSION['email'] = $data['email'];
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $this->send_email($data['email']);

                        $data['mode'] = 'enter_code';
                        $this->view('User/forgot_password', $data);
                    } else {
                        $data['email_err'] = 'No User Found';
                        $this->view('User/forgot_password', $data);
                    }
                }
            }



            // ENTER CODE
            if(isset($_POST['enter_code'])){
                $data['code'] = trim($_POST['enter_code']);

                if (empty($data['code'])) {
                    $data['mode'] = 'enter_code';
                    $data['code_err'] = 'Please Enter The Code';
                    $this->view('User/forgot_password', $data);
                } else {
                    $currentExpire = time();
                    if($row = $this->userModel->getCodeFromUser($_SESSION['email'], $data['code'])){
                        if($row->expire > $currentExpire){
                            $data['mode'] = 'change_pass';
                            $this->view('User/forgot_password', $data);
                        }else{
                            $data['mode'] = 'enter_code';
                            $data['code_err'] = 'The Code Is Expired';
                            $this->view('User/forgot_password', $data);
                        }
                    }else {
                        $data['mode'] = 'enter_code';
                        $data['code_err'] = 'The Code Is Incorrect';
                        $this->view('User/forgot_password', $data);
                    }
                }
            }



            // CHANGE PASSWORD
            if(isset($_POST['password']) && isset($_POST['password2'])){
                $data['password'] = trim($_POST['password']);
                $data['password2'] = trim($_POST['password2']);

                if (empty($data['password']) || empty($data['password2'])) {
                    $data['mode'] = 'change_pass';
                    $data['password_err'] = 'Please Enter The New Password';
                    $this->view('User/forgot_password', $data);
                } else {
                    if($data['password'] != $data['password2']){
                        $data['password_err'] = 'Passwords Do Not Match';
                    } else{
                        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                        if($this->userModel->updateUserPassword($data['password'], $_SESSION['email'])){
                            flash('updatePassword', 'Password is Updated', 'Password is updated successfully and you can log in right now.');
                            redirect('Users/login');
                        } else{
                            flash('updatePassword', 'Error', 'Something went wrong.');
                            redirect('Users/login');
                        }
                    }
                }
            }

        } else{

            $data = [
                'email' => '',
                'email_err' => '',
                'mode' => '',
            ];

            $this->view('User/forgot_password', $data);
        }
    }

    private function send_email($email){
        $expire = time() + (60 * 1);
        $code = rand(1000, 9999);

        $this->userModel->forgotpass($email, $code, $expire);

        $message = '<p>Your code is <b style="font-size: 25px;">' . $code . '<b/><p/>';
        send_mail($email, 'Password Reset', $message);
    }

    public function resend(){

        $this->send_email($_SESSION['email']);

        $data['email'] = $_SESSION['email'];
        $data['mode'] = 'enter_code';
        $this->view('User/forgot_password', $data);
    }

}

?>
