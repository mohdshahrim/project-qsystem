<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

// "dm" is shortform for "DatabaseManagement"

class DatabaseManagement extends BaseController
{
    public function index()
    {
        return view('dm/header')
            .view('dm/index')
            .view('dm/footer');
    }
}
