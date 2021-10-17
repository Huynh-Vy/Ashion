<?php

class Auth extends Controller
{
    public function __construct()
    {
        if (!isset($_COOKIE['user_cookie'])) {
            return redirect('/admin/login');
        }
    }
}
