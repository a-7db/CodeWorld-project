<?php

class Admins extends Users {

    private $adminModel;
    public function __construct()
    {
        if(!isAdmin()){
            redirect();
        }
        $this->adminModel = $this->model('Admin');
    }

    public function index()
    {
        $this->view('Admin/adminHome');
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
        if(isset($_GET['user_id_active'])){
            
            if ($this->adminModel->activeUser($_GET['user_id_active'])) {
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

    public function CreateCourse()
    {
    }

    public function EditCourse()
    {
    }

    public function DeleteCourse()
    {
    }

    public function AddVideo()
    {
    }

    public function AddQuestions()
    {
    }
}
?>