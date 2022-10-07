<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        // kode_prodi, nama_prodi, status, jenjang, akreditasi

        $data = [
            [
                'kode_prodi'    => '55201',
                'nama_prodi'    => 'Informatika',
                'status'        => 'aktif',
                'jenjang'       => 'S1',
                'akreditasi'    => 'B'
            ],

            [
                'kode_prodi'    => '22201',
                'nama_prodi'    => 'Teknik Sipil',
                'status'        => 'aktif',
                'jenjang'       => 'S1',
                'akreditasi'    => 'B'
            ],

            [
                'kode_prodi'    => '21201',
                'nama_prodi'    => 'Teknik Mesin',
                'status'        => 'aktif',
                'jenjang'       => 'S1',
                'akreditasi'    => 'Baik Sekali'
            ],

            [
                'kode_prodi'    => '20201',
                'nama_prodi'    => 'Teknik Elektro',
                'status'        => 'aktif',
                'jenjang'       => 'S1',
                'akreditasi'    => 'B'
            ],

            [
                'kode_prodi'    => '23201',
                'nama_prodi'    => 'Arsitektur',
                'status'        => 'aktif',
                'jenjang'       => 'S1',
                'akreditasi'    => 'B'
            ],

            [
                'kode_prodi'    => '57201',
                'nama_prodi'    => 'Sistem Informasi',
                'status'        => 'aktif',
                'jenjang'       => 'S1',
                'akreditasi'    => 'C'
            ]
        ];

        $this->db->table('prodi')->insertBatch($data);
    }
}
