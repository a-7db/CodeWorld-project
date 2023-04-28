<?php

class Trainees extends Users {

    private $traineeModel;

    public function __construct()
    {
        $this->traineeModel = $this->model('Trainee');
    }

    public function AddToCart($Course_ID)
    {
        if (isLoggedIn() && !isAdmin() && !isInstructor()) {

            if($this->traineeModel->find_cart($Course_ID)){
                flash('AddToCart', 'Already Exist!', 'course is already in your cart');
                redirect('Courses/details/' . $Course_ID);
            } else if($this->traineeModel->find_order($Course_ID)){
                flash('AddToCart', 'You already bought it!', 'sorry, you cannot buy the course twice');
                redirect('Courses/details/' . $Course_ID);
            } else{

                if($this->traineeModel->fill_Cart($Course_ID)){
                    flash('AddToCart', 'done', 'course is added ');
                    redirect('Courses/details/' . $Course_ID);
                } else{
                    flash('AddToCart', 'Error', 'something went error ');
                    redirect('Courses/details/' . $Course_ID);
                }
            }

        } else {
            flash('AddToCart', 'Sorry', 'Admins and instructors cannot buy courses');
            redirect('Courses/details/' . $Course_ID);
        }

    }


    public function cart()
    {
        $cart = $this->traineeModel->getCart();

        $data = [
            'cart' => $cart
        ];

        $this->view('User/cart', $data);
    }

    public function ShowPaidCourse()
    {
    }
}

?>