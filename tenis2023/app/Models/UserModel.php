<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'korisnik';
    protected $primaryKey = 'idkor';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['korime', 'pass', 'ime','prezime', 'brtel', 'poster', 'email', 'tip', 'status'];

    public function getUsers($status) 
    {
        $builder = $this->builder();
         if(isset($status) && $status != 4)
            $builder->where('status', $status);
            $builder->select('idkor, korime, pass, ime, prezime, brtel, email, tip, status');
        return $builder->get()->getResultArray();
    }
}

