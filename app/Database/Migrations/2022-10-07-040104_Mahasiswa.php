<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataMahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'npm' => [
                'type'          => 'VARCHAR',
                'constraint'    => '9'
            ],

            'prodi' => [
                'type'          => 'VARCHAR',
                'constraint'    => '5'
            ],

            'nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'null'          => false
            ],

            'jenis_kelamin' => [
                'type'          => "ENUM('P', 'L')",
                'default'       => 'P'
            ],

            'alamat' => [
                'type'          => 'text',
                'null'          => true
            ],

            'no_telp' => [
                'type'          => 'VARCHAR',
                'constraint'    => '20',
                'null'          => true
            ],

            'tahun_masuk' => [
                'type'          => 'YEAR',
                'null'          => false
            ],

            'bulan_masuk' => [
                'type'          => 'VARCHAR',
                'constraint'    => '2',
                'null'          => false
            ],

            'seleksi_masuk' => [
                'type'          => "ENUM('SN', 'SB', 'SM')",
                'default'       => 'SN'
            ]
        ]);

        $this->forge->addPrimaryKey('npm');
        $this->forge->addForeignKey('prodi', 'prodi', 'kode_prodi', 'CASCADE', 'CASCADE');
        $this->forge->createTable('mahasiswa', true);
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa', true);
    }
}
