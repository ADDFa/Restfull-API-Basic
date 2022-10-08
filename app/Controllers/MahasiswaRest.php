<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\Mahasiswa;

class MahasiswaRest extends ResourceController
{
    use ResponseTrait;

    private $mahasiswa;

    public function __construct()
    {
        $this->mahasiswa = new Mahasiswa();
    }

    public function index()
    {
        $data['dataMahasiswa'] = $this->mahasiswa->findAll();
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $data = $this->mahasiswa->find($id);
        return ($data) ? $this->respond($data) : $this->failNotFound('Mahasiswa Tidak Ditemukan');
    }

    public function datas()
    {
        $data = [
            'npm'                   => $this->request->getVar('npm'),
            'prodi'                 => $this->request->getVar('prodi'),
            'nama'                  => $this->request->getVar('nama'),
            'jenis_kelamin'         => $this->request->getVar('jenis_kelamin'),
            'alamat'                => $this->request->getVar('alamat'),
            'no_telp'               => $this->request->getVar('no_telp'),
            'tahun_masuk'           => $this->request->getVar('tahun_masuk'),
            'bulan_masuk'           => $this->request->getVar('bulan_masuk'),
            'seleksi_masuk'         => $this->request->getVar('seleksi_masuk')
        ];

        return $data;
    }

    public function create()
    {
        $this->mahasiswa->insert($this->datas(), true);

        return $this->respondCreated([
            'status'    => '201',
            'error'     => null,
            'messages'  => [
                'success'   => 'Berhasil Menambahkan Data Mahasiswa.'
            ]
        ]);
    }

    public function update($id = null)
    {
        $mahasiswa = $this->mahasiswa->find($id);

        if ($mahasiswa) {
            $this->mahasiswa->update($id, $this->datas());

            return $this->respondCreated([
                'status'    => '201',
                'error'     => null,
                'messages'  => [
                    'success'   => 'Berhasil Mengubah Data Mahasiswa.'
                ]
            ]);
        } else {
            return $this->failNotFound('Mahasiswa Dengan NPM ---' . $id . '--- Tidak Ditemukan.');
        }

        return $this->failServerError('Gagal Mengubah Data Mahasiswa.');
    }

    public function delete($id = null)
    {
        $mahasiswa = $this->mahasiswa->find($id);

        if (!$mahasiswa) return $this->failNotFound('Mahasiswa Dengan NPM ---' . $id . '--- Tidak Ditemukan.');

        $this->mahasiswa->delete($id);
        return $this->respondDeleted([
            'status'    => 200,
            'error'     => null,
            'messages'  => [
                'success'   => 'Mahasiswa Dengan NPM ---' . $id . '--- Berhasil Dihapus.'
            ]
        ]);
    }
}
