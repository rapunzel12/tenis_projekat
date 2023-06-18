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
        $builder = $this->builder();
        if(isset($total))
            $builder->where('naziv', $total);
            $builder->select('naziv, ukupno');
        return $builder->get()->getResultArray();
    }
	
   
}

