<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Prodi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode_prodi' => [
                'type'              => 'VARCHAR',
                'constraint'        => '5'
            ],

            'nama_prodi' => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
                'null'              => false
            ],

            'status'    => [
                'type'              => "ENUM('aktif', 'tutup')",
                'default'           => 'aktif'
            ],

            'jenjang'   => [
                'type'              => 'VARCHAR',
                'constraint'        => '50',
                'null'              => false
            ],

            'akreditasi' => [
                'type'              => 'VARCHAR',
                'constraint'        => '10',
                'null'              => false
            ]
        ]);

        $this->forge->addPrimaryKey('kode_prodi');
        $this->forge->createTable('prodi', true);
    }

    public function down()
    {
        $this->forge->dropTable('prodi', true);
    }
}
