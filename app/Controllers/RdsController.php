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
        return view('rds/header')
            .view('rds/index')
            .view('rds/footer');
    }

    public function pageMill()
    {
        $db = db_connect($this->rds_db);
        $millModel = model('RdsMillModel', true, $db);
        $data = [
            'mills' => $millModel->findAll(),
        ];

        return view('rds/header')
            .view('rds/mill', $data)
            .view('rds/footer');
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
}