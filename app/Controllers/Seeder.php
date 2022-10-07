<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\Database\Config;

class Seeder extends BaseController
{
    private $seeder;

    public function __construct()
    {
        $this->seeder = Config::seeder();
    }

    public function prodi()
    {
        $this->seeder->call('ProdiSeeder');
    }
}
