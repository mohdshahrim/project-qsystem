<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\FragmentSettingPCModel;
use App\Models\FragmentPCModel;
use App\Models\FragmentOfficeModel;
use App\Models\FragmentDeviceModel;
use App\Models\FragmentPictureModel;

define('FRAGMENT_VERSION_NO', '1.0');
define('FRAGMENT_VERSION_DATE', '29/04/2025');

class FragmentController extends BaseController
{
    public function index()
    {
        $pc = new FragmentPCModel();
        $device = new FragmentDeviceModel();

        // shortforms
        // dt = desktop
        // lt = laptop
        // pt = printer

        $data = [
            'dtsbu' => $pc->where(['type'=>'desktop','office'=>'sibu',])->countAllResults(),
            'dtkpt' => $pc->where(['type'=>'desktop','office'=>'kapit',])->countAllResults(),
            'dtsrk' => $pc->where(['type'=>'desktop','office'=>'sarikei',])->countAllResults(),
            'dttgm' => $pc->where(['type'=>'desktop','office'=>'tgmanis',])->countAllResults(),

            'ltsbu' => $pc->where(['type'=>'laptop','office'=>'sibu',])->countAllResults(),
            'ltkpt' => $pc->where(['type'=>'laptop','office'=>'kapit',])->countAllResults(),
            'ltsrk' => $pc->where(['type'=>'laptop','office'=>'sarikei',])->countAllResults(),
            'lttgm' => $pc->where(['type'=>'laptop','office'=>'tgmanis',])->countAllResults(),

            'prsbu' => $device->where(['office'=>'sibu',])->countAllResults(),
            'prkpt' => $device->where(['office'=>'kapit',])->countAllResults(),
            'prsrk' => $device->where(['office'=>'sarikei',])->countAllResults(),
            'prtgm' => $device->where(['office'=>'tgmanis',])->countAllResults(),
        ];

        echo view('fragment/header');
        echo view('fragment/index', $data);
        echo view('fragment/footer');
    }

    // setting and preference
    public function pageSetting()
    {
        // get user id
        $userModel = new UserModel();
        $fragmentSettingPCModel = new FragmentSettingPCModel();

        $user = $userModel->where('username', session('username'))->first();
        //$settingpc = $fragmentSettingPCModel->find($user['id']);
        if ($fragmentSettingPCModel->find($user['id'])) {
            // true
            $settingpc = $fragmentSettingPCModel->find($user['id']);
        } else {
            // initializes
            $this->createFragmentSettingPCUser($user['id']);
            $settingpc = $fragmentSettingPCModel->find($user['id']);
        }

        $data = [
            'settingpc' => $settingpc,
        ];
        echo view('fragment/header');
        echo view('fragment/setting', $data);
        echo view('fragment/footer');
    }

