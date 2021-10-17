<?php

class UserController extends AuthApi
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        dd($this->user);
    }
}