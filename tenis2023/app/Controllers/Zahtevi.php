<?php

namespace App\Controllers;

use App\Models\TerminModel;
use App\Models\RezervacijaModel;
use App\Models\ZahtevModel;

class Zahtevi extends BaseController
{
   
    public function index()
    {
        return view('trener/zahteviRekreativaca');
    }


    
    public function zahteviRekreativaca()    
    {        
        $rezervacijaModel = new RezervacijaModel();        
        $zahteviRekreativaca = $rezervacijaModel
        ->select('idrez, teren_idteren, termin_idtermin, rezervacija.status, brrek, cena, rekreativac_idkor, trener_idkor, idtermin, datum, vreme, ime, prezime, brtel, tippod, opis  ')
        ->join('termin', 'termin_idtermin = idtermin')
        ->join('korisnik', 'rekreativac_idkor = idkor')
        ->join('teren', 'teren_idteren = idteren')
        ->where("termin_idtermin = idtermin and rekreativac_idkor = idkor and teren_idteren = idteren and trener_idkor = " . $this->session->get("user")->idkor)
        ->orderby("datum, vreme asc")
        ->findAll();             
        
        return view("trener/zahteviRekreativaca", ["zahteviRekreativaca" => $zahteviRekreativaca]);        
    }

    public function delZahtevRekreativca($id)
    {

        $rezervacijaModel = new RezervacijaModel();  
        $idTermina = $rezervacijaModel->find($id)->termin_idtermin;            
        $rezervacijaModel->delete($id);       

        $terminModel = new TerminModel();
        $terminModel->delete($idTermina);
        
        return redirect()->to('zahtevi/zahteviRekreativaca')->with("msg", 'Zahtev je obrisan.');        
    }

    public function otkaziZahtevRekreativca($id)
    {

        $rezervacijaModel = new RezervacijaModel();
        $rezervacija = $rezervacijaModel->find($id);
        $rezervacija->status = 'otk';
        $rezervacijaModel->update($id, $rezervacija);   
        
        return redirect()->to('zahtevi/zahteviRekreativaca')->with("msg", 'Zahtev je otkazan.');
    }

    public function zahteviUcenika(){

        $zahtevModel = new ZahtevModel();        
        $zahteviUcenika = $zahtevModel
        ->select('idzahtev, trener_idkor, ucenik_idkor, korisnik.ime, korisnik.prezime, korisnik.poster, zahtev.status')
        ->join('korisnik', 'korisnik.idkor = zahtev.ucenik_idkor')
        ->where('trener_idkor', $this->session->get("user")->idkor)
        ->orderby("idzahtev desc")->findAll();
        
        return view('trener/zahteviUcenika', ['zahteviUcenika' => $zahteviUcenika]);
    }

    public function zahteviUcenikaUpdate($action, $ucenik_id){

        $zahtevModel = new ZahtevModel();  
        $zahtev = $zahtevModel->find($ucenik_id);
        switch ($action) {
            case 'accept':                
                $zahtev->status = 'slo';
                $zahtevModel->update($ucenik_id, $zahtev);
                $poruka = "Zahtev je prihvaćen.";                
                break;
            case 'cancel':
                $zahtev->status = 'otk';
                $zahtevModel->update($ucenik_id, $zahtev);
                $poruka = "Zahtev je odbijen.";                
                break;
            case 'del':
                $zahtevModel->delete($ucenik_id);                
                $poruka = 'Zahtev je uspešno obrisan.';
                break;            
        }               

        
        
        return redirect()->to('zahtevi/zahteviUcenika')->with("msg", $poruka);
    }
    
}
