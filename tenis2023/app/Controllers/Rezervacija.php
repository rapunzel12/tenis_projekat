<?php

namespace App\Controllers;

use App\Models\TerminModel;
use App\Models\RezervacijaModel;



class Rezervacija extends User
{

    // sa MOJ PROFIL STRANICE klikom na rezervacija termina
    //  koristi se metoda index ( otvara se stranica sa formom)
    public function index()
    {
        $rezervacijaModal = new RezervacijaModel(); 
        $tereni = $rezervacijaModal->getCourts();
        
        $treneri = $rezervacijaModal->getCoaches();

        return view('member',['tereni'=>$tereni, 'treneri'=>$treneri]);
    }
    // sa MOJ PROFIL STRANICE klikom na pregled rezervisanih termina koristi se metoda pregled
    public function pregled()
    {
        $id = session('user')->idkor;
        $rez1 = new RezervacijaModel();
        $data = $rez1->get_all_data($id);
        
        return view('rezervacija',['data'=>$data]);
    }

    // Kada se forma submituje, koristi se metoda rezervisi za upis podataka u bazu 
    // i redirekciju na view rezervacija ( pregled rezervisanih termina )
    public function rezervisi()
    {
        $termin = [
            'datum' =>$this->request->getPost('datum'),
            'vreme' =>$this->request->getPost('vreme'),
        ];
        $terminModel = new TerminModel();
        $terminModel->insert($termin);
        
        $id = session('user')->idkor;
        
        $rezervacija = [
            'idteren' => $this->request->getPost('teren'),
            'idtermin' => $terminModel->insertID(),
            'status' => 1,
            'brrek' => $this->request->getPost('broj_reketa'),
            'cena' => 0,
            'trener_idkor'=>$this->request->getPost('trener'),
            'korisnik_idkor'=> $id
        ];
        $rezModel = new RezervacijaModel();
        $rezModel->insert($rezervacija);

        $rez1 = new RezervacijaModel();
        $data = $rez1->get_all_data($id);
        
        return view('rezervacija',['data'=>$data]);
    }
}