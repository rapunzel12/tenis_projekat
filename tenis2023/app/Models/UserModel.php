<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'korisnik';
    protected $primaryKey = 'idkor';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['korime', 'pass', 'ime', 'prezime', 'brtel', 'poster', 'email', 'status', 'tip'];

    public function getUsers($status)
    {
        if (isset($status) && $status != 4)
            return $this->where('status', $status)->get()->getResultArray();   
    }
}
