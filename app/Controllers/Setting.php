<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\AppModel;

class Setting extends BaseController
{
    public function index()
    {
        return view('setting/header')
            .view('setting/index')
            .view('components/footer');
    }
}
