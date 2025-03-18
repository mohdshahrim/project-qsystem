<?php

namespace App\Controllers;
use App\Models\UserModel;

class Qrat extends BaseController
{

    public function index()
    {
        if (!session('username'))
        {
            session()->destroy();
            return redirect()->to('/');
        }
        else
        {
            $data = [
                'getheader' => '',
                'getbody' => '',
            ];
            echo view('user/header');
            echo view('qrat/index', $data);
            echo view('user/footer');
        }
    }

    public function postC()
    {
        if (!session('username'))
        {
            session()->destroy();
            return redirect()->to('/');
        }
        else
        {
            if ($this->request->getMethod() === 'POST' && $this->validate([
                'target' => 'required',
                'command' => 'required'
            ]))
            {
                $target = $this->request->getPost('target');
                $command = $this->request->getPost('command');

                $client = service('curlrequest');
                $response = $client->request('GET', 'http://'.$target.':226/c', ['json' => ['command' => $command]]);

                $data = [
                    'getheader' => $response->getHeaderLine('Content-Type'),
                    'getbody' => $response->getBody(),
                ];

                echo view('user/header');
                echo view('qrat/index', $data);
                echo view('user/footer');
            }
        }
    }

}