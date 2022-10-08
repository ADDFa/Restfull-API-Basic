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

    public function data($json)
    {
        $data = [
            'nama' => $json->nama,
            'npm' => $json->npm,
            'prodi' => $json->prodi,
            'jenis_kelamin' => $json->jenis_kelamin,
            'alamat' => $json->alamat,
            'no_telp' => $json->no_telp,
            'tahun_masuk' => $json->tahun_masuk,
            'bulan_masuk' => $json->bulan_masuk,
            'seleksi_masuk' => $json->seleksi_masuk
        ];

        return $data;
    }

    public function get()
    {
        return json_encode($this->mahasiswa->get());
    }

    public function insert()
    {
        return $this->mahasiswa->insert($this->data($this->request->getJSON()));
    }

    public function update()
    {
        $npm = $this->request->getJSON()->npm;
        return $this->mahasiswa->update($npm, $this->data($this->request->getJSON()));
    }

    public function delete()
    {
        $npm = $this->request->getJSON()->npm;
        return $this->mahasiswa->delete($npm);
    }
}
