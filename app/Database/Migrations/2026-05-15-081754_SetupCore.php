<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SetupCore extends Migration
{
    public function up()
    {
        $forge = \Config\Database::forge();

        $fields = [
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'display_name' => [
                'type' => 'TEXT',
                'default' => 'Administrator',
            ],
            'password_hash' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'TEXT',
            ],
            'updated_at' => [
                'type' => 'TEXT',
                'null' => true,
            ],

        ];
        
        $forge->addField($fields);
        $forge->addKey('id', true);
        $forge->createTable('user');
    }

    public function down()
    {
        //
    }
}
