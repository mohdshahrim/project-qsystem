<?php

namespace App\Controllers;
use App\Models\UserModel;

class Claimmaker extends BaseController
{
    public function index()
    {
        echo view('claimmaker/header');
        echo view('claimmaker/index');
        echo view('claimmaker/script'); // NOTE: we put script last, because otherwise the Javascript cannot work
        echo view('claimmaker/footer');
    }

}