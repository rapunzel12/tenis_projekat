<?php

namespace App\Controllers;

use App\Models\TerminModel;
use App\Models\RezervacijaModel;


class Member extends User
{

    // Kada zavrsis sve,
    //  probaj da zakomentarises function index i isprobaj da li sve radi ( nepotrebna je metoda)
    public function index()
    {
        $rezervacijaModal = new RezervacijaModel(); 
        $tereni = $rezervacijaModal->getCourts();
        
        $treneri = $rezervacijaModal->getCoaches();

        return view('member',['tereni'=>$tereni, 'treneri'=>$treneri]);
    }

    // public function rezervacija()
    // {

    //     $termin = [
    //         'datum' =>$this->request->getPost('datum'),
    //         'vreme' =>$this->request->getPost('vreme'),
    //     ];
    //     $terminModel = new TerminModel();
    //     $terminModel->insert($termin);
        
    //     $id = session('user')->idkor;
        
    //     $rezervacija = [
    //         'teren_idteren' => $this->request->getPost('teren'),
    //         'termin_idtermin' => $terminModel->insertID(),
    //         'status' => 1,
    //         'brrek' => $this->request->getPost('broj_reketa'),
    //         'cena' => 0,
    //         'rekreativac_idkor'=> $id,
    //         'trener_idkor'=>$this->request->getPost('trener')
    //     ];
    //     $rezModel = new RezervacijaModel();
    //     $rezModel->insert($rezervacija);

    //     $rez1 = new RezervacijaModel();
    //     $data = $rez1->get_all_data($id);
        
    //     return view('rezervacija',['data'=>$data]);
    // }

    public function otkazi(){
        // TO DO
        // Logika za izmenu statusa rezervacije u bazi 
        // i vracanje na prethodnu stranicu sa porukom uspesno/neuspesno
        var_dump('uspesno');
        return view('rezervacija');
    }
    public function obrisi(){
        // TO DO
        // Logika za brisanje reda u tabeli rezervacije u bazi 
        // i vracanje na prethodnu stranicu sa porukom uspesno/neuspesno
        var_dump('obrisano');
        return view('rezervacija');
    }
}