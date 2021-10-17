<?php

class MainController extends Controller
{
    protected $sliderModel;
    protected $productModel;

    public function __construct()
    {
        $this->sliderModel = $this->loadModel('SliderModel');
        $this->productModel = $this->loadModel('ProductModel');
    }

    public function index()
    {
        $data['title'] = 'Ashion | Online Fashion & Kid Clothes';
        $data['template'] = 'home';
        $data['description'] = 'Ashion là điểm đến mua sắm thời trang gia đình và trẻ em. 
                                Chúng tôi cung cấp chất lượng với giá tốt nhất và theo 
                                một cách bền vững';
        $data['image'] = 'Link Ảnh';
        $data['slider'] = $this->sliderModel->showAll();
        $data['products'] = $this->productModel->show();

        return $this->loadView('main', $data);
    }
}