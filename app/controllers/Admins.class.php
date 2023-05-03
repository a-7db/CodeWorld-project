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
         $users =  $this->cmodel->countAllusers();
         $courses =  $this->cmodel->countAllcourses();

        $data = [ 

             'money' => $money,
              'users' => $users,
              'courses' => $courses

            ];

          //  $this->view('Instructor/instructorHome', $data);
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
