<?php

namespace App\Controllers;

class Home extends BaseController
{
    // serve as both landing page and login page
    public function index()
    {
        return view('login');
    }

    // page for apps listing
    public function pageApps()
    {
        return view('header')
            .view('apps')
            .view('components/footer');
    }
}
