<?php

class ProductController extends Auth
{
    protected $productModel;
    protected $menuModel;

    public function __construct()
    {
        parent::__construct(); #Chạy function __construct trong Auth

        $this->productModel = $this->loadModel('admin/ProductModel');
        $this->menuModel = $this->loadModel('admin/MenuModel');
    }

    public function add()
    {
        $data['title'] = 'Thêm Sản Phẩm Mới';
        $data['template'] = 'product/add';
        $data['menu'] = $this->menuModel->get();

        return $this->loadView('admin/main', $data);
    }


    public function store()
    {
        #Kiểm tra phương thức có phải là POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            #Lấy name để validate
            $data['name'] = isset($_POST['name']) ? makeSafe($_POST['name']) : '';
            
            #Kiểm tra validate tên + file
            if ($data['name'] == '' || $_FILES['file']['name'] == '') {
                sessionFlash('error', 'Tên Sản phẩm hoặc Ảnh đại diện không trống');
                return redirect('/admin/product/add');
            }

            #Lấy thông tin từ Form
            $data['menu_id']        = isset($_POST['menu_id']) ? intval($_POST['menu_id']) : 0;
            $data['price']          = isset($_POST['price']) ? intval($_POST['price']) : 0;
            $data['price_sale']     = isset($_POST['price_sale']) ? intval($_POST['price_sale']) : 0;
            $data['description']    = isset($_POST['description']) ? makeSafe($_POST['description']) : '';
            $data['content']        = isset($_POST['content']) ? makeSafe($_POST['content']) : '';
            $data['active']         = isset($_POST['active']) ? intval($_POST['active']) : 0;
            $data['sort']           = isset($_POST['sort']) ? intval($_POST['sort']) : 0;
            $data['created_at']     = date("Y-d-m H:i:s");
            $data['updated_at']     = date("Y-d-m H:i:s");

            #Validate Giá Tiền
            $price = $this->getPrice($data['price'], $data['price_sale']);
            if ($price === false) {
                return redirect('/admin/product/add'); #Chuyển trang
            }

            #Xử lý hình ảnh Upload
            $data['thumb'] = $this->uploadFile($_FILES['file']);
            if ($data['thumb'] === false) {
                return redirect('/admin/product/add'); #Chuyển trang
            }
            
            #Thêm dữ liệu vào data
            $query = $this->productModel->insert($data);
            if ($query) {
                sessionFlash('success', 'Thêm sản phẩm thành công');
                return redirect('/admin/product/add');
            }

            sessionFlash('error', 'Thêm sản phẩm LỖI');
            return redirect('/admin/product/add');
        }

