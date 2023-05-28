<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table      = 'ucenik';
    protected $primaryKey = 'idkor';

    protected $useAutoIncrement = false;

    protected $returnType     = 'object';

    protected $allowedFields = ['idkor'];
}