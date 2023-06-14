<?php

namespace App\Models;

use CodeIgniter\Model;

class TerminModel extends Model
{
    protected $table = 'termin';
    protected $primaryKey = 'idtermin';
    
    protected $useAutoIncrement = true;

    protected $returnType = 'object';
    
    protected $allowedFields = ['idtermin', 'datum', 'vreme'];
    

}

?>