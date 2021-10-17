<?php

class App 
{
    protected $controller = 'MainController';
    protected $action = 'index';
    protected $param = [];
    protected $queryArray;

    public function __construct() 
    {
        $this->queryArray = $this->queryHandle();

        $pathControlller = $this->controller($this->queryArray);

        if ($pathControlller) {

            if (file_exists('./app/controllers/' . $pathControlller . '.php')) {
                
                $this->controller = $pathControlller;
            } else {
                header('location: /');
            }
        }

        # update path
        if (is_null($pathControlller) && !is_null($this->queryArray)) {
            $this->controller = implode("/" , $this->queryArray) . "/" . $this->controller;
        }
      
        include './app/controllers/' . $this->controller . '.php';

        $nameController = explode('/' , $this->controller);
        $nameController = end($nameController);

        $this->controller = new $nameController;

        # Xử lý action

        if (isset($this->queryArray) && count($this->queryArray) != 0) {

            if (method_exists($this->controller, $this->queryArray[0])) {

                $this->action = $this->queryArray[0];
            }

            unset ($this->queryArray[0]);
        }

        # xử lý param

        $this->param = isset($this->queryArray) && count($this->queryArray) > 0 ? ($this->queryArray) : [];

        call_user_func_array([$this->controller, $this->action] , $this->param);

        

    }

    protected function queryHandle()
    {
        if (isset($_GET['query']) && $_GET['query'] != '') {

            global $cf_route; # Load thông tin ở route

            $arrayQuery = explode("/" , filter_var(trim($_GET['query'] , '/')));


            foreach($arrayQuery as $key => $value) {
                if(isset($cf_route[$value])) {
                    
                    $arrayQuery[$key] = $cf_route[$value];
                }
            }

            # Chuyển mảng thành string
            $arrayNew = implode("/", $arrayQuery);

            # Cắt chuỗi thành mảng
            return explode("/", $arrayNew);
            
        }

        return null;
    }

    protected function controller($array, $path = '')
    {
        if (is_null($array)) {

            return false;
        }

        $path = $path == '' ? './app/controllers' : $path;

        foreach ($array as $key => $value) {

            $pathControlller = $path . '/' . $value;

            if (!is_dir($pathControlller)) {

                unset($array[$key]);

                $this->queryArray = array_values($array);

                $fullPath = $path . '/' . ucfirst($value) . 'Controller';

                return str_replace("./app/controllers/" , "" , $fullPath);
            }

            unset($array[$key]);

            return $this->controller($array, $pathControlller);
        }
    }
}