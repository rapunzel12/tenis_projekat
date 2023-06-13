<?php

namespace App\Models;

use CodeIgniter\Model;

class ZahtevModel extends Model
{
    protected $table = 'zahtev';
    protected $primaryKey = 'idzahtev';
    
    protected $useAutoIncrement = true;

    protected $returnType = 'object';
    
    protected $allowedFields = ['idzahtev', 'ucenik_idkor', 'trener_idkor', 'status'];
    

}

?>