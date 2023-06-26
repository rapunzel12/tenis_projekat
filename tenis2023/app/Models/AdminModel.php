<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'administrator';
    protected $primaryKey = 'idkor';

    protected $useAutoIncrement = false;

    protected $returnType     = 'object';

    protected $allowedFields = ['opis','idkor'];


}