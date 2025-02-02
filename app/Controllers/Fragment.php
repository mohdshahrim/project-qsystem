<?php

namespace App\Controllers;
use App\Models\UserModel;

class Fragment extends BaseController
{
    public function index()
    {
        echo view('fragment/header');
        echo view('fragment/index');
        echo view('fragment/footer ');
    }



}