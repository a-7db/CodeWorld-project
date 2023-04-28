<?php
class Controller {
    private $crsModel;
    public function model($model){
        require_once '../app/models/' . $model .'.model.php';

        return new $model;
    }

    public function view($view, $data = [], $allcate = []){
        if (file_exists('../app/views/' . $view . '.php')) {
            $allcate['cate'] = $this->showCategory();
            require_once '../app/views/' . $view . '.php';
        }
        else{
            echo $view . '.php is not found in lib/controller.php';
        }
    }

    private function showCategory()
    {
        $this->crsModel = $this->model('course');
        return $this->crsModel->get_categories();
    }
}
?>