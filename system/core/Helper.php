<?php

function makeSafe($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function decodeSafe($data)
{
    $data = htmlspecialchars_decode($data);
    $data = stripslashes($data);
    return $data;
}

function sessionFlash($key = '', $value = '')
{
    $_SESSION[$key] = $value;
}

function sessionFlashDelete($key = '') 
{
    unset($_SESSION[$key]);
}

function redirect($url = '')
{
    header('location: ' . $url);
}

function dd($data = []) 
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function json($data=[]) 
{
    header('Content-type: application/json');
    echo json_encode($data);
}

function deleteFile($path = '')
{

    // $pathNew = '.' . $path;
    $pathNew = __DIR__.'/../..' . $path;

    # Nếu $path không trống và tồn tại file
    if ($path != '' && file_exists($pathNew)) {
        return unlink($pathNew);
    }

    return false;
}

function toSlug($str) {
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}