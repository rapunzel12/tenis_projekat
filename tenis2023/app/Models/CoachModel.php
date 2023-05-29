<?php

namespace App\Models;

use CodeIgniter\Model;

class CoachModel extends Model
{
    protected $table      = 'trener';
    protected $primaryKey = 'idkor';

    protected $useAutoIncrement = false;

    protected $returnType     = 'object';

    protected $allowedFields = ['opis', 'idkor'];
}