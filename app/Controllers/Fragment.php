<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Fragment\PCModel;
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

    public function pagePC()
    {
        $pcModel = new PCModel();
        $builder = $pcModel->builder();
        $builder->select('
            pc.id,
            pc.hostname,
            pc.asset_no,
            pc.serial_no,
            pc.model,
            pc.os,
            pc.ip_address,
            pc.computer_type,
            pc.assigned_user,
            pc.physical_location,
            pc.notes,
            pc.created_at,
            pc.updated_at,
            pc.deleted_at,
        ');

        $query = $builder->get();

        $data = [
            'pc' => $query->getResultArray(),
        ];

        $header = ['navbar'=>"pc",];
        return view('fragment/header', $header)
            .view('fragment/pc', $data)
            .view('components/footer');
    }

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

            if (!$staffModel->delete($id)) {
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
}
