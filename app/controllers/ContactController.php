<?php

class ContactController extends Controller
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = $this->loadModel('CustomerModel');
    }

    public function index()
    {
        $data['title'] = 'Liên hệ Ashion';
        $data['template'] = 'contact';

        return $this->loadView('main', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $data['name'] = isset($_POST['name']) ? makeSafe($_POST['name']) : '';
            $data['email'] = isset($_POST['email']) ? makesafe($_POST['email']) :'';
            $data['message'] = isset($_POST['message']) ? makesafe($_POST['message']) :'';
            $data['created_at'] = time();
            $data['is_view'] = 0;

            if ($data['name'] == '' || $data['email'] == '' || $data['message'] == '') {
                sessionFlash('error', 'Vui lòng nhập đầy đủ thông tin');
                return redirect('/contact');
            }
            
            # Insert customer message
            $result = $this->customerModel->storeMessage($data);
            
            if ($result) {
                sessionFlash('success' , 'Cám Ơn Anh/Chị Đã Liên Hệ Asion');
                return ('/lien-he.html');
            }
            sessionFlash('error' , 'Hệ Thống Đang Bận. Vui Lòng Liên Hệ Sau');
            return redirect('/lien-he.html');
 
        }

    }
}