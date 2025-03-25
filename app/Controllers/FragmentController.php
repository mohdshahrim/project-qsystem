<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\FragmentPCModel;

class FragmentController extends BaseController
{
    // in the future, only specific admin role may access Fragment, example:
    // "admin-1" instead of just "admin"
    private $allowedRole = "admin";

    public function index()
    {
        if (!session('username'))
        {
            session()->destroy();
            return redirect()->to('/');
        }
        else
        {
            if (session('role')!="admin")
            {
                // no permission
                return redirect()->to('/user/home');
            }
            else
            {
                echo view('fragment/header');
                echo view('fragment/index');
                echo view('fragment/footer');
            }
        }
    }

    public function pagePC()
    {
        if (!session('username'))
        {
            session()->destroy();
        }
        else
        {
            if (session('role')!=$this->allowedRole)
            {
                return redirect()->to('/user/home');
            }
            else
            {
                $fragmentPCModel = new FragmentPCModel();
                $result = $fragmentPCModel->findAll();
                $data = ['pc'=>$result];

                echo view('fragment/header');
                echo view('fragment/pc', $data);
                echo view('fragment/footer');
            }
        }
    }

    public function pagePCView($pcid)
    {
        if (!session('username'))
        {
            session()->destroy();
        }
        else
        {
            if (session('role')!="admin")
            {
                return redirect()->to('/user/home');
            }
            else
            {
                $fragmentPCModel = new FragmentPCModel();
                $pc = $fragmentPCModel->find($pcid);
                $data = ['pc'=>$pc];

                echo view('fragment/header');
                echo view('fragment/pc-view', $data);
                echo view('fragment/footer');
            }
        }
    }

    public function pagePCEdit($pcid)
    {
        if (!session('username'))
        {
            session()->destroy();
        }
        else
        {
            if (session('role')!="admin")
            {
                return redirect()->to('/user/home');
            }
            else
            {
                $fragmentPCModel = new FragmentPCModel();
                $pc = $fragmentPCModel->find($pcid);
                $data = ['pc'=>$pc];

                echo view('fragment/header');
                echo view('fragment/pc-edit', $data);
                echo view('fragment/footer');
            }
        }
    }

    public function postPCUpdate()
    {
        if (!session('username'))
        {
            session()->destroy();
        }
        else
        {
            if (session('role')!="admin")
            {
                return redirect()->to('/user/home');
            }
            else
            {
                if ($this->request->getMethod() === 'POST' && $this->validate([
                    'id' => 'required',
                ]))
                {
                    $fragmentPCModel = new FragmentPCModel();
                    $id = $this->request->getPost('id');
                    $returnlink = $this->request->getPost('returnlink');

                    $data = [
                        'id' => $id,
                        'hostname' => $this->request->getPost('hostname'),
                        'ip_address' => $this->request->getPost('ip_address'),
                        'os' => $this->request->getPost('os'),
                        'cpu_model' => $this->request->getPost('cpu_model'),
                        'cpu_no' => $this->request->getPost('cpu_no'),
                        'monitor_no' => $this->request->getPost('monitor_no'),
                        'hosted_devices' => $this->request->getPost('hosted_devices'),
                        'user' => $this->request->getPost('user'),
                        'department' => $this->request->getPost('department'),
                        'notes' => $this->request->getPost('notes'),
                        'office' => $this->request->getPost('office'),
                    ];

                    if ($fragmentPCModel->update($id, $data))
                    {
                        // update success
                        $successPage = [
                            'message' => "PC update success!",
                            'returnlink' => $returnlink,
                        ];

                        echo view('fragment/header');
                        echo view('fragment/fragment-success', $successPage);
                        echo view('fragment/footer');

                    }
                }
            }
        }
    }
}