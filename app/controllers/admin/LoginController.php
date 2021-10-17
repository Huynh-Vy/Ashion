<?php

Class LoginController extends Controller
{
    public $userModel;

    public function __construct()
    {
        # Kiểm tra nếu đã đăng nhập
        if (isset($_COOKIE['user_cookie'])) {
            return redirect('/admin/main');
        }
        $this->userModel = $this->loadModel('admin/UserModel');
    }

    public function index()
    {
        $data['title'] = 'Đăng Nhập Vào Hệ thống';
        
        return $this->loadView('admin/login', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $email = isset($_POST['email']) ? makeSafe($_POST['email']) : '';
            $password = isset($_POST['password']) ? makeSafe($_POST['password']) : '';

            if ($email == '' || $password == '') {
                sessionFlash('error' , 'Vui lòng nhập đầy đủ thông tin');
                return redirect('/admin/login');
            }

            $user  = $this->userModel->show($email);

            if($user) {
                if (password_verify($password, $user['password'])) {
                    # đăng nhập thành công
                    setcookie('user_cookie', $email , time() + (86400 * 30),"/");

                    return redirect('/admin/main');
                }

                sessionFlash('error', 'Mật khẩu không chính xác');
                return redirect('/admin/login');
            }

            sessionFlash('error', 'Email không chính xác');
            return redirect('/admin/login');
        
        }
        return redirect('/admin/login');
    }
        
}