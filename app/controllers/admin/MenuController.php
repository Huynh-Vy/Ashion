<?php

class MenuController extends Auth
{
    protected $menuModel;

    public function __construct()
    {
        parent::__construct();

        $this->menuModel = $this->loadModel('/admin/MenuModel');
    }


    public function add()
    {
        $data['title'] = 'Thêm Danh Mục Mới';
        $data['template'] = 'menu/add';

        return $this->loadView('admin/main', $data);
    }

    public function store()
    {
        # Kiểm tra method gởi lên
        if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
            $name             = isset($_POST['name']) ? makeSafe($_POST['name']) : '';
            $description      = isset($_POST['description']) ? makeSafe($_POST['description']) : '';
            $sort             = isset($_POST['sort']) ? intval($_POST['sort']) : 1;
            $active           = isset($_POST['active']) ? intval($_POST['active']) : 1;

            # validate thông tin
            if ($name == '' || $description == '') {
                sessionFlash('error' , 'Tên Danh Mục và Nội Dung Mô Tả Không trống');
                return redirect('/admin/menu/add');
            }

            $query = $this->menuModel->insert($name, $description, $sort, $active);
           
            if ($query) {
                sessionFlash('success' , 'Thêm Danh Mục Thành Công');
                return redirect('/admin/menu/add');
            }
            sessionFlash('error', 'Thêm Danh Mục lỗi');
            return redirect('/admin/menu/add');

        }

        # tạo lỗi
        sessionFlash('error' , 'Phương thức không đúng');
        return redirect('/admin/menu/add'); # chuyển trang
    }
    
    public function lists()
    {
        $data['title'] = 'Danh Sách Danh Mục';
        $data['template'] = 'menu/lists';

        #Phân Trang
        $page = 1;
        $limit = 4;

        # Kiểm tra page hiện tại
        $page = isset($_GET['page']) && $_GET['page'] > 1 ? intval($_GET['page']) : 1;

        $offset = ($page - 1) * $limit;

        $numRowMenu = $this->menuModel->numRows();

        $data['menu'] = $this->menuModel->showAll($limit, $offset);
        $data['page'] = Helper::page($numRowMenu, $limit, '/admin/menu/lists', $page);
        

        return $this->loadView('admin/main', $data);
    }

    public function edit(int $id = 0)
    {
        $menu = $this->menuModel->show($id);
        if (!$menu) {
            sessionFlash('error', 'ID Không Tồn tại');

            return redirect('/admin/menu/lists');
        }

        $data['title'] = 'Chỉnh sửa Danh Mục ' . $menu['name'];
        $data['template'] = 'menu/edit';
        $data['menu'] = $menu;

        return $this->loadView('admin/main' , $data);
    }

        
    public  function update(int $id = 0)
    {
       # Kiểm tra method gởi lên
       if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
            # Kiểm tra ID có trong DB hay không
            $menu = $this->menuModel->show($id);
            if (!$menu) {
                sessionFlash('error', 'ID Không Tồn tại');

                return redirect('/admin/menu/lists');
            }

            $name             = isset($_POST['name']) ? makeSafe($_POST['name']) : '';
            $description      = isset($_POST['description']) ? makeSafe($_POST['description']) : '';
            $sort             = isset($_POST['sort']) ? intval($_POST['sort']) : 1;
            $active           = isset($_POST['active']) ? intval($_POST['active']) : 1;

            # validate thông tin
            if ($name == '' || $description == '') {
                sessionFlash('error' , 'Tên Danh Mục và Nội Dung Mô Tả Không trống');
                return redirect('/admin/menu/edit/' . $id);
            }

            $query = $this->menuModel->update($id, $name, $description, $sort, $active);
            
            if ($query) {
                sessionFlash('success' , 'Cập Nhật Danh Mục Thành Công');
                return redirect('/admin/menu/lists');
            }
            sessionFlash('error', 'Cập Nhật Danh Mục lỗi');
            return redirect('/admin/menu/edit/' . $id);
       }

       # tạo lỗi
       sessionFlash('error' , 'Phương thức không đúng');
       return redirect('/admin/menu/lists'); # chuyển trang

    }

    public function delete()
    {
        if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
            $id = intval($_POST['id']);
            
            $menu = $this->menuModel->show($id);
            if (!$menu) {
                return json([
                    'error' => true,
                    'messages' => 'Không Tồn Tại ID'
                ]);
            }
            
            $query = $this->menuModel->delete($id);

            if ($query) {
                return json([
                    'error' => false,
                    'messages' => 'Xóa Thành Công'
                ]);
            }

            return json([
                'error' => true,
                'messages' => 'Có Lỗi Không Thể Xóa'
            ]);
        }
        return redirect('/');
    }
    
  
}
