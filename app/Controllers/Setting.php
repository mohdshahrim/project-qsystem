<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\AppModel;

class Setting extends BaseController
{
    public function index()
    {
        $header = ['navbar'=>"",];

        return view('setting/header', $header)
            .view('setting/index')
            .view('components/footer');
    }

    public function pageWritable()
    {
        $header = ['navbar'=>"writable",];

        return view('setting/header', $header)
            .view('setting/writable')
            .view('components/footer');
    }

    public function postWritableClearLogs()
    {
        helper('filesystem');
        $path = "../writable/logs/";
        $del_dir = TRUE;
        $htdocs = TRUE;
        $header = ['navbar'=>"writable",];
        if (delete_files($path, $del_dir, $htdocs)){
            return redirect()->to('/setting/writable');
        }
    }

    public function postWritableClearSessions()
    {
        helper('filesystem');
        $session = session();
        $session->destroy();
        $path = "../writable/session/";
        $del_dir = TRUE;
        $htdocs = TRUE;
        $header = ['navbar'=>"writable",];
        if (delete_files($path, $del_dir, $htdocs)){
            return redirect()->to('/');
        }
    }

    public function postWritableClearDebug()
    {
        helper('filesystem');
        $path = "../writable/debugbar/";
        $del_dir = TRUE;
        $htdocs = TRUE;
        $header = ['navbar'=>"writable",];
        if (delete_files($path, $del_dir, $htdocs)){
            return redirect()->to('/');
        }
    }
}