    public function postFragmentSettingPC()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'userid' => 'required',
        ]))
        {
            $fragmentSettingPCModel = new FragmentSettingPCModel();

            $userid = $this->request->getPost('userid');

            $data = [
                'pc_type' => $this->request->getPost('pc_type'),
                'pc_cpumodel' => $this->request->getPost('pc_cpumodel'),
                'pc_monitormodel' => $this->request->getPost('pc_monitormodel'),
                'pc_hosteddevices' => $this->request->getPost('pc_hosteddevices'),
                'pc_user' => $this->request->getPost('pc_user'),
                'pc_department' => $this->request->getPost('pc_department'),
                'pc_notes' => $this->request->getPost('pc_notes'),
                'pc_office' => $this->request->getPost('pc_office'),
            ];

            // update the table
            $fragmentSettingPCModel->update($userid, $data);

            $session = session();
            $session->setFlashdata('fragmentpcsetting', 'setting updated');

            // craft return link to pc view page
            $returnlink = "/fragment/setting";

            return redirect()->to($returnlink);
        }
    }

    public function pagePC()
    {
        $qoffice = ''; // query parameter
        if (isset($_GET['office'])) {
            $qoffice = $this->request->getGet('office');
        }

        $fragmentPCModel = new FragmentPCModel();
        if (strlen($qoffice)==0) {
            $result = $fragmentPCModel->findAll();    
        } else {
            $result = $fragmentPCModel->where('office', $qoffice)->findAll();
        }
        
        // convert hosted device into device name
        foreach($result as $key=>$row)
        {
            //log_message('error', $result[$key]['hosted_devices']);
            if (!empty($result[$key]['hosted_devices'])) {
                $result[$key]['hosted_devices'] = $this->parseDeviceId($result[$key]['hosted_devices']);
            } else {
                $result[$key]['hosted_devices'] = "";
            }
        }

        // get setting
        $userModel = new UserModel();
        $fragmentSettingPCModel = new FragmentSettingPCModel();
        $data = [
            'pc' => $result,
            'settingpc' => $fragmentSettingPCModel->find($userModel->where('username', session('username'))->first()['id']),
        ];

        echo view('fragment/header');
        echo view('fragment/pc', $data);
        echo view('fragment/footer');
    }

    public function pagePCNew()
    {
        $fragmentDeviceModel = new FragmentDeviceModel();

        // get the office
        $office = $this->request->getGet('office');

        $data = [
            'office'=>$office,
            'device'=>$fragmentDeviceModel->where('office',$office)->where('hosted_on', '')->findAll(),
        ];

        echo view('fragment/header');
        echo view('fragment/pc-new', $data);
        echo view('fragment/footer');
    }

    public function postPCCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'cpu_no' => 'required',
        ]))
        {
            $fragmentPCModel = new FragmentPCModel();

            // preprocess $hosted_devices
            $pre_hd = "";
            if (isset($_POST['hosted_devices'])) {
                $pre_hd = implode(" ", $this->request->getPost('hosted_devices[]')); // this format is for storing in FragmentPC
            }

            $data = [
                'hostname' => $this->request->getPost('hostname'),
                'ip_address' => $this->request->getPost('ip_address'),
                'os' => $this->request->getPost('os'),
                'type' => $this->request->getPost('type'),
                'cpu_no' => $this->request->getPost('cpu_no'),
                'cpu_model' => $this->request->getPost('cpu_model'),
                'monitor_no' => $this->request->getPost('monitor_no'),
                'monitor_model' => $this->request->getPost('monitor_model'),
                'hosted_devices' => $pre_hd,
                'user' => $this->request->getPost('user'),
                'department' => $this->request->getPost('department'),
                'notes' => $this->request->getPost('notes'),
                'office' => $this->request->getPost('office'),
            ];

            // Inserts data and returns inserted row's primary key
            $fragmentPCModel->insert($data);

            // Returns inserted row's primary key
            $id = $fragmentPCModel->getInsertID();

            // update Fragment Device table too
            if (strlen($pre_hd)==0) {
                // relinquish all hosted_devices held by this PC
                $this->resetHostedonFragmentDevice($id);
            } else {
                // update Fragment Device table too
                $this->updateFragmentDevice($id, $this->request->getPost('hosted_devices[]'));
            }

            // craft return link to pc view page
            $returnlink = "/fragment/pc/edit/".$id;

            // create success
            $successPage = [
                'message' => "PC create success!",
                'returnlink' => $returnlink,
            ];

            //log_message('error', $data['hosted_devices[]'][0]." ".$data['hosted_devices[]'][2]);

            echo view('fragment/header');
            echo view('fragment/fragment-success', $successPage);
            echo view('fragment/footer');
        }
    }

    public function pagePCView($pcid)
    {
        $fragmentPCModel = new FragmentPCModel();
        $fragmentPictureModel = new FragmentPictureModel();
        $pc = $fragmentPCModel->find($pcid);
        $pics = $fragmentPictureModel->where(['fragment_itemid'=>$pcid,'fragment_type'=>'pc',])->find();

        $data = [
            'pc'=>$pc,
            'pics'=>$pics,
        ];

        echo view('fragment/header');
        echo view('fragment/pc-view', $data);
        echo view('fragment/footer');
    }

    public function pagePCEdit($pcid)
    {
        $fragmentPCModel = new FragmentPCModel();
        $fragmentDeviceModel = new FragmentDeviceModel();
        $fragmentPictureModel = new FragmentPictureModel();

        $pc = $fragmentPCModel->find($pcid);
        $pics = $fragmentPictureModel->where(['fragment_itemid'=>$pcid,'fragment_type'=>'pc',])->find();

        $office = "sibu"; // default

        // if "office" (URL) is empty, get the "office" from DB
        if (empty($this->request->getGet('office'))) {
            // if "office" DB is also empty, assign default value
            if (empty($pc['office'])) {
                $office = "sibu";
            } else {
                $office = $pc['office'];
            }
        } else {
            $office = $this->request->getGet('office');
        }

        $data = [
            'pc' => $pc,
            'pics' => $pics,
            'hosted' => $fragmentDeviceModel->where('hosted_on', $pcid)->findAll(), // for hosted device
            'device' => $fragmentDeviceModel->where('office', $office)->where('hosted_on', '')->findAll(),
        ];

        echo view('fragment/header');
        echo view('fragment/pc-edit', $data);
        echo view('fragment/footer');
    }

    public function postPCUpdate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $fragmentPCModel = new FragmentPCModel();
            $id = $this->request->getPost('id');
            $returnlink = $this->request->getPost('returnlink');

            // preprocess $hosted_devices
            $pre_hd = "";
            if (isset($_POST['hosted_devices'])) {
                $pre_hd = implode(" ", $this->request->getPost('hosted_devices[]')); // this format is for storing in FragmentPC
            }
            
            $data = [
                'hostname' => $this->request->getPost('hostname'),
                'ip_address' => $this->request->getPost('ip_address'),
                'os' => $this->request->getPost('os'),
                'type' => $this->request->getPost('type'),
                'cpu_no' => $this->request->getPost('cpu_no'),
                'cpu_model' => $this->request->getPost('cpu_model'),
                'monitor_no' => $this->request->getPost('monitor_no'),
                'monitor_model' => $this->request->getPost('monitor_model'),
                'hosted_devices' => $pre_hd,
                'user' => $this->request->getPost('user'),
                'department' => $this->request->getPost('department'),
                'notes' => $this->request->getPost('notes'),
                'office' => $this->request->getPost('office'),
            ];

            if ($fragmentPCModel->update($id, $data)) {
                
                if (strlen($pre_hd)==0) {
                    // relinquish all hosted_devices held by this PC
                    $this->resetHostedonFragmentDevice($id);
                } else {
                    // update Fragment Device table too
                    $this->updateFragmentDevice($id, $this->request->getPost('hosted_devices[]'));
                }

                // update success
                $successPage = [
                    'message' => "PC update success!",
                    'returnlink' => $returnlink,
                ];

                echo view('fragment/header');
                echo view('fragment/fragment-success', $successPage);
                echo view('fragment/footer');
            } else {
                return redirect()->to('/fragment/pc/');
            }
        }
    }

    public function postPCDelete()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $fragmentPCModel = new FragmentPCModel();
            $id = $this->request->getPost('id');

            if ($fragmentPCModel->delete($id)) {
                
                $this->resetHostedonFragmentDevice($id);

                // update success
                $successPage = [
                    'message' => "PC delete success!",
                    'returnlink' => "/fragment/pc",
                ];

                echo view('fragment/header');
                echo view('fragment/fragment-success', $successPage);
                echo view('fragment/footer');
            } else {
                return redirect()->to('/fragment/pc/');
            }
        }
    }

    public function postPCPictureCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
            'pcpic' => [
                    'rules' => 'uploaded[pcpic]'
                        . '|is_image[pcpic]'
                        . '|mime_in[pcpic,image/jpg,image/jpeg,image/png,image/gif]'
                        . '|max_size[pcpic,2048]', // 2MB max
                ],
        ]))
        {
            $fragmentPictureModel = new FragmentPictureModel();

            if ($this->request->getFile('pcpic')) {
                $fragment_itemid = $this->request->getPost('id');
                helper('date');
                date_default_timezone_set('Asia/Kuala_Lumpur');

                $data = [
                    'fragment_type' => 'pc',
                    'fragment_itemid' => $fragment_itemid,
                    'file_name' => 'PC'.$fragment_itemid.date('YmdHis', now()).'.jpg',
                    'file_path' => 'uploads\fragment',
                    'uploaded_at' => date('Y-m-d H:i:s'),
                    'uploaded_by' => session('username'),
                ];
                $this->request->getFile('pcpic')->store('fragment/', $data['file_name']);
                $fragmentPictureModel->insert($data);

                return redirect()->to('fragment/pc/edit/'.$fragment_itemid);
            }

            

        }
    }

    public function postPCPictureDelete()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
            'pcid' => 'required',
        ]))
        {
            $fragmentPictureModel = new FragmentPictureModel();

            $id = $this->request->getPost('id');
            $pcid = $this->request->getPost('pcid');
            $file_name = $fragmentPictureModel->select('file_name')->where('id', $id)->first()['file_name'];

            if ($fragmentPictureModel->delete($this->request->getPost('id')) ) {
                // if the deletion is successful, delete the file too
                if (unlink(WRITEPATH.'uploads\fragment\\'.$file_name) ) {
                    return redirect()->to('/fragment/pc/edit/'.$pcid);
                }
            }
        }
    }

    // special case
    // to handle PC transfer from office to office
    public function xPCTransfer($pcid, $newoffice)
    {
        $fragmentPCModel = new FragmentPCModel();
        $fragmentDeviceModel = new FragmentDeviceModel();

        // get current hosted_devices
        $c_hd = $fragmentPCModel->select('hosted_devices')->find($pcid)['hosted_devices'];

        // if hosted_devices is not empty, iterate each of the hosted_devices and clear their "hosted_on"
        if (!empty($c_hd)) {
            $arr = explode($c_hd, ",");
            foreach($arr as $deviceid)
            {
                $fragmentDeviceModel->update($deviceid, ['hosted_on'=>'']);
            }
        }

        // clear all current hosted_devices of the PC, and update office
        $fragmentPCModel->update($pcid, ['hosted_devices'=>'', 'office'=>$newoffice]);

        // redirect back to PC edit page
        return redirect()->to('fragment/pc/edit/'.$pcid.'?office='.$newoffice);
    }

    // Fragment Office CRUD

    public function pageOffice()
    {
        $fragmentOfficeModel = new FragmentOfficeModel();
        $result = $fragmentOfficeModel->findAll();
        $data = ['office' => $result];

        echo view('fragment/header');
        echo view('fragment/office', $data);
        echo view('fragment/footer');
    }

    public function pageOfficeEdit($id)
    {
        $fragmentOfficeModel = new FragmentOfficeModel();
        $result = $fragmentOfficeModel->find($id);
        $data = ['office' => $result];

        echo view('fragment/header');
        echo view('fragment/office-edit', $data);
        echo view('fragment/footer');
    }

    public function postOfficeUpdate()
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
                'shortname' => $this->request->getPost('shortname'),
                'codename' => $this->request->getPost('codename'),
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


    // Fragment Device CRUD

    public function pageDevice()
    {
        $qoffice = ''; // query parameter
        if (isset($_GET['office'])) {
            $qoffice = $this->request->getGet('office');
        }

        $fragmentDeviceModel = new FragmentDeviceModel();
        if (strlen($qoffice)==0) {
            $result = $fragmentDeviceModel->findAll();    
        } else {
            $result = $fragmentDeviceModel->where('office', $qoffice)->findAll();
        }

        $data = ['device' => $result];

        echo view('fragment/header');
        echo view('fragment/device', $data);
        echo view('fragment/footer');
    }

    public function pageDeviceNew()
    {
        echo view('fragment/header');
        echo view('fragment/device-new');
        echo view('fragment/footer');
    }

    public function postDeviceCreate()
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
                'office' => $this->request->getPost('office'),
                'status' => $this->request->getPost('status'),
                'hosted_on' => $this->request->getPost('hosted_on'),
                'codename' => $this->request->getPost('codename'),
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

    public function pageDeviceView($id)
    {
        $fragmentDeviceModel = new FragmentDeviceModel();
        $device = $fragmentDeviceModel->find($id);
        $data = ['device'=>$device];

        echo view('fragment/header');
        echo view('fragment/device-view', $data);
        echo view('fragment/footer');
    }

    public function pageDeviceEdit($id)
    {
        $fragmentDeviceModel = new FragmentDeviceModel();
        $device = $fragmentDeviceModel->find($id);
        $data = ['device'=>$device];

        echo view('fragment/header');
        echo view('fragment/device-edit', $data);
        echo view('fragment/footer');
    }

    public function postDeviceUpdate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $fragmentDeviceModel = new FragmentDeviceModel();
            $id = $this->request->getPost('id');
            $returnlink = $this->request->getPost('returnlink');

            $data = [
                'id' => $id,
                'type' => $this->request->getPost('type'),
                'serial_no' => $this->request->getPost('serial_no'),
                'model' => $this->request->getPost('model'),
                'date_received' => $this->request->getPost('date_received'),
                'current_location' => $this->request->getPost('current_location'),
                'office' => $this->request->getPost('office'),
                'status' => $this->request->getPost('status'),
                'hosted_on' => $this->request->getPost('hosted_on'),
                'codename' => $this->request->getPost('codename'),
                'notes' => $this->request->getPost('notes'),
            ];

            if ($fragmentDeviceModel->update($id, $data))
            {
                // update success
                $successPage = [
                    'message' => "Device update success!",
                    'returnlink' => $returnlink,
                ];

                echo view('fragment/header');
                echo view('fragment/fragment-success', $successPage);
                echo view('fragment/footer');
            }
        }
    }

    public function postDeviceDelete()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $fragmentDeviceModel = new FragmentDeviceModel();
            //$fragmentPCModel = new FragmentPCModel();
            $id = $this->request->getPost('id');

            // remove this device from its pc.hosted_device
            // if is was hosted
            // how do we know if it was hosted?
            // by checking its device.hosted_on
            $device = $fragmentDeviceModel->find($id);
            // if hosted_on is not null

            $this->removeHostedDeviceFromPC($device['hosted_on'], $device['id']);


            if ($fragmentDeviceModel->delete($id)) {
                // update success
                $successPage = [
                    'message' => "Device delete success!",
                    'returnlink' => "/fragment/device",
                ];

                echo view('fragment/header');
                echo view('fragment/fragment-success', $successPage);
                echo view('fragment/footer');
            } else {
                return redirect()->to('/fragment/device/');
            }
        }
    }

    // handling image upload
    //
    //



    // parse device id
    private function parseDeviceId($deviceID)
    {
        $deviceNames = "";

        if (empty($deviceID)) {
            return "";
        } else {
            // check if deviceId is comprise only of single ID (because usually)
            if (strlen($deviceID)==1) {
                return $this->getDeviceNames($deviceID);
            }
            else {
                $arr = explode(" ", $deviceID);
                foreach($arr as $id)
                {
                    $deviceNames .= $this->getDeviceNames($id);
                }
        
                return $deviceNames;
            }
        }
    }

    // return device model and serial no
    private function getDeviceNames($id)
    {
        $fragmentDeviceModel = new FragmentDeviceModel();
        $device = $fragmentDeviceModel->find($id);

        $model = $device['model'];
        $serialNo = $device['serial_no'];
        $codename = $device['codename'];

        return "{$model} ({$serialNo}), ";
    }

    // update Fragment Device table too
    // suitable for PC create and update
    // $deviceID is array
    private function updateFragmentDevice($pcID, $deviceID)
    {
        // reset hosted_on for devices of the $pcID
        $this->resetHostedonFragmentDevice($pcID);

        $fragmentDeviceModel = new FragmentDeviceModel();
        foreach($deviceID as $id) {
            $fragmentDeviceModel->update($id, ['hosted_on'=>$pcID]);
        }
    }

    // to be used with updateFragmentDevice
    // resetting all hosted_on
    private function resetHostedonFragmentDevice($pcID)
    {
        $fragmentDeviceModel = new FragmentDeviceModel();
        $fragmentDeviceModel->set(['hosted_on' => ''])->where('hosted_on', $pcID)->update();
    }

    // remove a single device from PC
    private function removeHostedDeviceFromPC($pcid, $deviceid)
    {
        $fragmentPCModel = new FragmentPCModel();
        $pc = $fragmentPCModel->find($pcid);
        if (!empty($pc['hosted_devices'])) {
            $arr = explode(" ", $pc['hosted_devices']);
            $key = array_search($deviceid, $arr);

            if ($key !== false) {
                unset($arr[$key]);
            }

            $newstr = implode(' ', $arr);

            $data = [
                "hosted_devices" => $newstr,
            ];

            // update
            $fragmentPCModel->update($pcid, $data);
        }
    }

    // create a new fragment setting PC for the User if not already
    private function createFragmentSettingPCUser($userid)
    {
        //
        $fragmentSettingPCModel = new FragmentSettingPCModel();
        $data = [
            'userid' => $userid,
        ];
        
        // Inserts data and returns inserted row's primary key
        $fragmentSettingPCModel->insert($data);
    }

    // about page
    public function pageAbout()
    {
        echo view('fragment/header');
        echo view('fragment/about');
        echo view('fragment/footer');
    }
}