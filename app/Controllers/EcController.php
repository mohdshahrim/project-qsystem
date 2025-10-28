<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

// NOTES
// for short form, we use
// Ec / ec = EleaveChecker

class EcController extends BaseController
{
    public function index()
    {
        return view('/public/ec/header')
            .view('/public/ec/index')
            .view('/public/ec/footer');
    }
}
