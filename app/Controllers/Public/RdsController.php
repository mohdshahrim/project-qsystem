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


}