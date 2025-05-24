<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no_agen', 'no_telp', 'turn_left', 'total_spin','status'];
    
}
