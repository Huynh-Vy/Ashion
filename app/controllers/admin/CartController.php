<?php

class CartController extends Auth
{
    protected $cartModel;

    public function __construct()
    {
        $this->cartModel = $this->loadModel('admin/CartModel');
    }

    public function index()
    {
        $data['title'] = 'Danh Sách Khách Hàng Mới Nhất';
        $data['template'] = 'cart/customer';

        # Lấy dữ liệu khách hàng và phân trang
        $limit = 6;
        #Kiểm tra page hiện tại
        $page = (isset($_GET['page']) && $_GET['page'] > 1) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        $numRowCart = $this->cartModel->numRows();

        $data['customers'] = $this->cartModel->get($limit, $offset);
        $data['page'] = Helper::page($numRowCart, $limit, '/admin/cart/index', $page);

        return $this->loadView('admin/main', $data);
    }

    public function view($id = 0)
    {
        $customer = $this->cartModel->show($id);
        
        if ($customer !== true) {
            $data['title'] = 'Thông Tin Khách Hàng: ' . $customer['name'];
            $data['template'] = 'cart/detail';
            $data['customer'] = $customer;
            
            $data['products'] = $this->cartModel->getCart($id);

            $this->cartModel->updateCustomer($id);

            return $this->loadView('admin/main', $data);
        }

        sessionFlash('error', 'Không Tồn Tại Id');
        return redirect('/admin/cart');
    }

    public function delete($id = 0)
    {
        #Kiểm tra phương thức có phải là POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

            $customer = $this->cartModel->show($id);
            if ($customer === false) {
                return json([
                    'error' => true,
                    'messages' => 'Không tồn tại ID'
                ]);
            }

            $delete = $this->cartModel->delete($id);
            if ($delete) {
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