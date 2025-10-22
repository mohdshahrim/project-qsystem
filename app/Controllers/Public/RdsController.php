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


}