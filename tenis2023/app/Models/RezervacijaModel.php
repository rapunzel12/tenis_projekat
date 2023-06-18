<?php

namespace App\Models;

use CodeIgniter\Model;

class RezervacijaModel extends Model
{
    protected $table = 'rezervacija';
    protected $primaryKey = 'idrez';
    
    protected $useAutoIncrement = true;

    protected $returnType = 'object';
    protected $allowedFields = ['idrez', 'idteren', 'idtermin', 'status', 'brrek', 'cena', 'trener_idkor', 'korisnik_idkor'];   
    
    public function get_all_data($id) {
        
        $builder = $this->db->table('rezervacija');
        $builder->select('rezervacija.*, teren.*, trener.* , termin.*');
        $builder->where('korisnik_idkor',$id);
        // Otprilike ovako ce izgledati query kada promenite bazu,
        // ako umesto korisnik_idkor dodje idkor,
        // $builder->where('idkor',$id); 
        $builder->join('teren', 'teren.idteren = rezervacija.idteren');
        $builder->join('trener', 'trener.idkor = rezervacija.trener_idkor');
        $builder->join('termin', 'termin.idtermin = rezervacija.idtermin');
        $query = $builder->get();
        $data = $query->getResult();
        return $data;
    }

    public function getCourts(){
        $builder = $this->db->table('teren');
        $query = $builder->get();
        $data = $query->getResult();
        
        return $data;
    }
    public function getCoaches(){
        $builder = $this->db->table('trener');
        $query = $builder->get();
        $data = $query->getResult();
        
        return $data;
    }

}


?>


