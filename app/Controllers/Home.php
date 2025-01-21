<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        //return view('welcome_message');
        return view('home/index');
    }


    // TESTS
    // reserved for general testing only

    // general test
    public function testgeneral() {
        return WRITEPATH.'database\core.db';
    }

    // just to test reading from db
    public function testdb(): string
    {
        if (file_exists(WRITEPATH.'database/core.db')) {

            $userModel = new \App\Models\Users();
            $user = $userModel->find(1);

            return "core.db yezza ".$user['username'];
        } else {
            return "core.db does not exist";
        }
    }

    public function testforge() {
        $db = \Config\Database::connect('default');
        $db->setDatabase('core2');


        $query = $db->query('SELECT * FROM random WHERE rowid=1');

        foreach ($query->getResult() as $row) {
            echo $row->coffeename;
        }

        $db->close();       
    }
}
