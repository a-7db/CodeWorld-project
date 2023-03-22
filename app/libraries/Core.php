<?php

class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $Params = [];
    
    public function __construct()
    {
        # get CLASS name from URL

        $url = $this->getUrl();
        if (file_exists('../app/controllers/'. ucwords($url[0]). '.class.php')) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        require_once '../app/controllers/'. $this->currentController . '.class.php';

        $this->currentController = new $this->currentController;

        # get METHOD name from URL

        if(isset($url[1])){
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        
        # get PARAMS name from URL

        $this->Params = $url ? array_values($url) : [];
     
        call_user_func_array([$this->currentController, $this->currentMethod], $this->Params);

    }

    public function getUrl(){
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }

        $pages = ['Pages'];

        return $pages;
    }

}

?>