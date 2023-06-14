<?php

namespace App\Models;

use CodeIgniter\Model;

class GrupaModel extends Model
{
    protected $table = 'grupa';
    protected $primaryKey = 'idgru';
    
    protected $useAutoIncrement = true;

    protected $returnType = 'object';
    
    protected $allowedFields = ['idgru', 'naziv', 'trener_idkor'];
    
    public function sveGrupeTrenera($trener_idkor)
    {
        $sveGrupe = $this->where('trener_idkor = ' . $trener_idkor)->orderby('naziv')->findAll();
        $grupeDropdown = [];        
        foreach($sveGrupe as $grupa) 
        {
            $grupeDropdown[$grupa->idgru] = $grupa->naziv;
        }
        return $grupeDropdown;
    }

}

?>