        sessionFlash('error', 'Phương thức không đúng');
        return redirect('/admin/product/add'); #Chuyển trang
    }

    protected function getPrice(int $price = 0, int $priceSale = 0)
    {
        #Nếu giá gốc và giá giảm lớn hơn không
        if ($price > 0 && $priceSale > 0) { #Admin có nhập giá tiền gốc và giảm
            if ($priceSale >= $price) { #Nếu giá giảm lớn hơn gốc => sai
                sessionFlash('error', 'Giá giảm không được lớn hơn hoặc bằng giá gốc');
                return false;
            }
        }

        #Nếu admin không nhập giá gốc mà lại nhập giá giảm => sai
        if ($price == 0 && $priceSale != 0) {
            sessionFlash('error', 'Giá gốc không được bỏ trống');
            return false;
        }

        return true;
    }

    protected function uploadFile($file)
    {
        #Lấy đường dẫn auto
        $path = Helper::getFolder();
        $pathFull = $path . basename($file['name']);

        $getImageSize = getimagesize($file['tmp_name']);
        if ($getImageSize == false) {
            sessionFlash('error', 'File Upload phải là file Ảnh');
            return false;
        }

        if ($file['size'] > 5000000) { # 2000Kb => 2 000 000 => 2M
            sessionFlash('error', 'File Ảnh không được hơn hơn 5000KB');
            return false;
        }

        $type = strtolower(pathinfo($pathFull, PATHINFO_EXTENSION));
        $arrayType = ['jpg', 'jpeg', 'gif', 'png', 'bmp'];
        if (!in_array($type, $arrayType)) {
            sessionFlash('error', 'File Ảnh không đúng định dạng');
            return false;
        }

        $nameFile = pathinfo($pathFull, PATHINFO_FILENAME);
        $pathFull = $path . $nameFile . '-' . time() . '.' . $type;

        if (move_uploaded_file($file['tmp_name'], $pathFull)) {
            return substr($pathFull, 1, 300); #Cắt chuỗi bỏ đi dâu . phía trước;
        }

        sessionFlash('error', 'Có lỗi không thể upload');
        return false;
    }

    public function lists()
    {
        $data['title'] = 'Danh Sách Sản Phẩm';
        $data['template'] = 'product/lists';

        #Lấy dữ liệu sản phẩm và phân trang
        
        $limit = 6;
        #Kiểm tra page hiện tại
        $page = (isset($_GET['page']) && $_GET['page'] > 1) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        $numRowProduct = $this->productModel->numRows();

        $data['product'] = $this->productModel->getAll($limit, $offset);
        $data['page'] = Helper::page($numRowProduct, $limit, '/admin/product/lists', $page);

        return $this->loadView('admin/main', $data);
    }

    public function edit($id = 0)
    {
        $product = $this->productModel->show($id);
        if ($product === false) {
            sessionFlash('error', 'ID không tồn tại.');
            return redirect('/admin/product/lists');
        }

        $data['title'] = 'Chỉnh Sửa Sản Phẩm: ' . $product['name'];
        $data['product'] = $product;
        $data['template'] = 'product/edit';
        $data['menu'] = $this->menuModel->get();

        return $this->loadView('admin/main', $data);
    }

    public function update($id = 0)
    {
        #Kiểm tra phương thức có phải là POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            #Kiểm tra Id có tồn tại hay không
            $product = $this->productModel->show($id);
            if ($product === false) {
                sessionFlash('error', 'ID không tồn tại.');
                return redirect('/admin/product/edit/' . $id);
            }

            #Lấy name để validate
            $data['name'] = isset($_POST['name']) ? makeSafe($_POST['name']) : '';
            
            #Kiểm tra validate tên
            if ($data['name'] == '') {
                sessionFlash('error', 'Tên Sản phẩm không trống');
                return redirect('/admin/product/edit/' . $id);
            }

            #Lấy thông tin từ Form
            $data['menu_id']        = isset($_POST['menu_id']) ? intval($_POST['menu_id']) : 0;
            $data['price']          = isset($_POST['price']) ? intval($_POST['price']) : 0;
            $data['price_sale']     = isset($_POST['price_sale']) ? intval($_POST['price_sale']) : 0;
            $data['description']    = isset($_POST['description']) ? makeSafe($_POST['description']) : '';
            $data['content']        = isset($_POST['content']) ? makeSafe($_POST['content']) : '';
            $data['active']         = isset($_POST['active']) ? intval($_POST['active']) : 0;
            $data['sort']           = isset($_POST['sort']) ? intval($_POST['sort']) : 0;
            $data['created_at']     = date("Y-d-m H:i:s");
            $data['updated_at']     = date("Y-d-m H:i:s");

            #Validate Giá Tiền
            $price = $this->getPrice($data['price'], $data['price_sale']);
            if ($price === false) {
                return redirect('/admin/product/edit/' . $id);
            }

            #Nếu người dùng có chọn ảnh để upload => Xử lý hình ảnh Upload
            if ($_FILES['file']['name'] != '' ) {
                $data['thumb'] = $this->uploadFile($_FILES['file']);
                if ($data['thumb'] === false) {
                    return redirect('/admin/product/edit/' . $id);
                }

                #Xóa ảnh thumb Cũ
                deleteFile($product['thumb']);
            }
            
            #Thêm dữ liệu vào data
            $query = $this->productModel->update($data, $id);
            if ($query) {
                sessionFlash('success', 'Cập sản phẩm thành công');
                return redirect('/admin/product/lists');
            }

            sessionFlash('error', 'Cập nhật sản phẩm LỖI');
            return redirect('/admin/product/edit/' . $id);
        }

        sessionFlash('error', 'Phương thức không đúng');
        return redirect('/admin/product/lists'); #Chuyển trang
    }

    public function delete()
    {
        #Kiểm tra phương thức có phải là POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

            $product = $this->productModel->show($id);
            if ($product === false) {
                return json([
                    'error' => true,
                    'messages' => 'Không tồn tại ID'
                ]);
            }

            $linkThumb = $product['thumb'];
            $delete = $this->productModel->delete($id);
            if ($delete) {
                deleteFile($linkThumb);
                return json([
                    'error' => false,
                    'messages' => 'Xóa thành công'
                ]);
            }
        }

        return json([
            'error' => true,
            'messages' => 'Method Error'
        ]);
    }
}