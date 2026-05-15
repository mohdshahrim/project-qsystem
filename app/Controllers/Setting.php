<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\AppModel;

class Setting extends BaseController
{
    public function index()
    {
        $header = ['navbar'=>"main",];

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

    /* DATABASE */
    public function pageDatabase()
    {
        $header = ['navbar'=>"database",];
        $data = [];

        // check if databases exist
        if (is_file("../writable/database/core.db")) {
            // check if fragment.db exist
            if (is_file("../writable/database/fragment.db")) {
                $data['database'] = 'exist';
            }
        } else {
            $data['database'] = '';
        }

        // check if backup exist
        if (is_file("../writable/database/core.db.backup")) {
            // check if fragment.db exist
            if (is_file("../writable/database/fragment.db.backup")) {
                $data['backup'] = 'exist';
            }
        } else {
            $data['backup'] = '';
        }

        return view('setting/header', $header)
            .view('setting/database', $data)
            .view('components/footer');
    }

    public function postDatabaseBackup()
    {
        copy('../writable/database/core.db', '../writable/database/core.db.backup');
        copy('../writable/database/fragment.db', '../writable/database/fragment.db.backup');

        $session = session();
        $session->setFlashdata(['message'=>'Database backup successfully']);
    }

    public function postDatabaseRestore()
    {
        copy('../writable/database/core.db.backup', '../writable/database/core.db');
        copy('../writable/database/fragment.db.backup', '../writable/database/fragment.db');

        $session = session();
        $session->setFlashdata(['message'=>'Database restored successfully']);
    }

    public function postDatabaseDeleteBackup()
    {
        unlink('../writable/database/core.db.backup');
        unlink('../writable/database/fragment.db.backup');

        $session = session();
        $session->setFlashdata(['message'=>'Backup deleted successfully']);
    }
}
