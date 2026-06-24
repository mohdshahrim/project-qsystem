<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\CLI\CLI;

class SetupPulseman extends Migration
{
    protected $DBGroup = 'pulseman';

    public function up()
    {
        // create database
        $this->forge->createDatabase('pulseman', true);
        

        // IP
        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'auto_increment' => true,],
            'label' => ['type' => 'TEXT',],
            'ip_address' => ['type' => 'TEXT',],
            'description' => ['type' => 'TEXT', 'null' => true],
            'status' => ['type' => 'INTEGER',],
            'created_at' => ['type' => 'TEXT',],
            'updated_at' => ['type' => 'TEXT', 'null' => true,],
            'deleted_at' => ['type' => 'TEXT', 'null' => true,],
            'checked_at' => ['type' => 'TEXT', 'null' => true,],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('ip', true);


        // STATUS CODES
        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'auto_increment' => true,],
            'status_code' => ['type' => 'TEXT',],
            'description' => ['type' => 'TEXT',],
            'created_at' => ['type' => 'TEXT',],
            'updated_at' => ['type' => 'TEXT', 'null' => true,],
            'deleted_at' => ['type' => 'TEXT', 'null' => true,],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('statuscode', true);


        CLI::write('pulseman migration OK', 'green');
    }

    public function down()
    {
        //
    }
}
