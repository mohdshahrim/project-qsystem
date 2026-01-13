<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'darth',
            'email'    => 'darth@theempire.com',
        ];

        $this->db->table('user')->insert($data);
    }
}
