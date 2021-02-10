<?php

namespace App\Models;

use CodeIgniter\Model;

class Member extends Model
{
    protected $table = 'member';
    protected $allowedFields = ['nama', 'umur', 'alamat'];
}
