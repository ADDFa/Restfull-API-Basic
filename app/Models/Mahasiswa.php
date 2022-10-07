<?php

namespace App\Models;

use CodeIgniter\Model;

class Mahasiswa extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'npm';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $allowedFields    = ['npm', 'prodi', 'nama', 'jenis_kelamin', 'alamat', 'no_telp', 'tahun_masuk', 'bulan_masuk', 'seleksi_masuk'];

    public function get()
    {
        return $this->db->table('mahasiswa')->select('*')->join('prodi', 'mahasiswa.prodi = prodi.kode_prodi', 'INNER')->get()->getResultObject();
    }
}
