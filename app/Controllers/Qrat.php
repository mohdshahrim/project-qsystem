<?php

namespace App\Controllers;
use App\Models\UserModel;

class Qrat extends BaseController
{

    public function index()
    {
        if (!session('username'))
        {
            session()->destroy();
            return redirect()->to('/');
        }
        else
        {
            echo view('header');
            echo view('qrat/index');
            echo view('footer');
        }
    }

}