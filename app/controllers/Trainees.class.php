<?php

class Trainees extends Users {

    private $traineeModel;

    public function __construct()
    {
        if(!isLoggedIn() || isAdmin() || isInstructor()){
            redirect();
        }
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
            flash('AddToCart', 'Sorry', 'Please login to be able to buy');
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

    public function checkout()
    {
        if (isLoggedIn() && !isAdmin() && !isInstructor()) {

            $row = $this->traineeModel->getCart();

            foreach ($row as $cart) {
                $data = [
                    'price' => $cart->price,
                    'crs_ID' => $cart->crs_ID
                ];
                $this->traineeModel->do_order($data);
            }
            foreach ($row as $cart) {

                $this->traineeModel->deleteCart();
            }
            flash('checkout', 'Congratulations', 'Now you can watch and learn to code');
            redirect('Trainees/myLearning');
        } else {
            flash('checkout', 'Sorry', 'Please login to be able to buy');
            redirect('Trainees/cart');
        }
    }

    public function myLearning()
    {
        $data = [
            'course' => $this->traineeModel->my_Learning()
        ];
        $this->view('User/myLearning', $data);
    }
}

?>