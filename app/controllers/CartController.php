<?php

class CartController extends Controller
{   
    protected $cartModel;

    public function __construct()
    {
        $this->cartModel = $this->loadModel('CartModel');
    }

    public function index()
    {
        $qty = isset($_GET['qty']) && $_GET['qty'] > 0 ? intval($_GET['qty']) : 1;
        $productId = isset($_GET['id']) ? $_GET['id'] : 0;

        if ($productId != 0) { # Nếu ID khác 0 thì tạo đơn hàng
            $this->addCart($productId, $qty);
        }       

        $data['title'] = 'Danh Sách Đơn Hàng';
        $data['products'] = $this->getProductCart();
        $data['template'] = 'cart/list';
        $data['hide_row'] = 1;

        return $this->loadView('main', $data);
        
    }

    protected function getProductCart()
    {
        $productIds = $this->getProductId(); # trả về mảng id
        $productIds = implode(",", $productIds); # chuyển mảng sang string

        return $this->cartModel->getProduct($productIds);
    }

    protected function getProductId()
    {
        if (isset($_SESSION['cart'])) {
            return array_keys($_SESSION['cart']); # Lấy key của mảng
        }
        return redirect('/');
    }

    protected function addCart($productId, $qty)
    {
        # Lấy thông tin giỏ hàng
        if (!isset($_SESSION['cart'])) { # Nếu chưa tồn tại giỏ hàng
           return $_SESSION['cart'][$productId]['qty'] = $qty; # Gán số lượng vào ID sản phẩm
        } 
        
        if (isset($_SESSION['cart'][$productId])) {# Nếu sản phẩm đã được đặt trước đó
            $qtyNew = $qty + $_SESSION['cart'][$productId]['qty'];

            return $_SESSION['cart'][$productId]['qty'] = $qtyNew;
        }  
        
        # Sản phẩm chưa có trong giỏ hàng thì thêm sản phẩm mới vào đơn hàng
        return $_SESSION['cart'][$productId]['qty'] = $qty;
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $cart = isset($_POST['cart']) ? (array) $_POST['cart'] : [];

            if (empty($cart)) { # Nếu trống danh sách sản phẩm
                return redirect('/gio-hang.html');
            }

            foreach ($cart as $key =>$value) {
                $_SESSION['cart'][$key]['qty'] = $value;
            }
        }

        return redirect('/gio-hang.html');
    }

    public function remove()
    {
        $id = (isset($_GET['id'])) ? intval($_GET['id']) : 0;

        unset($_SESSION['cart'][$id]);

        return redirect('/gio-hang.html');
    }

    public function send()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->store();
            $this->sendMail();
            return redirect('/dat-hang.html');
        }


        if (count($_SESSION['cart']) != 0) {
            $data['title'] = 'Đặt Hàng';
            $data['products'] = $this->getProductCart();
            $data['template'] = 'cart/send';
            $data['hide_row'] = 1;

            return $this->loadView('main', $data);
        }

        return redirect('/gio-hang.html');
    }

    public function sendMail()
    {
        # Load Email
        include _LIB . '/mail/sendMail.php';
        return mail::send();
    }

    public function store()
    {
        # Lấy thông tin từ khách hàng
        $data['name'] = isset($_POST['name']) ? makeSafe($_POST['name']) : '';
        $data['phone'] = isset($_POST['phone']) ? makeSafe($_POST['phone']) : '';
        $data['email'] = isset($_POST['email']) ? makeSafe($_POST['email']) : '';
        $data['address'] = isset($_POST['address']) ? makeSafe($_POST['address']) : '';
        $data['content'] = isset($_POST['content']) ? makeSafe($_POST['content']) : '';
        $data['payment'] = isset($_POST['payment']) ? intval ($_POST['payment']) : 1;
        $data['created_int'] = time();
        $data['is_view'] = 0;

        if ($data['name'] == '' || $data['phone'] == '' || $data['address'] == '') {
            sessionFlash('error' , 'Vui Lòng Nhập Đầy Đủ Thông Tin');
            return false;
        }

        # Insert customer
        $result = $this->cartModel->storeCustomer($data);

        if ($result) {
            $customerId =  $this->cartModel->customerLastId();
            $cart = $this->storeCart($customerId);

            if ($cart) {
                sessionFlash('success', 'Đặt Hàng Thành Công, Chúng Tôi Sẽ Liên Hệ Sau Ít Phút');
                return redirect('/gio-hang.html');

                unset($_SESSION['cart']); # Xóa giỏ hàng
               
            } 
        }

        sessionFlash('error' , 'Đặt Hàng Lỗi');
        return redirect('/dat-hang.html');
    }

    public function storeCart($customerId = 1)
    {
        $products = $this->getProductCart();

        while ($row = $products->fetch_assoc()) {
            $data = [
                'product_id' => $row['id'],
                'customer_id' => $customerId,
                'product_name' => $row['name'],
                'qty' =>  $_SESSION['cart'][$row['id']]['qty'],
                'unit_price' => $row['price_sale'] != 0 ? $row['price_sale'] : $row['price'],
                'thumb' => $row['thumb']
            ];

            $this->cartModel->storeCart($data);
        }

        return true;
    }
  
}