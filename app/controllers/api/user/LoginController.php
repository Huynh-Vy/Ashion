<?php

class LoginController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = $this->loadModel('api/UserModel');
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $result = $this->login();

            return json($result);
        }

        return json([
            'error' => 'true',
            'message' => 'Phương Thức Không Chính Xác'
        ]);
    }

    protected function login()
    {
        $email      = isset($_POST['email']) ? makeSafe($_POST['email']) : '';
        $password   = isset($_POST['password']) ? makeSafe($_POST['password']) : '';

        if ($email == '' || $password == '') {
            
            return ['error' => true, 
                    'message' => 'Vui Lòng Nhập Đầy Dủ Thông Tin'
            ];
        }

        $user  = $this->userModel->show($email);

        if($user) {
            if (password_verify($password, $user['password'])) {

                # đăng nhập thành công thì tạo token mới sau đó lưu vào data
                $token = Token::create();
                $tokenExp = time() + 1800; # Lưu token 30 phút

                
                $this->userModel->updateToken($token, $tokenExp, $user['id']); # Cập nhật token vào data

                $user['token'] = $token; # Cập nhật token mới
                $user['token_exp'] = $tokenExp; 
                
                return ['error' => false, 
                        'user' => $user,
                ];
            }

            return ['error' => true, 
                    'message' => 'Mật Khẩu Không Chính Xác'
            ];
        }

        return ['error' => true, 
                'message' => 'Email Không Chính Xác'
        ];
    }
}