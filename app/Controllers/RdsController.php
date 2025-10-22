<?php

namespace App\Controllers;

define('RDS_VERSION_NO', '0.1');
define('RDS_VERSION_DATE', '19/06/2025');

class RdsController extends BaseController
{
    protected $rds_db = [
        'database'    => WRITEPATH.'database\rds.db',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => '',
        'DBDebug'     => true,
        'swapPre'     => '',
        'failover'    => [],
        'foreignKeys' => false,
        'busyTimeout' => 1000,
        'dateFormat'  => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    public function index()
    {
        return view('rds/s-header')
            .view('rds/index')
            .view('rds/s-footer');
    }

    public function pageSetting()
    {
        //
    }

    // for Mill
    public function pageMill()
    {
        $db = db_connect($this->rds_db);
        $millModel = model('RdsMillModel', true, $db);
        $data = [
            'mills' => $millModel->findAll(),
        ];

        return view('rds/s-header')
            .view('rds/s-mill', $data)
            .view('rds/s-footer');
    }

    public function pageMillNew()
    {
        return view('rds/header')
            .view('rds/mill-new')
            .view('rds/footer');
    }

    public function postMillCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'millno' => 'required',
        ]))
        {
            $db = db_connect($this->rds_db);
            $millModel = model('RdsMillModel', true, $db);

            $millno = $this->request->getPost('millno');
            $millname = $this->request->getPost('millname');
            $email = $this->request->getPost('email');
            $contactperson = $this->request->getPost('contactperson');

            $data = [
                'mill_no' => $millno,
                'mill_name' => $millname,
                'email' => $email,
                'contact_person' => $contactperson,
            ];

            $millModel->insert($data);

            $id = $millModel->getInsertID();

            $returnlink = "/rds/mill/edit/".$id;

            $successPage = [
                'message' => "Mill create success!",
                'returnlink' => $returnlink,
            ];

            return view('rds/header').view('rds/rds-success', $successPage).view('rds/footer');
        }
    }

    public function pageMillEdit($id)
    {
        $db = db_connect($this->rds_db);
        $millModel = model('RdsMillModel', true, $db);

        $result = $millModel->find($id);
        $data = ['mill' => $result];

        return view('rds/header')
            .view('rds/mill-edit', $data)
            .view('rds/footer');        
    }

    public function postMillUpdate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $db = db_connect($this->rds_db);
            $millModel = model('RdsMillModel', true, $db);

            $id = $this->request->getPost('id');

            $data = [
                'id' => $id,
                'mill_no' => $this->request->getPost('millno'),
                'mill_name' => $this->request->getPost('millname'),
                'email' => $this->request->getPost('email'),
                'contact_person' => $this->request->getPost('contactperson'),
            ];

            if ($millModel->update($id, $data))
            {
                // update success
                $successPage = [
                    'message' => "mill update success!",
                    'returnlink' => '/rds/mill',
                ];

                return view('rds/header')
                    .view('rds/rds-success', $successPage)
                    .view('rds/footer');   
            }
        }
    }

    public function postMillDelete()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $db = db_connect($this->rds_db);
            $millModel = model('RdsMillModel', true, $db);

            $id = $this->request->getPost('id');

            if ($millModel->delete($id)) {  
                // update success
                $successPage = [
                    'message' => "Mill delete success!",
                    'returnlink' => "/rds/mill",
                ];

                echo view('rds/header');
                echo view('rds/rds-success', $successPage);
                echo view('rds/footer');
            } else {
                return redirect()->to('/rds/mill/');
            }
        }
    }

    // for Licensee
    public function pageLicensee()
    {
        $db = db_connect($this->rds_db);
        $licenseeModel = model('RdsLicenseeModel', true, $db);
        $data = [
            'licensees' => $licenseeModel->findAll(),
        ];

        return view('rds/header')
            .view('rds/licensee', $data)
            .view('rds/footer');
    }

    public function pageLicenseeNew()
    {
        return view('rds/header')
            .view('rds/licensee-new')
            .view('rds/footer');
    }

    public function postLicenseeCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'license_no' => 'required',
        ]))
        {
            $db = db_connect($this->rds_db);
            $licenseeModel = model('RdsLicenseeModel', true, $db);

            $license_no = $this->request->getPost('license_no');
            $licensee_name = $this->request->getPost('licensee_name');
            $email = $this->request->getPost('email');
            $contactperson = $this->request->getPost('contactperson');

            $data = [
                'license_no' => $license_no,
                'licensee_name' => $licensee_name,
                'email' => $email,
                'contact_person' => $contactperson,
            ];

            $licenseeModel->insert($data);

            $id = $licenseeModel->getInsertID();

            $returnlink = "/rds/licensee/edit/".$id;

            $successPage = [
                'message' => "Licensee create success!",
                'returnlink' => $returnlink,
            ];

            return view('rds/header').view('rds/rds-success', $successPage).view('rds/footer');
        }
    }

    public function pageLicenseeEdit($id)
    {
        $db = db_connect($this->rds_db);
        $licenseeModel = model('RdsLicenseeModel', true, $db);

        $result = $licenseeModel->find($id);
        $data = ['licensee' => $result];

        return view('rds/header')
            .view('rds/licensee-edit', $data)
            .view('rds/footer');        
    }

    public function postLicenseeUpdate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $db = db_connect($this->rds_db);
            $licenseeModel = model('RdsLicenseeModel', true, $db);

            $id = $this->request->getPost('id');

            $data = [
                'id' => $id,
                'licensee_no' => $this->request->getPost('licensee_no'),
                'licensee_name' => $this->request->getPost('licensee_name'),
                'email' => $this->request->getPost('email'),
                'contact_person' => $this->request->getPost('contactperson'),
            ];

            if ($licenseeModel->update($id, $data))
            {
                // update success
                $successPage = [
                    'message' => "licensee update success!",
                    'returnlink' => '/rds/licensee',
                ];

                return view('rds/header')
                    .view('rds/rds-success', $successPage)
                    .view('rds/footer');   
            }
        }
    }

    public function postLicenseeDelete()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $db = db_connect($this->rds_db);
            $licenseeModel = model('RdsLicenseeModel', true, $db);

            $id = $this->request->getPost('id');

            if ($licenseeModel->delete($id)) {  
                // update success
                $successPage = [
                    'message' => "Licensee delete success!",
                    'returnlink' => "/rds/licensee",
                ];

                echo view('rds/header');
                echo view('rds/rds-success', $successPage);
                echo view('rds/footer');
            } else {
                return redirect()->to('/rds/licensee/');
            }
        }
    }

    public function pageMR()
    {
        $db = db_connect($this->rds_db);
        $millModel = model('RdsMillModel', true, $db);
        $data = [
            'mills' => $millModel->findAll(),
        ];


        return view('rds/s-header')
            .view('rds/mr', $data)
            .view('rds/s-footer');
    }

    public function apiMRGet()
    {
        $month = $this->request->getGet('month');
        $year = $this->request->getGet('year');

        $db = db_connect($this->rds_db);
        $builder = $db->table('mill_report');
        $builder->select('mill_report.id, mill.mill_no, mill.mill_name, mill_report.delivery_date, mill_report.status')->where(['mill_report.month' => $month, 'mill_report.year' => $year]);
        $builder->join('mill', 'mill.id = mill_report.mill', 'left');

        $query = $builder->get();

        $data = [
            'mr' => $query->getResultArray(),
        ];

        return $this->response->setJSON($data);
    }

    public function apiMRCreate()
    {
        $mrmill = $this->request->getPost('mrmill');
        $mrdeliverydate = $this->request->getPost('mrdeliverydate');

        $db = db_connect($this->rds_db);
        $mrModel = model('RdsMillReportModel', true, $db);

        // deduce what month is the MR based on delivery date
        $m = new \Moment\Moment($mrdeliverydate); // default is "now" UTC
        $year = (int)$m->format('Y');
        $month = (int)$m->subtractMonths(1)->format('m');

        $insertData = [
            'mill' => $mrmill,
            'month' => $month,
            'year' => $year,
            'delivery_date' => $mrdeliverydate,
            'status' => '',
        ];

        $mrModel->insert($insertData);

        $data = [
            'month' => $month,
            'year' => $year,
        ];

        return $this->response->setJSON($data);
    }

    public function apiMRDelete()
    {
        $mrid = $this->request->getPost('mrid');

        $db = db_connect($this->rds_db);
        $mrModel = model('RdsMillReportModel', true, $db);

        // get month and year of the targetted MR
        $mr = $mrModel->find($mrid);

        $month = $mr['month'];
        $year = $mr['year'];

        $mrModel->delete($mrid);

        $returnData = [
            'month' => $month,
            'year' => $year,
        ];

        return $this->response->setJSON($returnData);
    }

    public function pageMRNew()
    {
        return view('rds/s-header')
            .view('rds/mr-new')
            .view('rds/s-footer');
    }


    // LR
    public function pageLR()
    {
        $db = db_connect($this->rds_db);
        $licenseeModel = model('RdsLicenseeModel', true, $db);
        $data = [
            'licensees' => $licenseeModel->findAll(),
        ];

        return view('rds/header')
            .view('rds/lr', $data)
            .view('rds/footer');
    }

    public function apiLRGet()
    {
        $month = $this->request->getGet('month');
        $year = $this->request->getGet('year');
        
        $db = db_connect($this->rds_db);
        $builder = $db->table('licensee_report');
        $builder->select('licensee_report.id, licensee.license_no, licensee.licensee_name, licensee.email, licensee.contact_person, licensee_report.delivery_date, licensee_report.status')->where(['licensee_report.month' => $month, 'licensee_report.year' => $year]);
        $builder->join('licensee', 'licensee.id = licensee_report.licensee', 'left');

        $query = $builder->get();

        $data = [
            'lr' => $query->getResultArray(),
        ];

        return $this->response->setJSON($data);
    }

    public function postLRCreate()
    {
        $lrLicensee = $this->request->getPost('lrlicensee');
        $lrMonthYear = $this->request->getPost('lrmonthyear');
        $lrDeliveryDate = $this->request->getPost('lrdeliverydate');

        $db = db_connect($this->rds_db);
        $lrModel = model('RdsLicenseeReportModel', true, $db);

        // split monthyear into month and year
        $arrmy = explode("-", $lrMonthYear);
        $lrYear = $arrmy[0];
        $lrMonth = $arrmy[1];

        $insertData = [
            'licensee' => $lrLicensee,
            'month' => $lrMonth,
            'year' => $lrYear,
            'delivery_date' => $lrDeliveryDate,
            'status' => '',
        ];

        $lrModel->insert($insertData);

        $responseData = [
            'message' => '',
        ];

        return $this->response->setJSON($responseData);
    }

    public function postLRDelete()
    {
        //
        $lr = $this->request->getPost('lr');

        $db = db_connect($this->rds_db);
        $lrModel = model('RdsLicenseeReportModel', true, $db);
        $lrModel->delete($lr);

        $responseData = [
            'message' => '',
        ];

        return $this->response->setJSON($responseData);
    }

}