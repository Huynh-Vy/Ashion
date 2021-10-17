<?php

class SliderController extends Auth
{
    protected $sliderModel;

    public function __construct()
    {
        parent::__construct(); # Chạy function construct của class Auth

        $this->sliderModel = $this->loadModel('admin/SliderModel');
    }

    public function add()
    {
        $data['title'] = 'Thêm Slider';
        $data['template'] = 'slider/add';

        return $this->loadView('admin/main', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            # Lấy name và link từ form để validate
            $data['title'] = isset($_POST['title']) ? makeSafe($_POST['title']) : '';
            $data['link'] = isset($_POST['link']) ? makeSafe($_POST['link']) : '';

            # Kiểm tra và validate tên, file và link
            if ($data['title'] == '' || $data['link'] == '' || $_FILES['file']['name'] == '') {
                sessionFlash('error', 'Tiêu đề, Ảnh Đại Diện và Đường Link Không Trống');
                return redirect('admin/slider/add');
            }

            $data['sort'] = isset($_POST['sort']) ? intval($_POST['sort']) : 0;
            $data['active'] = isset($_POST['active']) ? intval($_POST['active']) : 0;

            # Xử lý hình ảnh Upload
            $data['thumb'] = $this->uploadFile($_FILES['file']);
            if ($data['thumb'] == false) {
                return redirect('admin/slider/add');
            }

            #Thêm dữ liệu vào data
            $query = $this->sliderModel->insert($data);
            if ($query) {
                sessionFlash('success', 'Thêm slider thành công');
                return redirect('/admin/slider/add');
            }

            sessionFlash('error', 'Thêm Slider Lỗi');
            return redirect('/admin/slider/add');
        }
        sessionFlash('error', 'Phương thức không đúng');
        return redirect('/admin/slider/add'); #Chuyển trang
    }

    protected function uploadFile($file)
    {
        #Lấy đường dẫn auto
        $path = Helper::getFolder('./public/uploads/slider/');
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
        $data['title'] = 'Danh Sách Slider';
        $data['template'] = 'slider/lists';
        $data['slider'] = $this->sliderModel->showAll();

        return $this->loadView('admin/main', $data);
    }

    public function edit($id)
    {
        $slider = $this->sliderModel->show($id);

        if ($slider === false) {
            sessionFlash('error', 'ID Không Tồn Tại');
            return redirect('admin/slider/lists');
        }

        $data['title'] = 'Chỉnh Sửa Slider '. $slider['title'];
        $data['template'] = 'slider/edit';
        $data['slider'] = $slider;

        return $this->loadView('admin/main', $data);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            # Kiểm tra ID có tồn tại hay không
            $slider = $this->sliderModel->show($id);
            if ($slider === false) {
                sessionFlash('error', 'ID Không Tồn Tại');
                return redirect('admin/slider/lists');
            }

            # Lấy name và link từ form để validate
            $data['title'] = isset($_POST['title']) ? makeSafe($_POST['title']) : '';
            $data['link'] = isset($_POST['link']) ? makeSafe($_POST['link']) : '';

            # Kiểm tra và validate tên, file và link
            if ($data['title'] == '' || $data['link'] == '') {
                sessionFlash('error', 'Tiêu đề Hoặc Ảnh Đại Diện Không Trống');
                return redirect('admin/slider/edit' . $id);
            }

            $data['sort'] = isset($_POST['sort']) ? intval($_POST['sort']) : 0;
            $data['active'] = isset($_POST['active']) ? intval($_POST['active']) : 0;

            # Nếu người dùng chọn hình ảnh upload thì xử lý hình ảnh
            if ($_FILES['file'] != '') {
                $data['thumb'] = $this->uploadFile($_FILES['file']);

                if ($data['thumb'] == false) {
                    return redirect('admin/slider/edit' . $id);
                }
                #Xóa ảnh thumb Cũ
                deleteFile($slider['thumb']);

            }
            

            #Thêm dữ liệu vào data
            $query = $this->sliderModel->update($data, $id);
            if ($query) {
                sessionFlash('success', 'Cập Nhật Slider thành công');
                return redirect('/admin/slider/lists');
            }

            sessionFlash('error', 'Cập Nhật Slider Lỗi');
            return redirect('/admin/slider/edit' . $id);
        }
        sessionFlash('error', 'Phương thức không đúng');
        return redirect('/admin/slider/lists'); #Chuyển trang
    }

    public function delete()
    {
        #Kiểm tra phương thức có phải là POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id']);

            $slider = $this->sliderModel->show($id);
            if ($slider === false) {
                return json([
                    'error' => true,
                    'messages' => 'Không tồn tại ID'
                ]);
            }

            $linkThumb = $slider['thumb'];
            $delete = $this->sliderModel->delete($id);
            if ($delete) {
                deleteFile($linkThumb);
                return json([
                    'error' => false,
                    'messages' => 'Xóa thành công'
                ]);
            }
            return json([
                'error' => true,
                'messages' => 'Xóa lỗi'
            ]);
        }
        return json([
            'error' => true,
            'messages' => 'Method Error'
        ]);
    }
}