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


    public function getCourts($court_type) 
    {
        $builder = $this->builder();
       
         if(isset($court_type))
            $builder->where('tippod', $court_type);
            $builder->select('tippod, opis');
        return $builder->get()->getResultArray();
    }
	
	 public function sviTereni()
    {
        $tereni = $this->findAll();
        $tereniDropDown = [];        
        foreach($tereni as $teren) 
        {
            $tereniDropDown[$teren->idteren] = 'Teren br'.$teren->idteren.' '.$teren->tippod;
        }
        return $tereniDropDown;
    }
}