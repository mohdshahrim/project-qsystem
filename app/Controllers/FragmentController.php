<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\FragmentPCModel;
use App\Models\FragmentOfficeModel;
use App\Models\FragmentDeviceModel;

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

    public function pagePCNew()
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
                echo view('fragment/header');
                echo view('fragment/pc-new');
                echo view('fragment/footer');
            }
        }
    }

    public function postPCCreate()
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
                    'cpu_no' => 'required',
                ]))
                {
                    $fragmentPCModel = new FragmentPCModel();

                    $data = [
                        'hostname' => $this->request->getPost('hostname'),
                        'ip_address' => $this->request->getPost('ip_address'),
                        'os' => $this->request->getPost('os'),
                        'cpu_model' => $this->request->getPost('cpu_model'),
                        'cpu_no' => $this->request->getPost('cpu_no'),
                        'monitor_model' => $this->request->getPost('monitor_model'),
                        'monitor_no' => $this->request->getPost('monitor_no'),
                        'hosted_devices' => $this->request->getPost('hosted_devices'),
                        'user' => $this->request->getPost('user'),
                        'department' => $this->request->getPost('department'),
                        'notes' => $this->request->getPost('notes'),
                        'office' => $this->request->getPost('office'),
                    ];

                    // Inserts data and returns inserted row's primary key
                    $fragmentPCModel->insert($data);

                    // Returns inserted row's primary key
                    $id = $fragmentPCModel->getInsertID();

                    // craft return link to pc view page
                    $returnlink = "/fragment/pc/edit/".$id;

                    // update success
                    $successPage = [
                        'message' => "PC create success!",
                        'returnlink' => $returnlink,
                    ];

                    echo view('fragment/header');
                    echo view('fragment/fragment-success', $successPage);
                    echo view('fragment/footer');
                }
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

    // Fragment Office CRUD

    public function pageOffice()
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
                $fragmentOfficeModel = new FragmentOfficeModel();
                $result = $fragmentOfficeModel->findAll();
                $data = ['office' => $result];

                echo view('fragment/header');
                echo view('fragment/office', $data);
                echo view('fragment/footer');
            }
        }
    }

    public function pageOfficeEdit($id)
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
                $fragmentOfficeModel = new FragmentOfficeModel();
                $result = $fragmentOfficeModel->find($id);
                $data = ['office' => $result];

                echo view('fragment/header');
                echo view('fragment/office-edit', $data);
                echo view('fragment/footer');
            }
        }
    }

    public function postOfficeUpdate()
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
                    $fragmentOfficeModel = new FragmentOfficeModel();
                    $id = $this->request->getPost('id');
                    $returnlink = $this->request->getPost('returnlink');

                    $data = [
                        'id' => $id,
                        'office_name' => $this->request->getPost('office_name'),
                        'address' => $this->request->getPost('address'),
                        'manager' => $this->request->getPost('manager'),
                        'total_employee' => $this->request->getPost('total_employee'),
                        'office_type' => $this->request->getPost('office_type'),
                    ];

                    if ($fragmentOfficeModel->update($id, $data))
                    {
                        // update success
                        $successPage = [
                            'message' => "Office update success!",
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


    // Fragment Device CRUD

    public function pageDevice()
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
                $fragmentDeviceModel = new FragmentDeviceModel();
                $result = $fragmentDeviceModel->findAll();
                $data = ['device' => $result];

                echo view('fragment/header');
                echo view('fragment/device', $data);
                echo view('fragment/footer');
            }
        }
    }

    public function pageDeviceNew()
    {
        echo view('fragment/header');
        echo view('fragment/device-new');
        echo view('fragment/footer');
    }

    public function postDeviceCreate()
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
                    'serial_no' => 'required',
                ]))
                {
                    $fragmentDeviceModel = new FragmentDeviceModel();
                    $fragmentPCModel = new FragmentPCModel();

                    $data = [
                        'type' => $this->request->getPost('type'),
                        'serial_no' => $this->request->getPost('serial_no'),
                        'model' => $this->request->getPost('model'),
                        'date_received' => $this->request->getPost('date_received'),
                        'current_location' => $this->request->getPost('current_location'),
                        'status' => $this->request->getPost('status'),
                        'hosted_on' => $this->request->getPost('hosted_on'),
                        'nickname' => $this->request->getPost('nickname'),
                        'notes' => $this->request->getPost('notes'),
                    ];

                    // Inserts data and returns inserted row's primary key
                    $fragmentDeviceModel->insert($data);

                    // Returns inserted row's primary key
                    $id = $fragmentDeviceModel->getInsertID();

                    // craft return link to pc view page
                    $returnlink = "/fragment/device/edit/".$id;

                    // update success
                    $successPage = [
                        'message' => "Device create success!",
                        'returnlink' => $returnlink,
                    ];

                    echo view('fragment/header');
                    echo view('fragment/fragment-success', $successPage);
                    echo view('fragment/footer');
                }    
            }
        }
    }

    public function pageDeviceView($id)
    {

    }

    public function pageDeviceEdit($id)
    {

    }

    public function postDeviceUpdate()
    {

    }

    public function postDeviceDelete()
    {

    }
}