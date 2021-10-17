<?php

class MenuController extends Controller
{
    protected $menuModel;
    protected $productModel;

    public function __construct()
    {
        $this->menuModel = $this->loadModel('MenuModel');
        $this->productModel = $this->loadModel('ProductModel');
    }

    public function index()
    {
        return '';
    }

    public function show($id = 0)
    {
        # Kiểm tra id truyền vào có tồn tại hay không
        $menu = $this->menuModel->show($id);

        if ($menu !== false) {
            $data['title'] = $menu['name'];
            $data['template'] = 'menu/list';

            $limit = 12;
            #Kiểm tra page hiện tại
            $page = (isset($_GET['page']) && $_GET['page'] > 1) ? intval($_GET['page']) : 1;
            $offset = ($page - 1) * $limit;
            $numRowProduct = $this->productModel->numRows($id);

            $data['products'] = $this->productModel->getMenu($id, $limit, $offset);

            #/danh-muc/19/nam

            $data['page'] = Helper::page
                            ($numRowProduct, $limit, 
                            '/danh-muc/'. $id .'/' .toSlug($menu['name']), 
                            $page);

            return $this->loadView('main', $data);
        }
    }
}