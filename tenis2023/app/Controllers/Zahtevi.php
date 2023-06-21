<?php

namespace App\Controllers;

use App\Models\TerminModel;
use App\Models\RezervacijaModel;
use App\Models\ZahtevModel;

class Zahtevi extends User
{  
      
    public function zahteviRekreativaca()    
    {        
        $rezervacijaModel = new RezervacijaModel();        
        $zahteviRekreativaca = $rezervacijaModel
        ->select('idrez, rezervacija.idteren, rezervacija.idtermin, rezervacija.status, brrek, cena, korisnik_idkor, trener_idkor, termin.idtermin, datum, vreme, ime, prezime, brtel, tippod, opis, korisnik.tip')
        ->join('termin', 'rezervacija.idtermin = termin.idtermin')
        ->join('korisnik', 'rezervacija.korisnik_idkor = korisnik.idkor')
        ->join('teren', 'rezervacija.idteren = teren.idteren')
        ->where("rezervacija.idtermin = termin.idtermin and rezervacija.korisnik_idkor = korisnik.idkor and rezervacija.idteren = teren.idteren and trener_idkor = " . $this->session->get("user")->idkor)
        ->where('korisnik.tip' , '0')
        ->orderby("datum, vreme asc")
        ->findAll();             
        
        return view("trener/zahteviRekreativaca", ["zahteviRekreativaca" => $zahteviRekreativaca]);        
    }
    
    public function zahtevRekreativca($action, $id)
    {
        $rezervacijaModel = new RezervacijaModel();  

        if ($action == 'obrisi'){            
            $idTermina = $rezervacijaModel->find($id)->idtermin;
            $rezervacijaModel->delete($id);

            $terminModel = new TerminModel();
            $terminModel->delete($idTermina);        
            $poruka = 'Zahtev je obrisan.';            
        }

        if ($action == 'otkazi'){
            $rezervacijaModel->update($id, ['status' => 'otk']);   
            $poruka = 'Zahtev je otkazan.';            
        }
        return redirect()->to('zahtevi/zahteviRekreativaca')->with("msg", $poruka);

    }
    

    public function zahteviUcenika(){

        $zahtevModel = new ZahtevModel();        
        $zahteviUcenika = $zahtevModel
        ->select('idzahtev, trener_idkor, ucenik_idkor, korisnik.ime, korisnik.prezime, korisnik.poster, zahtev.status')
        ->join('korisnik', 'korisnik.idkor = zahtev.ucenik_idkor')
        ->where('trener_idkor', session('user')->idkor)
        ->orderby("idzahtev desc")->findAll();
        
        return view('trener/zahteviUcenika', ['zahteviUcenika' => $zahteviUcenika]);
    }

    
    public function zahtevUcenika($action, $ucenik_id){

        $zahtevModel = new ZahtevModel();
        switch ($action) {
            case 'prihvati':
                $zahtevModel->update($ucenik_id, ['status' => 'slo']);
                $poruka = "Zahtev je prihvaćen.";                
                break;
            case 'odbij':                
                $zahtevModel->update($ucenik_id, ['status' => 'odb']);
                $poruka = "Zahtev je odbijen.";                
                break;
            case 'obrisi':
                $zahtevModel->delete($ucenik_id);                
                $poruka = 'Zahtev je uspešno obrisan.';
                break;            
        }        
        
        return redirect()->to('zahtevi/zahteviUcenika')->with("msg", $poruka);
    }
    
}
