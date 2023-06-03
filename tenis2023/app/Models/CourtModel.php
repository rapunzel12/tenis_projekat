<?php

namespace App\Models;

use CodeIgniter\Model;

class CourtModel extends Model
{
    protected $table      = 'teren';
    protected $primaryKey = 'idteren';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['tippod', 'opis', 'poster_vertical'];


    public function getCourts($court_type, $description) //$poster_vertical
    {
        $builder = $this->builder();
       
        $builder->where('opis', $description);
         if(isset($court_type))
            $builder->where('tippod', $court_type);
        // $builder->where('poster_vertical', $poster_vertical);
            $builder->select('tippod, opis');
        return $builder->get()->getResultArray();
    }
}