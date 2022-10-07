<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Mahasiswa as Mhs;
use App\Models\Prodi;

class Mahasiswa extends BaseController
{
    protected $mahasiswa, $prodi;

    public function __construct()
    {
        $this->mahasiswa = new Mhs();
        $this->prodi = new Prodi();
    }

    public function index()
    {
        $data = [
            'title'             => 'Data Mahasiswa',
            'data_mahasiswa'    => $this->mahasiswa->get(),
            'data_prodi'        => $this->prodi->findAll(),
            'no'                => 1,
            'bulan'             => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
        ];

        return view('mahasiswa', $data);
    }

    public function show()
    {
        $npm = $this->request->getJSON()->npm;

        $res = $this->mahasiswa->where('npm', $npm)->find();
        if (!$res) return null;

        return json_encode($res[0]);
    }

    public function insert()
    {
        // 
    }

    public function update()
    {
        // 
    }

    public function delete()
    {
        // 
    }
}
