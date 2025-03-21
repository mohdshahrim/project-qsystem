<?php

namespace App\Controllers;
use App\Models\UserModel;

class FragmentController extends BaseController
{
    // in the future, only specific admin role may access Fragment, example:
    // "admin-1" instead of just "admin"
    private $allowedRole = "admin";

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

    public function pagePC()
    {
        if (!session('username'))
        {
            session()->destroy();
        }
        else
        {
            if (session('role')!=$this->allowedRole)
            {
                return redirect()->to('/user/home');
            }
            else
            {
                echo view('fragment/header');
                echo view('fragment/pc');
                echo view('fragment/footer');
            }
        }
    }

}