<?php

namespace App\Controllers;

use App\Models\CoachModel;
use App\Models\CourtModel;
use App\Models\GrupaModel;
use App\Models\UserModel;
use App\Models\RezervacijaModel;
use App\Models\ZahtevModel;

class Coach extends BaseController
{
   
    public function index()
    {        
        
        $rezervacijaModel = new RezervacijaModel();
        $rezervacijaNaCekanju = $rezervacijaModel
        ->join('korisnik', 'rezervacija.korisnik_idkor = korisnik.idkor')
        ->where('trener_idkor', $this->session->get("user")->idkor)
        ->where('rezervacija.status', 'cek')
        ->where('korisnik.tip', '0')->countAllResults();


        $grupaModel = new GrupaModel();
        $sveGrupe = $grupaModel->sveGrupeTrenera($this->session->get("user")->idkor);
        $ukupnoGrupa = count($sveGrupe);

        $zahtevModel = new ZahtevModel();
        $ukupnoZahtevaUcenika = $zahtevModel->where('trener_idkor', $this->session->get("user")->idkor)->where('status', 'cek')->countAllResults();

        $korisnikModel = new UserModel();
        $korisnik = $korisnikModel
        ->join('trener', 'korisnik.idkor = trener.idkor')
        ->find($this->session->get("user")->idkor);

        return view("coach", ['rezervacijaNaCekanju' => $rezervacijaNaCekanju, 'ukupnoGrupa' => $ukupnoGrupa, 'ukupnoZahtevaUcenika' => $ukupnoZahtevaUcenika, 'korisnik' => $korisnik]);
    }
    
    public function pregledTerena()
    {
        $terenModel = new CourtModel();        
        $tereni = $terenModel->findAll();         
        return view("trener/teren", ["tereni" => $tereni]);        
    }

    public function pregledTrenera()
    {
        $trenerModel = new CoachModel();        
                
        $treneri = $trenerModel
        ->join('korisnik', 'korisnik.idkor = trener.idkor')
        ->where("korisnik.idkor = trener.idkor")
        ->findAll();

        return view("trener/treneri", ["treneri" => $treneri]);  
        
    }

    public function pregledGrupa()
    {
        $grupaModel = new GrupaModel();        
                
        $grupe = $grupaModel        
        ->where("trener_idkor", $this->session->get("user")->idkor)
        ->orderby("idgru desc")
        ->findAll();

        $korisnikModel = new UserModel();
        $clanoviGrupe = $korisnikModel
        ->join('clan', 'korisnik.idkor = clan.ucenik_idkor')
        ->where("clan.ucenik_idkor = korisnik.idkor")        
        ->findAll();
        return view("trener/grupe", ["clanoviGrupe" => $clanoviGrupe, "grupe" => $grupe]);         
        
    }

    public function rezervisanjeTermina()
    {
        $terenModel = new CourtModel();
        $tereni['tereni']= $terenModel->sviTereni();

        $grupaModel = new GrupaModel();
        $grupe['grupe']= $grupaModel->sveGrupeTrenera($this->session->get("user")->idkor);
        
        $korisnikModel = new UserModel();
        $korisnici = $korisnikModel
        ->join('zahtev', 'korisnik.idkor = zahtev.ucenik_idkor')
        ->where('trener_idkor', $this->session->get("user")->idkor)
        ->where('zahtev.status', 'slo')
        ->orderby("korisnik.prezime asc")->findAll();
        foreach ($korisnici as $korisnik){
            $ucenici[$korisnik->idkor] = $korisnik->ime.' '.$korisnik->prezime;
        }

        return view("trener/rezervisanjeTermina", ["tereni"=>$tereni, "grupe"=>$grupe, "ucenici"=>$ucenici]);
    }

    


    public function addRezervisanjeTermina(){
        if(!$this->validate(
            [
                'teren' => 'required',
                'datum' => 'required|valid_date[Y-m-d\TH:i]',
                'tip' => 'required',
                'brreketa' => 'required|integer|max_length[2]'
            ]
        )) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors('list'));
        }
    }
    
}
