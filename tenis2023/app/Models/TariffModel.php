<?php

namespace App\Models;

use CodeIgniter\Model;

class TariffModel extends Model
{
    protected $table      = 'cenovnik';
    protected $primaryKey = 'idcena';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['naziv', 'ukupno'];


    public function getTariffs($total) 
    {
        if(isset($total))
            return $this->where('naziv', $total)->get()->getResultArray();
    }
	
}

