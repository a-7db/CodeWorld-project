<?php

class Admins extends Users {

    private $adminModel;
    private $cmodel;
    public function __construct()
    {
        if(!isAdmin()){
            redirect();
        }
        $this->cmodel = $this->model('course');
        $this->adminModel = $this->model('Admin');
    }

    public function index()
    {
        $money  = $this->cmodel->Count_Money();
        $users = $this->cmodel->countAllusers();
        $courses = $this->cmodel->countAllcourses();
        $paidUsers = $this->adminModel->getPaidUsers();
        $topCourses = $this->adminModel->top_courses();
        $topTrainees = $this->adminModel->top_trainees();
        $row=$this->adminModel->getTax();
        $data = [ 

            'money' => $money,
            'users' => $users,
            'courses' => $courses,
            'paid_users' => $paidUsers,
            'top_courses' => $topCourses,
            'top_trainees' => $topTrainees,
            'Tax' => $row->Tax,
            ];


            $this->view('Admin/adminHome' ,$data);
    }

    public function users()
    {
        $users = $this->adminModel->showUsers();
        $instructors = $this->adminModel->showInstructors();
        $data = [
            'users' => $users,
            'instu' => $instructors,
        ];
        $this->view('Admin/users_controller', $data);
    }

    public function activeUser()
    {
        if(isset($_POST['user_id_active'])){
            $userID = $_POST['user_id_active'];
            $email = $_POST['email_active'];
            if ($row = $this->adminModel->activeUser($userID)) {
                if($row->Role_ID == 2){
                    send_mail($email, 'Activating', 'Congraltions <b>Code World</b> website activate your account and you can sign-in as instructor.');
                } else{
                    send_mail($email, 'Activating', 'Congraltions <b>Code World</b> website activate your account and you can sign-in now.');
                }
                redirect('Admins/users');
                admin_flash('isActivated', 'Success', 'user activated successfuly');
            } else {
                redirect('Admins/users');
                admin_flash('isActivated','Error', 'something went wrong!');
            }

        }
    }

    public function deleteUser()
    {
        if (isset($_GET['user_id'])) {
            
            if ($this->adminModel->deleteUser($_GET['user_id'])) {
                redirect('Admins/users');
                admin_flash('isActivated', 'Success', 'user is deleted successfuly');
            } else {
                redirect('Admins/users');
                admin_flash('isActivated', 'Error', 'something went wrong!');
        }
        }
    }

    public function edit_categories(){
        if (isset($_POST['cate'])) {
            $data = [
                'cate' => $_POST['cate'],
                'cate_err' => '',
                'slug' => '',
                'newID' => ''
            ];

            if (empty($data['cate'])) {
                $data['cate_err'] = 'No data to add!';
                $this->view('Admin/cate_editing', $data);
            } else{

                $lastID = $this->adminModel->lastCateID();
                $data['newID'] = $lastID->category_ID += 1000;
                $data['slug'] = slug($data['cate']);
    
                if ($this->adminModel->insert_cate($data)) {
                    redirect('Admins/edit_categories');
                } else {
                    redirect('Admins/edit_categories');
                }
            }

        } else {
            $data = [
                'cate' => '',
                'cate_err' => ''
            ];
            $this->view('Admin/cate_editing', $data);
        }
    }

    public function update_cate_name(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->adminModel->update_cate_name($_POST['cateID'], $_POST['cate_name']);
        }
    }

    public function remove_category($cateID){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->adminModel->remove_category($cateID);
        }
    }


    public function Feedback()
    { 
        $feedbacks = $this->adminModel->getFeedbacks();
        $selectedFeddbacks = $this->adminModel->get_selected_feedbacks();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'comments' => $feedbacks,
                'selectedFeddbacks' => $selectedFeddbacks,
                'error' => ''
            ];

            if(empty($_POST['feedbacks'])){
                $data['error'] = 'There is no feedback selected!';
                $this->view('Admin/feedback', $data);
            } else{
                $IDS = [];
                foreach($_POST['feedbacks'] as $IDs){
                    $IDS[] = $IDs;
                }
                for($i = 0; $i < count($IDS); $i++){
                    $this->adminModel->update_feedbacks_home($IDS[$i]);
                }
                redirect('Admins/Feedback');
            }
        } else{

            $data = [
                'comments' => $feedbacks,
                'selectedFeddbacks' => $selectedFeddbacks,
                'error' => ''
            ];

            $this->view('Admin/feedback', $data);
        }

    }

    public function delete_comment($commID)
    {
        if(isset($commID)){
            $this->adminModel->delete_comment($commID);
            redirect('Admins/Feedback');
        }else{
            redirect('Admins/Feedback');
        }
    }


    public function tax()
    {
        $row = $this->adminModel->getTax();
        if(isset($_POST['Tax'])){
            $data = [
                'tax' => $row->Tax * 100,
                'newTax' => $_POST['Tax'],
                'tax_err' => ''
            ];

            if(empty($data['newTax'])){
                $data['tax_err'] = 'No data to add!';
                $this->view('Admin/tax', $data);
            } else{
                $this->adminModel->update_Tax($data['newTax']);
                redirect('Admins/tax');
            }

        } else{
            $data =[
                'tax' => $row->Tax * 100,
            ];
    
            $this->view('Admin/tax', $data);
        }
        
    }



}
?>
