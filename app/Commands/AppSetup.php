<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Database\RawSql;

class AppSetup extends BaseCommand
{
    protected $group = 'Setup';
    protected $name = 'setup';
    protected $description = 'Run first-time setup wizard';

    public function run(array $params)
    {
        // ask for display name
        $name = CLI::prompt('Enter your name');

        // ask for password
        $password = CLI::prompt('Enter your password');

        // password confirmation
        $confirm_password = CLI::prompt('Reenter password to confirm');

        // compare password
        if ($password === $confirm_password) {

            CLI::write('creating core database...');

            $forge = \Config\Database::forge();

            if ($forge->createDatabase('core')) {
                CLI::write('core database created');

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
                $forge->dropTable('user', true);

                CLI::write('core database: creating user table...');

                $forge->createTable('user');

                CLI::write('core database: user table created');

                CLI::write('core database: seeding user table...');

                $data = [
                    'display_name' => $name,
                    'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                $db = db_connect();
                $builder = $db->table('user');
                $builder->insert($data);

                CLI::write('core database: user table seeded');

                CLI::write('Setup finished');
            }

        } else {
            CLI::write('password confirmation failed');
            exit();
        }

    }

}