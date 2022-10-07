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
        return $this->seeder->call('ProdiSeeder');
    }

    public function mahasiswa()
    {
        return $this->seeder->call('MahasiswaSeeder');
    }

    public function all()
    {
        $this->seeder->call('ProdiSeeder');
        $this->seeder->call('MahasiswaSeeder');

        return redirect()->to('/');
    }
}
