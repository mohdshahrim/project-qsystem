<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Pulseman\IPModel;
use App\Models\Pulseman\StatusCodeModel;

class Pulseman extends BaseController
{
    public function index()
    {
        $header = ['navbar'=>"main",];
        return view('pulseman/header', $header)
            .view('pulseman/index')
            .view('components/footer');
    }

    public function pageIP()
    {
        $ipModel = new IPModel();

        $data = [
            'ips' => $ipModel->getAllIP(),
        ];

        $header = ['navbar'=>"ip",];
        return view('pulseman/header', $header)
            .view('pulseman/ip', $data)
            .view('components/footer');
    }

    public function pageIPNew()
    {
        $ipModel = new IPModel();

        $data = [
            'ips' => $ipModel->getAllIP(),
        ];

        $header = ['navbar'=>"ip",];
        return view('pulseman/header', $header)
            .view('pulseman/ip-new', $data)
            .view('components/footer');
    }

    public function postIPCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'label' => 'required',
            'ip_address' => 'required',
        ]))
        {
            $ipModel = new IPModel();

            $data = [
                'label' => $this->request->getPost('label'),
                'ip_address' => $this->request->getPost('ip_address'),
                'description' => $this->request->getPost('description'),
                'status' => 0,
            ];

            $ipModel->insert($data);

            return redirect()->to('/pulseman/ip');
        }
    }

    public function pageIPRead($id)
    {
        $ipModel = new IPModel();

        $data = [
            'ip' => $ipModel->find($id),
        ];

        $header = ['navbar'=>"ip",];
        return view('pulseman/header', $header)
            .view('pulseman/ip-read', $data)
            .view('components/footer');
    }

    public function postIPUpdate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
            'label' => 'required',
            'ip_address' => 'required',
        ]))
        {
            $ipModel = new IPModel();
            $id = $this->request->getPost('id');

            $data = [
                'label' => $this->request->getPost('label'),
                'ip_address' => $this->request->getPost('ip_address'),
                'description' => $this->request->getPost('description'),
            ];

            $header = ['navbar'=>"ip",];

            if ($ipModel->update($id, $data)) {
                $session = session();
                $session->setFlashdata(['message'=>"IP information updated successfully"]);
            }

            return redirect()->to('/pulseman/ip/'.$id);
        }
    }

    public function getIPDelete($id)
    {
        $ipModel = new IPModel();

        if ($ipModel->delete($id, true)) {
            $session = session();
            $session->setFlashdata(['message'=>"IP deleted successfully"]);
        }

        $header = ['navbar'=>"ip",];

        return redirect()->to('/pulseman/ip');
    }

    public function pageStatusCode()
    {
        $statuscodeModel = new StatusCodeModel();

        $data = [
            'statuscodes' => $statuscodeModel::CODES,
        ];

        $header = ['navbar'=>"statuscode",];
        return view('pulseman/header', $header)
            .view('pulseman/statuscode', $data)
            .view('components/footer');
    }
}