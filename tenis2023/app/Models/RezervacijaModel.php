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
    public function getCourtId($type){
        $builder = $this->db->table('teren');
        $builder->where('tippod',$type);
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
    public function getAllTerms(){
        $builder = $this->db->table('rezervacija');
        $builder->select('rezervacija.*, termin.vreme AS vreme,termin.datum as datum');
        $builder->join('termin', 'rezervacija.idtermin = termin.idtermin', 'inner');
        $builder->orderBy('vreme', 'asc');
        $query = $builder->get();
        $data = $query->getResult();
        
        return $data;
    }
    public function searchReservations($id,$searchInput){
        $builder = $this->db->table('rezervacija');
        $builder->select('rezervacija.*, teren.*, trener.* , termin.*');
        $builder->where('rezervacija.korisnik_idkor',$id);
        $builder->join('teren', 'teren.idteren = rezervacija.idteren');
        $builder->join('trener', 'trener.idkor = rezervacija.trener_idkor');
        $builder->join('termin', 'termin.idtermin = rezervacija.idtermin');
        $builder->groupStart(); // Start grouping the OR conditions
        $builder->like('poster_vertical', $searchInput);
        $builder->orLike('termin.datum', $searchInput);
        $builder->orLike('termin.vreme', $searchInput);
        $builder->orLike('trener.opis', $searchInput);
        $builder->orLike('rezervacija.status', $searchInput);
        $builder->groupEnd(); // End grouping the OR conditions
        $query = $builder->get();
        
        return $query->getResult();
    }
}


?>


