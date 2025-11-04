<?php

namespace App\Controllers;

class RouterResetController extends BaseController
{
    protected $rr_db = [
        'database'    => WRITEPATH.'database\rr.db',
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
        $db = db_connect($this->rr_db);

        $builder = $db->table('rrlog');
        $builder->select('rrlog.id, rrlog.datetime, rrlog.notes, rraction.action_code');
        $builder->join('rraction', 'rraction.id = rrlog.action', 'left');

        $query = $builder->get();

        $data = [
            'logs' => $query->getResultArray(),
        ];
        
        return view('rr/header')
            .view('rr/index', $data)
            .view('rr/footer');
    }

    public function pageSetting()
    {
        $db = db_connect($this->rr_db);
        $rrActionModel = model('RRActionModel', true, $db);
        $data = [
            'actions' => $rrActionModel->findAll(),
        ];

        return view('rr/header')
            .view('rr/setting', $data)
            .view('rr/footer');
    }

    public function pageActionNew()
    {
        return view('rr/header')
            .view('rr/action-new')
            .view('rr/footer');
    }

    public function postActionCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'action_code' => 'required',
            'description' => 'required',
        ]))
        {
            $db = db_connect($this->rr_db);
            $rrActionModel = model('RRActionModel', true, $db);

            $action_code = $this->request->getPost('action_code');
            $description = $this->request->getPost('description');

            $data = [
                'action_code' => $action_code,
                'description' => $description,
            ];

            $rrActionModel->insert($data);

            return redirect()->to('/rr/setting');
        }
    }

    public function postActionDelete()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'id' => 'required',
        ]))
        {
            $db = db_connect($this->rr_db);
            $rrActionModel = model('RRActionModel', true, $db);

            $id = $this->request->getPost('id');

            $rrActionModel->delete($id);
            return redirect()->to('/rr/setting');
        } 
    }

    public function pageLogNew()
    {
        $db = db_connect($this->rr_db);
        $rrActionModel = model('RRActionModel', true, $db);
        $data = [
            'actions' => $rrActionModel->findAll(),
        ];

        return view('rr/header')
            .view('rr/log-new', $data)
            .view('rr/footer');
    }

    public function postLogCreate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'action' => 'required',
            'datetime' => 'required',
            'notes' => 'required',
        ]))
        {
            $db = db_connect($this->rr_db);
            $rrLogModel = model('RRLogModel', true, $db);

            $action = $this->request->getPost('action');
            $datetime = $this->request->getPost('datetime');
            $notes = $this->request->getPost('notes');

            $data = [
                'action' => $action,
                'datetime' => $datetime,
                'notes' => $notes,
            ];

            $rrLogModel->insert($data);

            return redirect()->to('/rr');
        }
    }
}