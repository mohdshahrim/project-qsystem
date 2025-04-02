<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\FragmentPCModel;

define('QSYSTEM_VERSION_NO', '0.1');
define('QSYSTEM_VERSION_DATE', '01/02/2025');

class Home extends BaseController
{
    public function index()
    {
        return view('home/index');
    }

    public function pageLogin()
    {
        $data = [
            'loginmessage' => ''
        ];

        return view('home/login', $data);
    }

    // TESTS
    // reserved for general testing only
    public function testme()
    {
        $pcid = 1;
        $fragmentPCModel = new FragmentPCModel();
        $target = $fragmentPCModel->select('ip_address')->find($pcid)['ip_address'];
        
        echo view('fragment/header');
        //echo $target['ip_address'];
        echo $target;
        echo view('fragment/footer');
    }


    // general test
    public function testgeneral() {
        //return WRITEPATH.'database\core.db';
        $client = service('curlrequest');
        //$response = $client->request('GET', 'http://172.16.17.22:226/c', ['json' => ['command' => 'cmd,/c,dir,C:\quartermaster']]);
        //$response = $client->request('GET', 'http://172.16.17.22:226/c', ['json' => ['command' => 'cmd,/c,copy,\\\\172.16.17.172\\ftp_scan\\q3.exe,C:\\quartermaster\\tehee.exe']]);
        $response = $client->request('GET', 'http://172.16.17.22:226/c', ['json' => ['command' => 'nircmd,changesysvolume,-3000']]);

        echo $response->getHeaderLine('Content-Type');
        echo $response->getBody();
    }

    // just to test reading from db
    public function testdb(): string
    {
        if (file_exists(WRITEPATH.'database/core.db')) {

            $userModel = new \App\Models\Users();
            $user = $userModel->find(1);

            return "core.db yezza ".$user['username'];
        } else {
            return "core.db does not exist";
        }
    }

    public function testforge() {
        $db = \Config\Database::connect('default');
        $db->setDatabase('core2');


        $query = $db->query('SELECT * FROM random WHERE rowid=1');

        foreach ($query->getResult() as $row) {
            echo $row->coffeename;
        }

        $db->close();       
    }

    // just to tell model
    public function testmodel() {
        $userModel = new UserModel();
        $result = $userModel->where('username', 'bane')->find();
        echo $result[0]['username'];
    }

    // hash test
    public function testhash() {
        return password_hash("1234", PASSWORD_DEFAULT);
    }
}
