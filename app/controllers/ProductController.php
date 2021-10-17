<?php

class ProductController extends Controller
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = $this->loadModel('ProductModel');
    }

    public function show($id = 0)
    {
        $product = $this->productModel->showProduct($id);

        if ($product !== false) {
            $data['title'] = $product['name'];
            $data['template'] = 'product/content';
            $data['products'] = $product;
            $data['hide_row'] = 1;
            $data['thumb'] = $product['thumb'];
            $data['description'] = $product['description'];
        
            return $this->loadView('main', $data);
        }

        sessionFlash('error', 'ID Không Tồn Tại');
        return redirect();
        
    }
}