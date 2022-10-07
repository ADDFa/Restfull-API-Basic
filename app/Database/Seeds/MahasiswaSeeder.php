<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        // npm, prodi, nama, jenis_kelamin, alamat, no_telp, tahun_masuk, bulan_masuk, seleksi_masuk

        $data = [
            [
                'npm'           => 'G1A019055',
                'prodi'         => '55201',
                'nama'          => 'Adha Dont Differatama',
                'jenis_kelamin' => 'L',
                'alamat'        => 'Perumahan Medan Baru',
                'no_telp'       => '082374632323',
                'tahun_masuk'   => '2019',
                'bulan_masuk'   => '8',
                'seleksi_masuk' => 'SB'
            ],

            [
                'npm'           => 'G1C019025',
                'prodi'         => '21201',
                'nama'          => 'Mifta Aroyyani',
                'jenis_kelamin' => 'P',
                'alamat'        => 'UNIB',
                'no_telp'       => '082374632324',
                'tahun_masuk'   => '2019',
                'bulan_masuk'   => '8',
                'seleksi_masuk' => 'SB'
            ]
        ];

        $this->db->table('mahasiswa')->insertBatch($data);
    }
}
