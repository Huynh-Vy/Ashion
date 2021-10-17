<?php
define ('URL' , 'http://doan.test');

# thông tin máy chủ

$config['servername'] = 'localhost';

# Thông tin username

$config['username'] = 'root';
   
# Thông tin mật khẩu

$config['password'] = '';

# Tên data
$config['database'] = 'php_22_3';

# TimeZone
    
$config['time_zone'] = 'Asia/Ho_Chi_Minh';

# Load Core
    
$config['core'] = ['Auth' , 'Token', 'AuthApi'];

# Load Helper
$config['helpers'] = ['Helper'];

# Limit Row
$config['limit_row'] = 6;

