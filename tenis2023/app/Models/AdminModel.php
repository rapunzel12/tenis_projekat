<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'administrator';
    protected $primaryKey = 'idkor';

    protected $useAutoIncrement = false;

    protected $returnType     = 'object';

    protected $allowedFields = ['opis','idkor'];

    public function getRequests($name, $lastname, $username, $password, $email, $tel) // $poster
    {
        $builder = $this->builder();
       
        $builder->where('ime', $name);
        $builder->where('prezime', $lastname);
        $builder->where('korime', $username);
        $builder->where('pass', $password);
        $builder->where('email', $email);
        $builder->where('brtel', $tel);
         if(isset($username)) // da li proveravam da li je setovan username ili user, tj korisnik?
            $builder->where('korime', $username);
        // $builder->where('poster', $poster);
            $builder->select('ime, prezime, korime, pass, email, brtel');
        return $builder->get()->getResultArray();
    }


}