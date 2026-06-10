<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\CLI\CLI;

class SetupFragment extends Migration
{
    protected $DBGroup = 'fragment';

    public function up()
    {
        // create database
        $this->forge->createDatabase('fragment', true);
        

        // SITE
        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'auto_increment' => true,],
            'site_id' => ['type' => 'TEXT',],
            'site_name' => ['type' => 'TEXT',],
            'site_type' => ['type' => 'INTEGER',],
            'address' => ['type' => 'TEXT', 'null' => true,],
            'city' => ['type' => 'TEXT', 'null' => true,],
            'oic' => ['type' => 'INTEGER',],
            'created_at' => ['type' => 'TEXT',],
            'updated_at' => ['type' => 'TEXT', 'null' => true,],
            'deleted_at' => ['type' => 'TEXT', 'null' => true,],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('site', true);
        $data = [['site_id' => 'DEFAULT', 'site_name' => 'DEFAULT', 'site_type' => 1, 'city' => 1, 'oic' => 1, 'created_at' => date('Y-m-d H:i:s'),]];
        $this->db->table('site')->insertBatch($data);

        // STAFF
        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'auto_increment' => true,],
            'staff_id' => ['type' => 'TEXT',],
            'fullname' => ['type' => 'TEXT',],
            'telno' => ['type' => 'TEXT', 'null' => true,],
            'email' => ['type' => 'TEXT', 'null' => true,],
            'birthdate' => ['type' => 'TEXT', 'null' => true,],
            'age' => ['type' => 'TEXT', 'null' => true,],
            'designation' => ['type' => 'INTEGER',],
            'department' => ['type' => 'INTEGER',],
            'site' => ['type' => 'INTEGER',],
            'created_at' => ['type' => 'TEXT',],
            'updated_at' => ['type' => 'TEXT', 'null' => true,],
            'deleted_at' => ['type' => 'TEXT', 'null' => true,],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('staff', true);
        $data = [['staff_id' => 'DEFAULT', 'fullname' => 'DEFAULT', 'designation' => 1, 'department' => 1, 'site' => 1, 'created_at' => date('Y-m-d H:i:s'),]];
        $this->db->table('staff')->insertBatch($data);

        // DEPARTMENT
        $this->forge->addField([
            'id' => ['type' => 'INTEGER','auto_increment' => true,],
            'department_name' => ['type' => 'TEXT',],
            'created_at' => ['type' => 'TEXT',],
            'updated_at' => ['type' => 'TEXT', 'null' => true,],
            'deleted_at' => ['type' => 'TEXT', 'null' => true,],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('department', true);
        $data = [['department_name' => 'DEFAULT', 'created_at' => date('Y-m-d H:i:s'),]];
        $this->db->table('department')->insertBatch($data);

        // DESIGNATION
        $this->forge->addField([
            'id' => ['type' => 'INTEGER','auto_increment' => true,],
            'designation_name' => ['type' => 'TEXT',],
            'created_at' => ['type' => 'TEXT',],
            'updated_at' => ['type' => 'TEXT', 'null' => true,],
            'deleted_at' => ['type' => 'TEXT', 'null' => true,],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('designation', true);
        $data = [['designation_name' => 'DEFAULT', 'created_at' => date('Y-m-d H:i:s'),]];
        $this->db->table('designation')->insertBatch($data);

        // PC
        $this->forge->addField([
            'id' => ['type' => 'INTEGER','auto_increment' => true,],
            'hostname' => ['type' => 'TEXT',],
            'asset_no' => ['type' => 'TEXT',],
            'serial_no' => ['type' => 'TEXT', 'null' => true,],
            'model' => ['type' => 'TEXT', 'null' => true,],
            'os' => ['type' => 'TEXT', 'null' => true,],
            'ip_address' => ['type' => 'TEXT', 'null' => true,],
            'computer_type' => ['type' => 'INTEGER', 'null' => true,],
            'assigned_user' => ['type' => 'INTEGER', 'null' => true,],
            'site' => ['type' => 'INTEGER',],
            'physical_location' => ['type' => 'TEXT', 'null' => true,],
            'notes' => ['type' => 'TEXT', 'null' => true,],
            'created_at' => ['type' => 'TEXT',],
            'updated_at' => ['type' => 'TEXT', 'null' => true,],
            'deleted_at' => ['type' => 'TEXT', 'null' => true,],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pc', true);
        $data = [['hostname' => 'DEFAULT', 'asset_no' => 'DEFAULT', 'site' => 1, 'created_at' => date('Y-m-d H:i:s'),]];
        $this->db->table('pc')->insertBatch($data);

        // PC IMAGES
        $this->forge->addField([
            'id' => ['type' => 'INTEGER','auto_increment' => true,],
            'pc_id' => ['type' => 'INTEGER',],
            'file_path' => ['type' => 'TEXT', 'null' => true,],
            'image_type' => ['type' => 'TEXT', 'null' => true,],
            'description' => ['type' => 'TEXT', 'null' => true,],
            'created_at' => ['type' => 'TEXT',],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pc_images', true);

        // MONITOR
        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'auto_increment' => true,],
            'asset_no' => ['type' => 'TEXT',],
            'serial_no' => ['type' => 'TEXT', 'null' => true,],
            'model' => ['type' => 'TEXT', 'null' => true,],
            'screen_size' => ['type' => 'TEXT', 'null' => true,],
            'site' => ['type' => 'INTEGER',],
            'host' => ['type' => 'INTEGER', 'null' => true,],
            'notes' => ['type' => 'TEXT', 'null' => true,],
            'created_at' => ['type' => 'TEXT',],
            'updated_at' => ['type' => 'TEXT', 'null' => true,],
            'deleted_at' => ['type' => 'TEXT', 'null' => true,],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('monitor', true);
        $data = [['asset_no' => 'DEFAULT', 'site' => 1, 'created_at' => date('Y-m-d H:i:s'),]];
        $this->db->table('monitor')->insertBatch($data);

        // PRINTER
        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'auto_increment' => true,],
            'serial_no' => ['type' => 'TEXT', 'null' => true,],
            'model' => ['type' => 'TEXT', 'null' => true,],
            'nickname' => ['type' => 'TEXT', 'null' => true],
            'printer_type' => ['type' => 'TEXT', 'null' => true,],
            'host' => ['type' => 'INTEGER', 'null' => true,],
            'ip_address' => ['type' => 'TEXT', 'null' => true,],
            'is_rental' => ['type' => 'TEXT', 'null' => true,],
            'notes' => ['type' => 'TEXT', 'null' => true,],
            'site' => ['type' => 'INTEGER',],
            'created_at' => ['type' => 'TEXT',],
            'updated_at' => ['type' => 'TEXT', 'null' => true,],
            'deleted_at' => ['type' => 'TEXT', 'null' => true,],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('printer', true);

        // PRINTER IMAGE MODEL
        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'auto_increment' => true,],
            'printer_id' => ['type' => 'INTEGER',],
            'file_path' => ['type' => 'TEXT',],
            'description' => ['type' => 'TEXT', 'null' => true,],
            'created_at' => ['type' => 'TEXT',],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('printer_images', true);

        CLI::write('fragment migration OK', 'green');
    }

    public function down()
    {
        //
    }
}
