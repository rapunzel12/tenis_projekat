<?php

namespace App\Controllers;

use App\Models\TerminModel;
use App\Models\RezervacijaModel;



class Reservation extends User
{
     // sa MOJ PROFIL STRANICE klikom na pregled rezervisanih termina koristi se metoda pregled

    // Kada se forma submituje, koristi se metoda rezervisi za upis podataka u bazu 
    // i redirekciju na view rezervacija ( pregled rezervisanih termina )
    public function index()
    {
        $id = session('user')->idkor;
        $rez1 = new RezervacijaModel();
        $data = $rez1->get_all_data($id);
        
        return view('member/reservation/index',['data'=>$data]);
    }
    
    public function create()
    {
        $rezervacijaModal = new RezervacijaModel(); 
        $tereni = $rezervacijaModal->getCourts();
        

        return view('member/reservation/create',['tereni'=>$tereni]);
    }
   
    public function checkCourt()
    {
        $datum =$this->request->getPost('datum');
        $chosenType = $this->request->getPost('tip_terena');
        

        
        $id = session('user')->idkor;
        $rezervacijaModal = new RezervacijaModel(); 
        $reservations = $rezervacijaModal->get_all_data($id);
        $courtId = $rezervacijaModal->getCourtId($chosenType);
        $courtId= $courtId[0]->idteren;
        $allTerms = $rezervacijaModal->getAllTerms();
        
        $busyTerms = [];
        foreach($allTerms as $term){
            if($datum == $term->datum){
                if($courtId == $term->idteren){
                    $busyTerms[] = $term->vreme;
                }
            }
        }
       
        
        $tereni = $rezervacijaModal->getCourts();
        
        $treneri = $rezervacijaModal->getCoaches();

        return view('member/reservation/create2',['busy'=>$busyTerms,'datum'=>$datum,'teren'=>$courtId, 'treneri'=>$treneri]);
    }
    public function store()
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
            'status' => 'rez',
            'brrek' => $this->request->getPost('broj_reketa'),
            'cena' => 0,
            'trener_idkor'=>$this->request->getPost('trener'),
            'korisnik_idkor'=> $id
        ];

        
        $rezModel = new RezervacijaModel();
        $rezModel->insert($rezervacija);

        $rez1 = new RezervacijaModel();
        $data = $rez1->get_all_data($id);
        
        return view('member/reservation/index',['data'=>$data]);
    }



    public function cancel(){
        $idRez= $this->request->getPost('id_rezervacije');
        $id = session('user')->idkor;
        $rezModel = new RezervacijaModel();
        $status = [
            'status' => 'otk' // Set the new value for the 'status' field
        ];
        $rezModel->update($idRez, $status);
        $data = $rezModel->get_all_data($id);
        

        return view('member/reservation/index',['data'=>$data]);
    }

    public function destroy(){
        
        $idRez= $this->request->getPost('id_rezervacije');
        $id = session('user')->idkor;
        $rezModel = new RezervacijaModel();
        $rezModel->delete($idRez);
        $data = $rezModel->get_all_data($id);
        
        return view('member/reservation/index',['data'=>$data]);
    }



    public function search()
    {   $id = session('user')->idkor;
        $searchInput= $this->request->getGet('search');
        $rez = new RezervacijaModel();
        $data = $rez->searchReservations($id,$searchInput);
        // var_dump($data);
        return view('member/reservation/index',['data'=>$data]);
    }
}