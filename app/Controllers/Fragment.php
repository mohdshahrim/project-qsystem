<?php

namespace App\Controllers;

use CodeIgniter\Database\RawSql;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Fragment\PCModel;
use App\Models\Fragment\PCImageModel;
use App\Models\Fragment\StaffModel;
use App\Models\Fragment\PrinterModel;
use App\Models\Fragment\SiteModel;
use App\Models\Fragment\MonitorModel;
use App\Models\Fragment\DepartmentModel;
use App\Models\Fragment\DesignationModel;

class Fragment extends BaseController
{
    public function index()
    {
        $header = ['navbar'=>"main",];
        return view('fragment/header', $header)
            .view('fragment/index')
            .view('components/footer');
    }


    /* PC */
    public function pagePC()
    {
        $pcModel = new PCModel();

        $data = [
            'pc' => $pcModel->getPC(),
        ];

        $header = ['navbar'=>"pc",];
        return view('fragment/header', $header)
            .view('fragment/pc', $data)
            .view('components/footer');
    }

    public function pagePCRead($id)
    {
        $pcModel = new PCModel();
        $pcimgModel = new PCImageModel();

        $data = [
            'pc' => $pcModel->getPCByID($id),
            'pcimg' => $pcimgModel->where('pc_id', $id)->findAll(),
        ];

        $header = ['navbar'=>"pc",];
        return view('fragment/header', $header)
            .view('fragment/pc-read', $data)
            .view('components/footer');
    }

    public function pagePCNew()
    {
        $siteModel = new SiteModel();

        $data = [
            'sites' => $siteModel->limit(-1,1)->findAll(),
        ];

        $header = ['navbar'=>"pc",];
        return view('fragment/header', $header)
            .view('fragment/pc-new', $data)
            .view('components/footer');
    }

    public function apiPCGetBySite($site_id)
    {
        $pcModel = new PCModel();

        $data = [
            'pc' => $pcModel->getPCBySite($site_id),
        ];

        return $this->response->setJSON($data);
    }

