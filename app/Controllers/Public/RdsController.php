<?php namespace App\Controllers\Public;

use App\Controllers\BaseController;

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
        return view('public/rds/header')
            .view('public/rds/index')
            .view('public/rds/footer');
    }

    public function pageLR()
    {
        return view('public/rds/header')
            .view('public/rds/lr')
            .view('public/rds/footer');
    }

    public function pageMR()
    {
        return view('public/rds/header')
            .view('public/rds/mr')
            .view('public/rds/footer');
    }

    public function pageLicensee()
    {
        $db = db_connect($this->rds_db);
        $licenseeModel = model('RdsLicenseeModel', true, $db);
        $data = [
            'licensees' => $licenseeModel->findAll(),
        ];

        return view('public/rds/header')
            .view('public/rds/licensee', $data)
            .view('public/rds/footer');
    }

    public function pageMill()
    {
        $db = db_connect($this->rds_db);
        $licenseeModel = model('RdsMillModel', true, $db);
        $data = [
            'mills' => $licenseeModel->findAll(),
        ];

        return view('public/rds/header')
            .view('public/rds/mill', $data)
            .view('public/rds/footer');
    }

    // $list reference
    // 1 = licensee
    // 2 = mill
    // 3 = LR
    // 4 = MR
    // Example URL (GET) = /rds/print/(:num)
    public function pagePrint($list)
    {
        $db = db_connect($this->rds_db);
        $data['list'] = $list;

        switch ($list) {
            case 1:
                $licenseeModel = model('RdsLicenseeModel', true, $db);
                $data['licensees'] = $licenseeModel->findAll();
                $data['title'] = "Licensees";
                break;
            case 2:
                $millModel = model('RdsMillModel', true, $db);
                $data['mills'] = $millModel->findAll();
                $data['title'] = "Mills";
                break;
            case 3:
                if (isset($_GET['month'])) {
                    $month = $this->request->getGet('month');
                }
                
                if (isset($_GET['year'])) {
                    $year = $this->request->getGet('year');
                }
                
                $builder = $db->table('licensee_report');
                $builder->select('licensee_report.id, licensee.license_no, licensee.licensee_name, licensee.email, licensee.contact_person, licensee_report.delivery_date, licensee_report.status')->where(['licensee_report.month' => $month, 'licensee_report.year' => $year]);
                $builder->join('licensee', 'licensee.id = licensee_report.licensee', 'left');

                $query = $builder->get();

                $d = new \DateTime((string)$year."-".(string)$month);
                $data['title'] = "LR for ".$d->format("F Y");
                $data['lr'] = $query->getResultArray();
                break;
            case 4:
                if (isset($_GET['month'])) {
                    $month = $this->request->getGet('month');
                }
                
                if (isset($_GET['year'])) {
                    $year = $this->request->getGet('year');
                }
                
                $builder = $db->table('mill_report');
                $builder->select('mill_report.id, mill.mill_no, mill.mill_name, mill.email, mill_report.delivery_date, mill_report.status')->where(['mill_report.month' => $month, 'mill_report.year' => $year]);
                $builder->join('mill', 'mill.id = mill_report.mill', 'left');

                $query = $builder->get();

                $d = new \DateTime((string)$year."-".(string)$month);
                $data['title'] = "MR for ".$d->format("F Y");
                $data['mr'] = $query->getResultArray();
                break;
        }
        
        return view('public/rds/print', $data);
    }


}