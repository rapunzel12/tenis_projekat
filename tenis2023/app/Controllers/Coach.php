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
        $rezervacijaNaCekanju = $rezervacijaModel->where('trener_idkor', $this->session->get("user")->idkor)->where('status', 'cek')->countAllResults();

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


}
