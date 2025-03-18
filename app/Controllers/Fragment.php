<?php

namespace App\Controllers;
use App\Models\UserModel;

class Fragment extends BaseController
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
            if (session('role')!="admin")
            {
                // no permission
                return redirect()->to('/user/home');
            }
            else
            {
                echo view('fragment/header');
                echo view('fragment/index');
                echo view('fragment/footer');
            }
        }
    }


}