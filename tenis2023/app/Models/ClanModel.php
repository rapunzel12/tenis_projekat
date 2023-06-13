<?php

namespace App\Models;

use CodeIgniter\Model;

class ClanModel extends Model
{
    protected $table = 'clan';
    protected $primaryKey = 'grupa_idgru';
    
    protected $useAutoIncrement = true;

    protected $returnType = 'object';
    
    protected $allowedFields = ['grupa_idgru', 'ucenik_idkor'];
    

}

?>