<?php

class AuthApi extends Controller
{
    protected $userModel;
    protected $user;
    
    public function __construct()
    {
        if (isset($_SERVER['HTTP_TOKEN']) && $_SERVER['HTTP_TOKEN'] != '') {

            $this->userModel = $this->loadModel('api/UserModel');

            $result = $this->checkToken();

            

            if ($result) {
                return $this->user = $result;

            } 
        }
        echo json([
            'error' => true,
            'message' => 'Token error'
        ]);
        die();
    }

    protected function checkToken()
    {
        $token = makeSafe($_SERVER['HTTP_TOKEN']);

        return $this->userModel->checkToken($token);

    }
}
