<?php

namespace App\Models;

use CodeIgniter\Model;

class Prodi extends Model
{
    protected $table            = 'prodi';
    protected $primaryKey       = 'kode_prodi';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $allowedFields    = ['kode_prodi', 'nama_prodi', 'status', 'jenjang', 'akreditasi'];
}
