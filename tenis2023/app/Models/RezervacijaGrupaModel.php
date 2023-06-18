<?php

namespace App\Models;

use CodeIgniter\Model;

class RezervacijaGrupaModel extends Model
{
    protected $table = 'rezervacija_grupa';
    protected $primaryKey = 'idrez';
    
    protected $useAutoIncrement = true;

    protected $returnType = 'object';
    protected $allowedFields = ['idrez', 'idteren', 'idtermin', 'status', 'brrek', 'cena', 'trener_idkor', 'idgru'];   
    

}

?>