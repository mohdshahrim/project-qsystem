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

            CLI::write('Running all migrations...');

            $this->runMigrations();

            $data = [
                'display_name' => $name,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $db = db_connect();
            $builder = $db->table('user');
            $builder->insert($data);
        } else {
            CLI::write('Password confirmation failed. Setup aborted.', 'red');
            exit(1);
        }

        CLI::write('Setup finished');
    }

    private function runMigrations(): void
    {
        try {
            $migrate = \Config\Services::migrations();
            $migrate->latest();
            CLI::write('Migration success', 'green');
        } catch (\Throwable $e) {
            $this->showError($e);
            CLI::error('Migration failed. Setup aborted.', 'red');
            exit(1);
        }
    }

}