<?php

class Controller
{
    public function loadModel($model = '')
    {
        # Kiểm tra tồn tại file Model
        if (file_exists('./app/models/' . $model . '.php')) 
        {
            # Load file model nếu tốn tại
            include './app/models/' . $model . '.php';

            # Khởi tạo class
            $modelName = explode('/' , $model);
            $modelName = end($modelName);
            
            return new $modelName;
        }
        
        throw new Exception('Không tồn tại model');
    }

    public function loadView($master = 'main' , $data = [])
    {
        if (file_exists('./app/views/' . $master . '.php')) {

            # Xóa bỏ mảng đầu tiên
            extract($data);
            include './app/views/' . $master . '.php';
        }
    }
}