    public function apiPCCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'hostname' => 'required',
            'asset_no' => 'required',
        ]))
        {
            $pcModel = new PCModel();
            
            $data = [
                'hostname' => $this->request->getPost('hostname'),
                'asset_no' => $this->request->getPost('asset_no'),
                'serial_no' => $this->request->getPost('serial_no'),
                'model' => $this->request->getPost('model'),
                'os' => $this->request->getPost('os'),
                'ip_address' => $this->request->getPost('ip_address'),
                'computer_type' => $this->request->getPost('computer_type'),
                'assigned_user' => $this->request->getPost('assigned_user'),
                'site' => $this->request->getPost('site'),
                'physical_location' => $this->request->getPost('physical_location'),
                'notes' => $this->request->getPost('notes'),
            ];

            if ($pcModel->insert($data)) {
                $message = [
                    'title' => "OK",
                    'message' => "New PC created successfully",
                    'link' => "/fragment/pc",
                ];

                // get pc id
                $pc_id = $pcModel->getInsertID();

                // create flashdata for success message
                $session = session();
                $session->setFlashdata(['message'=>$message['message'], 'newpc'=>$pc_id]);

                // check if monitor is also submitted
                $monitor_id = $this->request->getPost('monitor_id');
                if ($monitor_id!='') {
                    $monitorModel = new MonitorModel();
                    $monitorModel->update($monitor_id, ['host'=>$pc_id]);
                }
            } else {
                $message = [
                    'title' => "Error",
                    'message' => "Failed to create new PC",
                    'link' => "/fragment/pc",
                ];
            }

            return $this->response->setJSON($message);
        }
    }

    public function apiPCRead($id)
    {
        //
        $pcModel = new PCModel();

        $data = [
            'pc' => $pcModel->find($id),
        ];

        return $this->response->setJSON($data);
    }

    public function postPCUpdate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $pcModel = new PCModel();
            $id = $this->request->getPost('id');

            $data = [
                'hostname' => $this->request->getPost('hostname'),
                'asset_no' => $this->request->getPost('asset_no'),
                'serial_no' => $this->request->getPost('serial_no'),
                'model' => $this->request->getPost('model'),
                'os' => $this->request->getPost('os'),
                'ip_address' => $this->request->getPost('ip_address'),
                'physical_location' => $this->request->getPost('physical_location'),
                'computer_type' => $this->request->getPost('computer_type'),
                'notes' => $this->request->getPost('notes'),
            ];

            $session = session();
            if (!$pcModel->update($id, $data)) {
                $session->setFlashdata('message', "Error: failed to update PC");
            } else {
                $session->setFlashdata('message', "Success: PC updated");
            }

            return redirect()->to('/fragment/pc/'.$id);
        }
    }

    public function getPCDelete($id)
    {
        $pcModel = new PCModel();

        if (!$pcModel->delete($id, true)) {
            $message = [
                'title' => "Error!",
                'message' => "Failed to delete pc",
                'link' => "/fragment/pc/".$id,
            ];
        } else {
            $message = [
                'title' => "Success!",
                'message' => "PC deleted successfully",
                'link' => "/fragment/pc",
            ];
        }

        $header = ['navbar'=>"pc",];
        return view('fragment/header', $header)
            .view('components/message', $message)
            .view('components/footer');
    }

    public function postPCImgCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $id = $this->request->getPost('id');

            $pcimgModel = new PCImageModel();
            $randomstr = uniqid();

            if ($this->request->getFile('file')->move(ROOTPATH.'\\public\\uploads\\fragment_pcimg', $id.'-'.$randomstr.'.png')) {
                $data = [
                    'pc_id' => $id,
                    'file_path' => $id.'-'.$randomstr.'.png',
                ];
                $pcimgModel->insert($data);
            }

            return;
        }
    }

    public function postPCImgDelete()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'imgid' => 'required',
        ]))
        {
            $imgid = $this->request->getPost('imgid');

            $pcimgModel = new PCImageModel();

            $img = $pcimgModel->find($imgid);

            // delete the file
            if (unlink('../public/uploads/fragment_pcimg/'.$img['file_path'])) {
                $pcimgModel->delete($imgid);
            }

            return;
        }
    }

    public function pagePCChangeSite($id)
    {
        // skip verify ID
        $siteModel = new SiteModel();
        $pcModel = new PCModel();

        $data = [
            'pc' => $pcModel->getPCByID($id),
            'sites' => $siteModel->limit(-1,1)->findAll(),
        ];

        $header = ['navbar'=>"pc",];
        return view('fragment/header', $header)
            .view('fragment/pc-changesite', $data)
            .view('components/footer');
    }

    public function postPCChangeSiteSubmit()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
            'site' => 'required',
        ]))
        {
            $pc_id = $this->request->getPost('id');

            $pcModel = new PCModel();
            $pc = $pcModel->find($pc_id);

            $site_id = $this->request->getPost('site');

            if ($pc['site']!=$site_id) {
                if ($pcModel->update($pc_id, ['site'=>$site_id])) {
                    
                    // unhost its monitor
                    $monitorModel = new MonitorModel();
                    $monitors = $monitorModel->where('host', $pc_id)->findAll();

                    if ($monitors) {
                        foreach($monitors as $monitor) {
                            $monitorModel->update($monitor['id'], ['host'=>'']);
                        }
                    }
                }
            }

            return redirect()->to('/fragment/pc/'.$pc_id);
        }   
    }

    public function pagePCChangeUser($id)
    {
        $userModel = new StaffModel(); // NOTE: don't be confused with interchangeable term for user and staff
        $pcModel = new PCModel();

        $data = [
            'pc' => $pcModel->getPCByID($id),
            'users' => $userModel->limit(-1,1)->findAll(),
        ];

        $header = ['navbar'=>"pc",];
        return view('fragment/header', $header)
            .view('fragment/pc-changeuser', $data)
            .view('components/footer');
    }

    public function postPCChangeUserSubmit()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
            'user' => 'required',
        ]))
        {
            $pc_id = $this->request->getPost('id');

            $pcModel = new PCModel();
            $pc = $pcModel->find($pc_id);

            $user_id = $this->request->getPost('user');

            if ($pc['assigned_user']!=$user_id) {
                if ($pcModel->update($pc_id, ['assigned_user'=>$user_id])) {
                    
                    // create flashdata for success message
                    $session = session();
                    $session->setFlashdata(['message'=>"PC user reassigned successfully"]);
                }
            }

            return redirect()->to('/fragment/pc/'.$pc_id);
        }  
    }


    /* SITE */
    public function pageSite()
    {
        $siteModel = new SiteModel();
        $sites = $siteModel->limit(-1,1)->findAll(); // unlimited rows, but offset (skip) the first row
        
        $data = [
            'sites' => $sites,
        ];

        $header = ['navbar'=>"site",];
        return view('fragment/header', $header)
            .view('fragment/site', $data)
            .view('components/footer');
    }

    public function pageSiteNew()
    {
        $siteModel = new SiteModel();
        $staffModel = new StaffModel();

        $data = [
            'staffs' => $staffModel->limit(-1, 1)->findAll(),
        ];

        $header = ['navbar'=>"site",];
        return view('fragment/header', $header)
            .view('fragment/site-new', $data)
            .view('components/footer');
    }

    public function postSiteCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'site_id' => 'required',
        ]))
        {
            $siteModel = new SiteModel();

            // SKIP: skip checking for site_id duplicates

            $data = [
                'site_id' => $this->request->getPost('site_id'),
                'site_name' => $this->request->getPost('site_name'),
                'site_type' => $this->request->getPost('site_type'),
                'address' => $this->request->getPost('address'),
                'city' => $this->request->getPost('city'),
                'oic' => $this->request->getPost('oic'), // SKIP: just put oic as 1
            ];

            $siteModel->insert($data);
            $id = $siteModel->getInsertID();

            $message = [
                'title' => "Success!",
                'message' => "New site created successfully",
                'link' => "/fragment/site/".$id,
            ];

            $header = ['navbar'=>"site",];
            return view('fragment/header', $header)
                .view('components/message', $message)
                .view('components/footer');
        }
    }

    public function pageSiteRead($id)
    {
        $siteModel = new SiteModel();
        $staffModel = new StaffModel();
        
        $site = $siteModel->find($id);

        $data = [
            'site' => $site,
            'sitetype' => $siteModel::SITETYPE,
            'city' => $siteModel::CITY,
            'oic_fullname' => $staffModel->where('id', $site['oic'])->first()['fullname'],
        ];

        $header = ['navbar'=>"site",];
        return view('fragment/header', $header)
            .view('fragment/site-read', $data)
            .view('components/footer');
    }

    public function pageSiteEdit($id)
    {
        $siteModel = new SiteModel();
        $staffModel = new StaffModel();
        $site = $siteModel->find($id);

        $data = [
            'site' => $site,
            'sitetype' => $siteModel::SITETYPE,
            'city' => $siteModel::CITY,
            'staffs' => $staffModel->limit(-1, 1)->findAll(),
        ];

        $header = ['navbar'=>"site",];
        return view('fragment/header', $header)
            .view('fragment/site-edit', $data)
            .view('components/footer');
    }

    public function postSiteUpdate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
            'site_id' => 'required',
        ]))
        {
            $siteModel = new SiteModel();
            $id = $this->request->getPost('id');

            // SKIP: skip checking for site_id duplicates

            $data = [
                'site_id' => $this->request->getPost('site_id'),
                'site_name' => $this->request->getPost('site_name'),
                'site_type' => $this->request->getPost('site_type'),
                'address' => $this->request->getPost('address'),
                'city' => $this->request->getPost('city'),
                'oic' => $this->request->getPost('oic'), // SKIP: just put oic as 1
            ];

            $header = ['navbar'=>"site",];

            if (!$siteModel->update($id, $data)) {
                $message = [
                    'title' => "Error",
                    'message' => "Site update has failed. Check the logs.",
                    'link' => "/fragment/site/".$id,
                ];
            } else {
                $message = [
                    'title' => "Success!",
                    'message' => "Site updated successfully",
                    'link' => "/fragment/site/".$id,
                ];
            }

            return view('fragment/header', $header)
                .view('components/message', $message)
                .view('components/footer');
        }
    }

    public function postSiteDelete()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $siteModel = new SiteModel();
            $id = $this->request->getPost("id");

            $header = ['navbar'=>"site",];

            if (!$siteModel->delete($id)) {
                $message = [
                    'title' => "Error!",
                    'message' => "Failed to delete site",
                    'link' => "/fragment/site/".$id,
                ];
            } else {
                $message = [
                    'title' => "Success!",
                    'message' => "Site deleted successfully",
                    'link' => "/fragment/site",
                ];
            }

            return view('fragment/header', $header)
                .view('components/message', $message)
                .view('components/footer');
        }
    }

    public function apiSiteGet()
    {
        $siteModel = new SiteModel();

        $data = [
            'sites' => $siteModel->limit(-1, 1)->findAll(),
        ];

        return $this->response->setJSON($data);
    }


    /* STAFF */
    public function pageStaff()
    {
        //$db = \Config\Database::connect();

        //$staffModel = new StaffModel();
        $siteModel = new SiteModel();

        $staffs = $this->getStaffs();
        $sites = $siteModel->limit(-1, 1)->findAll();
        
        $data = [
            'staffs' => $staffs,
            'sites' => $sites,
        ];

        $header = ['navbar'=>"staff",];
        return view('fragment/header', $header)
            .view('fragment/staff', $data)
            .view('components/footer');
    }

    public function pageStaffNew()
    {
        $departmentModel = new DepartmentModel();
        $designationModel = new DesignationModel();
        $siteModel = new SiteModel();

        $data = [
            'designations' => $designationModel->findAll(),
            'departments' => $departmentModel->findAll(),
            'sites' => $siteModel->findAll(),
        ];

        $header = ['navbar'=>"staff",];
        return view('fragment/header', $header)
            .view('fragment/staff-new', $data)
            .view('components/footer');
    }

    public function postStaffCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'fullname' => 'required',
        ]))
        {
            $staffModel = new StaffModel();
            
            $data = [
                'staff_id' => $this->request->getPost('staff_id'),
                'fullname' => $this->request->getPost('fullname'),
                'telno' => $this->request->getPost('telno'),
                'email' => $this->request->getPost('email'),
                'birthdate' => $this->request->getPost('birthdate'),
                'designation' => $this->request->getPost('designation'),
                'department' => $this->request->getPost('department'),
                'site' => $this->request->getPost('site'),
            ];

            if ($staffModel->insert($data)) {
                return redirect()->to('/fragment/staff');
            } else {
                $message = [
                    'title' => "Error",
                    'message' => "Failed to create new staff",
                    'link' => "/fragment/staff",
                ];

                $header = ['navbar'=>"staff",];
                return view('fragment/header', $header)
                    .view('components/message', $message)
                    .view('components/footer');
            }
        }
    }

    public function pageStaffRead($id)
    {
        $staffModel = new StaffModel();
        $siteModel = new SiteModel();
        $designationModel = new DesignationModel();
        $departmentModel = new DepartmentModel();

        //$staff = $staffModel->find($id);

        $data = [
            'staff' => $this->getStaff($id),
            'city' => $siteModel::CITY,
        ];

        $header = ['navbar'=>"staff",];
        return view('fragment/header', $header)
            .view('fragment/staff-read', $data)
            .view('components/footer');
    }

    public function pageStaffEdit($id)
    {
        $staffModel = new StaffModel();
        $designationModel = new DesignationModel();
        $departmentModel = new DepartmentModel();
        $siteModel = new SiteModel();

        $staff = $staffModel->find($id);

        $data = [
            'staff' => $staff,
            'designations' => $designationModel->findAll(),
            'departments' => $departmentModel->findAll(),
            'sites' => $siteModel->findAll(),
        ];

        $header = ['navbar'=>"staff",];
        return view('fragment/header', $header)
            .view('fragment/staff-edit', $data)
            .view('components/footer');
    }

    public function postStaffUpdate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
            'fullname' => 'required',
        ]))
        {
            $staffModel = new StaffModel();
            $id = $this->request->getPost('id');

            $data = [
                'fullname' => $this->request->getPost('fullname'),
                'staff_id' => $this->request->getPost('staff_id'),
                'telno' => $this->request->getPost('telno'),
                'email' => $this->request->getPost('email'),
                'birthdate' => $this->request->getPost('birthdate'),
                'designation' => $this->request->getPost('designation'),
                'department' => $this->request->getPost('department'),
                'site' => $this->request->getPost('site'),
            ];

            $header = ['navbar'=>"staff",];

            if (!$staffModel->update($id, $data)) {
                $message = [
                    'title' => "Error",
                    'message' => "Staff update has failed. Check the logs.",
                    'link' => "/fragment/staff/".$id,
                ];
            } else {
                $message = [
                    'title' => "Success!",
                    'message' => "Staff updated successfully",
                    'link' => "/fragment/staff/".$id,
                ];
            }

            return view('fragment/header', $header)
                .view('components/message', $message)
                .view('components/footer');
        }
    }

    public function postStaffDelete()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $staffModel = new StaffModel();
            $id = $this->request->getPost("id");

            $header = ['navbar'=>"staff",];

            if (!$staffModel->delete($id, true)) {
                $message = [
                    'title' => "Error!",
                    'message' => "Failed to delete staff",
                    'link' => "/fragment/staff/".$id,
                ];
            } else {
                $message = [
                    'title' => "Success!",
                    'message' => "Staff deleted successfully",
                    'link' => "/fragment/staff",
                ];
            }

            return view('fragment/header', $header)
                .view('components/message', $message)
                .view('components/footer');
        }
    }

    public function apiStaffGetBySite($site_id)
    {
        $staffModel = new StaffModel();

        $data = [
            'staff' => $staffModel->getStaffBySite($site_id),
        ];

        return $this->response->setJSON($data);
    }


    /* DESIGNATION */ 
    public function pageDesignation()
    {
        $designationModel = new DesignationModel();

        $data = [
            'designations' => $designationModel->limit(-1, 1)->findAll(),
        ];

        $header = ['navbar'=>"designation",];
        return view('fragment/header', $header)
            .view('fragment/designation', $data)
            .view('components/footer');
    }

    public function postDesignationCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'designation_name' => 'required',
        ]))
        {
            $designationModel = new DesignationModel();
            
            $data = [
                'designation_name' => $this->request->getPost('designation_name'),
            ];

            if ($designationModel->insert($data)) {
                return redirect()->to('/fragment/designation');
            } else {
                $message = [
                    'title' => "Error",
                    'message' => "Failed to create new designation. Check the error logs.",
                    'link' => "/fragment/designation",
                ];

                $header = ['navbar'=>"designation",];
                return view('fragment/header', $header)
                    .view('components/message', $message)
                    .view('components/footer');
            }
        }
    }

    public function postDesignationUpdate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
            'designation_name' => 'required',
        ]))
        {
            $designationModel = new DesignationModel();
            $id = $this->request->getPost('id');

            $data = [
                'designation_name' => $this->request->getPost('designation_name'),
            ];

            if ($designationModel->update($id, $data)) {
                return redirect()->to('/fragment/designation');
            } else {
                $message = [
                    'title' => "Error",
                    'message' => "Failed to updated designation. Check the error logs.",
                    'link' => "/fragment/designation",
                ];

                $header = ['navbar'=>"designation",];
                return view('fragment/header', $header)
                    .view('components/message', $message)
                    .view('components/footer');
            }
        }
    }

    public function postDesignationDelete()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $designationModel = new DesignationModel();
            $id = $this->request->getPost('id');

            if ($designationModel->delete($id)) {
                return redirect()->to('/fragment/designation');
            } else {
                $message = [
                    'title' => "Error",
                    'message' => "Failed to delete designation. Check the error logs.",
                    'link' => "/fragment/designation",
                ];

                $header = ['navbar'=>"designation",];
                return view('fragment/header', $header)
                    .view('components/message', $message)
                    .view('components/footer');
            }
        }
    }


    /* DEPARTMENT */
    public function pageDepartment()
    {
        $deparmentModel = new DepartmentModel();

        $data = [
            'departments' => $deparmentModel->limit(-1, 1)->findAll(),
        ];

        $header = ['navbar'=>"department",];
        return view('fragment/header', $header)
            .view('fragment/department', $data)
            .view('components/footer');
    }

    public function postDepartmentCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'department_name' => 'required',
        ]))
        {
            $departmentModel = new DepartmentModel();
            
            $data = [
                'department_name' => $this->request->getPost('department_name'),
            ];

            if ($departmentModel->insert($data)) {
                return redirect()->to('/fragment/department');
            } else {
                $message = [
                    'title' => "Error",
                    'message' => "Failed to create new department. Check the error logs.",
                    'link' => "/fragment/department",
                ];

                $header = ['navbar'=>"department",];
                return view('fragment/header', $header)
                    .view('components/message', $message)
                    .view('components/footer');
            }
        }
    }

    public function postDepartmentUpdate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
            'department_name' => 'required',
        ]))
        {
            $departmentModel = new DepartmentModel();
            $id = $this->request->getPost('id');

            $data = [
                'department_name' => $this->request->getPost('department_name'),
            ];

            if ($departmentModel->update($id, $data)) {
                return redirect()->to('/fragment/department');
            } else {
                $message = [
                    'title' => "Error",
                    'message' => "Failed to update department. Check the error logs.",
                    'link' => "/fragment/department",
                ];

                $header = ['navbar'=>"department",];
                return view('fragment/header', $header)
                    .view('components/message', $message)
                    .view('components/footer');
            }
        }
    }

    public function postDepartmentDelete()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $departmentModel = new DepartmentModel();
            $id = $this->request->getPost('id');

            if ($departmentModel->delete($id)) {
                return redirect()->to('/fragment/department');
            } else {
                $message = [
                    'title' => "Error",
                    'message' => "Failed to delete department. Check the error logs.",
                    'link' => "/fragment/department",
                ];

                $header = ['navbar'=>"department",];
                return view('fragment/header', $header)
                    .view('components/message', $message)
                    .view('components/footer');
            }
        }
    }


    /* MONITOR */
    public function pageMonitor()
    {
        $monitorModel = new MonitorModel();
        $builder = $monitorModel->builder();
        $builder->select('
            monitor.id,
            monitor.asset_no,
            monitor.serial_no,
            monitor.model,
            monitor.screen_size,
            monitor.host,
            pc.hostname,
            site.site_id as site_id,
            monitor.notes,
            monitor.created_at,
            monitor.updated_at,
            monitor.deleted_at,
        ')
        ->join('pc','pc.id = monitor.host', 'left')
        ->join('site','site.id = monitor.site', 'left');

        $query = $builder->get(-1,1); // because we don't want to include the 'DEFAULT' or 'index1'

        $data = [
            'monitor' => $query->getResultArray(),
        ];

        $header = ['navbar'=>"monitor",];
        return view('fragment/header', $header)
            .view('fragment/monitor', $data)
            .view('components/footer');
    }

    public function pageMonitorRead($id)
    {
        $monitorModel = new MonitorModel();

        $data = [
            'monitor' => $this->getMonitor($id),
        ];

        $header = ['navbar'=>"monitor",];
        return view('fragment/header', $header)
            .view('fragment/monitor-read', $data)
            .view('components/footer');
    }

    public function pageMonitorNew()
    {
        $pcModel = new PCModel();
        $siteModel = new SiteModel();

        $data = [
            'pc' => $pcModel->findAll(),
            'sites' => $siteModel->limit(-1,1)->findAll(),
        ];

        $header = ['navbar'=>"monitor",];
        return view('fragment/header', $header)
            .view('fragment/monitor-new', $data)
            .view('components/footer');
    }

    public function postMonitorCreate()
    {
        // NOTE: for the time being, "Monitor Create" is handled by apiMonitorCreate()
    }

    public function apiMonitorCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'asset_no' => 'required',
        ]))
        {
            $monitorModel = new MonitorModel();
            
            $data = [
                'site' => $this->request->getPost('site'),
                'asset_no' => $this->request->getPost('asset_no'),
                'serial_no' => $this->request->getPost('serial_no'),
                'model' => $this->request->getPost('model'),
                'screen_size' => $this->request->getPost('screen_size'),
                'notes' => $this->request->getPost('notes'),
                'host' => $this->request->getPost('host'),
            ];

            if ($monitorModel->insert($data)) {
                $message = [
                    'title' => "OK",
                    'message' => "New monitor created",
                    'link' => "/fragment/monitor",
                ];
                return $this->response->setJSON($message);
            } else {
                $message = [
                    'title' => "Error",
                    'message' => "Failed to create new monitor. Check the error logs.",
                    'link' => "/fragment/monitor",
                ];
                 return $this->response->setJSON($message);
            }
        }
    }

    public function apiMonitorGetBySite($site_id)
    {
        $only_unhosted = 'false'; // default
        if (isset($_GET['only_unhosted'])) {
            $only_unhosted = filter_var($this->request->getGet('only_unhosted'), FILTER_VALIDATE_BOOLEAN);
            log_message('error', $only_unhosted);
        }

        $monitorModel = new MonitorModel();
        $builder = $monitorModel->builder();
        $builder->select('
            monitor.id,
            monitor.asset_no,
            monitor.serial_no,
            monitor.model,
            monitor.screen_size,
            monitor.site,
            monitor.host,
            monitor.notes,
            monitor.created_at,
            monitor.updated_at,
            monitor.deleted_at,
            pc.hostname,
            pc.site as pc_site,
            site.site_id,
        ')
        ->join('pc','pc.id = monitor.host', 'left')
        ->join('site','site.id = monitor.site', 'left')
        ->where('monitor.site', $site_id)
        ->when($only_unhosted, static function($builder){
            $builder->groupStart()
            ->where('host', '')
            ->orWhere('host', null)
            ->groupEnd();
        });
        
        //$builder->join('pc','pc.id = monitor.host', 'left');

        $query = $builder->get();

        $data = [
            'monitor' => $query->getResultArray(),
        ];

        return $this->response->setJSON($data);
    }

    public function pageMonitorEdit($id)
    {
        $monitorModel = new MonitorModel();

        $data = [
            'monitor' => $this->getMonitor($id),
        ];

        $header = ['navbar'=>"monitor",];
        return view('fragment/header', $header)
            .view('fragment/monitor-edit', $data)
            .view('components/footer');
    }

    public function pageMonitorChangeSite($id)
    {
        // skip verify ID
        $siteModel = new SiteModel();

        $data = [
            'monitor' => $this->getMonitor($id),
            'sites' => $siteModel->limit(-1,1)->findAll(),
        ];

        $header = ['navbar'=>"monitor",];
        return view('fragment/header', $header)
            .view('fragment/monitor-changesite', $data)
            .view('components/footer');
    }

    public function postMonitorChangeSiteSubmit()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
            'site' => 'required',
        ]))
        {
            $monitor_id = $this->request->getPost('id');

            $monitorModel = new MonitorModel();
            $monitor = $monitorModel->find($monitor_id);

            $site_id = $this->request->getPost('site');

            if ($monitor['site']!=$site_id) {
                // unhost the monitor
                $monitorModel->update($monitor_id, ['site'=>$site_id, 'host'=>null]);
            }

            return redirect()->to('/fragment/monitor/'.$monitor_id);
        }
    }

    public function pageMonitorChangeHost($id)
    {
        // skip verify ID
        $pcModel = new PCModel();        
        $monitor = $this->getMonitor($id);
        $data['monitor'] = $monitor;

        // only suggest PCs from the same site as monitor
        // if the site is none/1, there should be no host to be suggested
        if ($monitor['site']!=1) {
            $data['pcs'] = $pcModel->where('site', $monitor['site'])->findAll();
        } else {
            $data['pcs'] = $pcModel->where('site', 1)->findAll();
        }

        $header = ['navbar'=>"monitor",];
        return view('fragment/header', $header)
            .view('fragment/monitor-changehost', $data)
            .view('components/footer');
    }

    public function postMonitorChangeHostSubmit()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
            'pc' => 'required',
        ]))
        {
            $monitor_id = $this->request->getPost('id');
            $pc_id = $this->request->getPost('pc');

            $monitorModel = new MonitorModel();
            $monitorModel->update($monitor_id, ['host'=>$pc_id]);

            return redirect()->to('/fragment/monitor/'.$monitor_id);
        }
    }

    public function postMonitorUpdate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            // NOTE: skip checking if monitor "id" exist

            $monitorModel = new MonitorModel();
            $id = $this->request->getPost('id');

            $data = [
                'asset_no' => $this->request->getPost('asset_no'),
                'serial_no' => $this->request->getPost('serial_no'),
                'model' => $this->request->getPost('model'),
                'screen_size' => $this->request->getPost('screen_size'),
            ];

            $monitorModel->update($id, $data);

            // NOTE: skip showing message

            return redirect()->to('/fragment/monitor/'.$id);
        }
    }

    public function postMonitorDelete()
    {
        // NOTE: why is this empty?
    }


    /* PRINTER */
    public function pagePrinter()
    {
        $printerModel = new PrinterModel();

        $data = [
            'printer' => $printerModel->getPrinter(),
            'printer_types' => $printerModel::PRINTER_TYPES,
        ];

        $header = ['navbar'=>"printer",];
        return view('fragment/header', $header)
            .view('fragment/printer', $data)
            .view('components/footer');
    }

    public function pagePrinterNew()
    {
        $siteModel = new SiteModel();
        $printerModel = new PrinterModel();

        $data = [
            'sites' => $siteModel->limit(-1,1)->findAll(),
            'types' => $printerModel::PRINTER_TYPES,
        ];

        $header = ['navbar'=>"printer",];
        return view('fragment/header', $header)
            .view('fragment/printer-new', $data)
            .view('components/footer');
    }

    public function apiPrinterCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'serial_no' => 'required',
            'model' => 'required',
        ]))
        {
            $printerModel = new PrinterModel();
            
            $data = [
                'serial_no' => $this->request->getPost('serial_no'),
                'model' => $this->request->getPost('model'),
                'nickname' => $this->request->getPost('nickname'),
                'printer_type' => $this->request->getPost('printer_type'),
                'host' => $this->request->getPost('host'),
                'ip_address' => $this->request->getPost('ip_address'),
                'is_rental' => $this->request->getPost('is_rental'),
                'site' => $this->request->getPost('site'),
                'notes' => $this->request->getPost('notes'),
            ];

            if ($printerModel->insert($data)) {
                $message = [
                    'title' => "OK",
                    'message' => "New printer created successfully",
                    'link' => "/fragment/printer",
                ];

                // get printer id
                $printer_id = $printerModel->getInsertID();

                // create flashdata for success message
                $session = session();
                $session->setFlashdata(['message'=>$message['message'], 'newprinter'=>$printer_id]);
            } else {
                $message = [
                    'title' => "Error",
                    'message' => "Failed to create new printer",
                    'link' => "/fragment/printer",
                ];
            }

            return $this->response->setJSON($message);
        }
    }

    public function apiPrinterGetBySite($site_id)
    {
        $printerModel = new PrinterModel();

        $data = [
            'printer' => $printerModel->getPrinterBySite($site_id),
        ];

        return $this->response->setJSON($data);
    }

    public function pagePrinterRead($id)
    {
        $printerModel = new PrinterModel();

        $data = [
            'printer' => $printerModel->getPrinterByID($id),
            'printer_types' => $printerModel::PRINTER_TYPES,
        ];

        $header = ['navbar'=>"printer",];
        return view('fragment/header', $header)
            .view('fragment/printer-read', $data)
            .view('components/footer');
    }

    public function postPrinterUpdate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $printerModel = new PrinterModel();
            $id = $this->request->getPost('id');

            $data = [
                'model' => $this->request->getPost('model'),
                'serial_no' => $this->request->getPost('serial_no'),
                'nickname' => $this->request->getPost('nickname'),
                'printer_type' => $this->request->getPost('printer_type'),
                'ip_address' => $this->request->getPost('ip_address'),
                'is_rental' => $this->request->getPost('is_rental'),
                'notes' => $this->request->getPost('notes'),
            ];

            $session = session();

            if (!$printerModel->update($id, $data)) {
                $session->setFlashdata('message', "Error: failed to update Printer");
            } else {
                $session->setFlashdata('message', "Success: Printer updated");
            }

            return redirect()->to('/fragment/printer/'.$id);
        }
    }

    public function getPrinterDelete($id)
    {
        $printerModel = new PrinterModel();

        if (!$printerModel->delete($id, true)) {
            $message = [
                'title' => "Error!",
                'message' => "Failed to delete Printer",
                'link' => "/fragment/printer/".$id,
            ];
        } else {
            $message = [
                'title' => "Success!",
                'message' => "Printer deleted successfully",
                'link' => "/fragment/printer",
            ];
        }

        $header = ['navbar'=>"printer",];
        return view('fragment/header', $header)
            .view('components/message', $message)
            .view('components/footer');
    }

    public function pagePrinterChangeHost($id)
    {
        $printerModel = new PrinterModel();
        $pcModel = new PCModel();

        $data = [
            'printer' => $printerModel->getPrinterByID($id),
            'hosts' => $pcModel->limit(-1,1)->findAll(),
        ];

        $header = ['navbar'=>"printer",];
        return view('fragment/header', $header)
            .view('fragment/printer-changehost', $data)
            .view('components/footer');
    }

    public function postPrinterChangeHostSubmit()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
            'pc' => 'required',
        ]))
        {
            $printer_id = $this->request->getPost('id');
            $pc_id = $this->request->getPost('pc');

            $printerModel = new PrinterModel();
            $printerModel->update($printer_id, ['host'=>$pc_id]);

            return redirect()->to('/fragment/printer/'.$printer_id);
        }
    }


    /* UTILITY FUNTIONS */
    private function getStaff($id)
    {
        $staffModel = new StaffModel();
        $staff = $staffModel
            ->select('staff.id, staff.staff_id, staff.fullname, staff.telno, staff.email, staff.birthdate, staff.age, staff.designation, staff.department, staff.site, site.site_id, site.site_name, designation.id as designationid, designation.designation_name, department.id as departmentid, department.department_name, staff.created_at, staff.updated_at, staff.deleted_at,')
            ->join('site','site.id = staff.site', 'left')
            ->join('department','department.id = staff.department', 'left')
            ->join('designation','designation.id = staff.designation', 'left')
            ->where('staff.id', $id)
            ->find()[0];
        return $staff;
    }

    private function getStaffs()
    {
        $staffModel = new StaffModel();
        $staffs = $staffModel
            ->select('staff.id, staff.staff_id, staff.fullname, staff.telno, staff.email, staff.birthdate, staff.age, staff.designation, staff.department, staff.site, site.site_id, site.site_name, designation.id  as designationid, designation.designation_name, department.id as departmentid, department.department_name, staff.created_at, staff.updated_at, staff.deleted_at,')
            ->join('site','site.id = staff.site', 'left')
            ->join('department','department.id = staff.department', 'left')
            ->join('designation','designation.id = staff.designation', 'left')
            ->limit(-1, 1)
            ->findAll();
        return $staffs;
    }

    private function getMonitor($id)
    {
        $monitorModel = new MonitorModel();
        $monitor = $monitorModel
            ->select('monitor.id, monitor.asset_no, monitor.serial_no, monitor.model, monitor.screen_size, monitor.site, monitor.host, monitor.notes, pc.hostname as hostname, site.site_id as site_id, monitor.created_at, monitor.updated_at, monitor.deleted_at,')
            ->join('site','site.id = monitor.site', 'left')
            ->join('pc','pc.id = monitor.host', 'left')
            ->where('monitor.id', $id)
            ->find()[0];
        return $monitor;
    }
}
