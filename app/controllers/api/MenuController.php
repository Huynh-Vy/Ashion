<?php

class MenuController extends AuthApi
{
    protected $menuModel;
    
    public function __construct()
    {
        parent::__construct();

        $this->menuModel = $this->loadModel('api/MenuModel');
    }

    public function index()
    {
        echo 'Đã chạy menu';
    }

    public function add()
    {
        # Kiểm tra method gởi lên
        if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
            $name             = isset($_POST['name']) ? makeSafe($_POST['name']) : '';
            $description      = isset($_POST['description']) ? makeSafe($_POST['description']) : '';
            $sort             = isset($_POST['sort']) ? intval($_POST['sort']) : 1;
            $active           = isset($_POST['active']) ? intval($_POST['active']) : 1;

            # validate thông tin
            if ($name == '' || $description == '') {
                return json([
                    'error' => true,
                    'message' => 'Tên Danh Mục Và Mô Tả Không Trống'
                ]);
            }

            $query = $this->menuModel->insert($name, $description, $sort, $active);
           
            if ($query) {
                return json([
                    'error' => false,
                    'message' => 'Thêm Danh Mục Thành Công'
                ]);
            }
            return json([
                'error' => true,
                'message' => 'Thêm Danh Mục Lỗi'
            ]);

        }

        # tạo lỗi
        return json([
            'error' => true,
            'message' => 'Method Error'
        ]);
    }

    public function show()
    {
        $result = $this->menuModel->show();

        return json($result);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = isset($_POST['id']) ? $_POST['id'] : 0;

            if ($id == 0) {
                return json ([
                    'error' => true,
                    'message' => 'ID Error'
                ]);
            }

            $menu = $this->menuModel->showItem($id);
            if (!$menu) {
                return json ([
                    'error' => true,
                    'message' => 'ID Không Tồn Tại'
                ]);
            }

            $name             = isset($_POST['name']) ? makeSafe($_POST['name']) : '';
            $description      = isset($_POST['description']) ? makeSafe($_POST['description']) : '';
            $sort             = isset($_POST['sort']) ? intval($_POST['sort']) : 1;
            $active           = isset($_POST['active']) ? intval($_POST['active']) : 1;

            # validate thông tin
            if ($name == '' || $description == '') {
                return json ([
                    'error' => true,
                    'message' => 'Tên Danh Mục Và Mô Tả Không Trống'
                ]);
            }

            $query = $this->menuModel->update($id, $name, $description, $sort, $active);
            
            if ($query) {
                return json ([
                    'error' => false,
                    'message' => 'Cập Nhật Danh Mục Thành Công'
                ]);
            }

            return json ([
                'error' => false,
                'message' => 'Cập Nhật Danh Mục lỗi'
            ]);
        }

        return json([
            'error' => true,
            'message' => 'Mehod Error'
        ]);
    }
}