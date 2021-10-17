<?php


class MainController extends Auth
{
    public function __construct()
    {
        # khởi tạo function từ class Auth
        parent::__construct();

    }

    public function index()
    {
        $data['title'] = 'Trang Quản Trị Admin';
        $data['template'] = 'home';

        return $this->loadView('admin/main', $data);
    }
}