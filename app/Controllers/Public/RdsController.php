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


}