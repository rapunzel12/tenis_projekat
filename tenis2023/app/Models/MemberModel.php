<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table      = 'rekreativac';
    protected $primaryKey = 'idkor';

    protected $useAutoIncrement = false;

    protected $returnType     = 'object';

    protected $allowedFields = ['idkor'];
}