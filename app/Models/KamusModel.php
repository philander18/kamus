<?php

namespace App\Models;

use CodeIgniter\Model;

class KamusModel extends Model
{
    protected $table = 'kamus';
    protected $allowedFields = ['materi', 'topik', 'isi', 'updated_at'];
}
