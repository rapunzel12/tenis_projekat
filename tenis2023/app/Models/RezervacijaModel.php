<?php

namespace App\Models;

use CodeIgniter\Model;

class RezervacijaModel extends Model
{
    protected $table = 'rezervacija';
    protected $primaryKey = 'idrez';
    
    protected $useAutoIncrement = true;

    protected $returnType = 'object';
    protected $allowedFields = ['idrez', 'teren_idteren', 'termin_idtermin', 'status', 'brrek', 'cena', 'rekreativac_idkor', 'trener_idkor'];   
    

}

?>