<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;


class DatabaseManagement extends BaseController
{
    public function index()
    {
        return view('database-management/header')
            .view('database-management/index')
            .view('components/footer');
    }
}
