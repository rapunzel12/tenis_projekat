<?php

namespace App\Controllers;

use App\Models\CourtModel;
use App\Models\TariffModel;
use App\Models\UserModel;

class Admin extends User
{
    // funkcija koja nas salje na view u kom se pretrazuju korisnici prema tipu zahteva - radi
    public function searchUsers()
    {
        return view('admin\search_users');
    }
    
    // funkcija koja generise tabelu nakon pretrage prema statusu korisnika  - radi
    public function search()
    {
        if (!$this->validate(['status' => ['label'=>'Status', 'rules'=> 'required']])) {
            return redirect()->back()->with('errors', $this->validator->listErrors('list'));
        }
        $userModel = new UserModel();
        $users = $userModel->getUsers($this->request->getVar('status'));
        return view('admin\show_user_status', ['users'=>$users]);
    }
    
    public function updateUser($idkor, $status)
    {
        $userModel = new UserModel();
        $oldStatus=$userModel->find($idkor)->status;
        $userModel->update($idkor, ['status' => $status]);
        $users = $userModel->getUsers($oldStatus);
        return view("admin\show_user_status", ['users'=>$users]);
    }

    // funkcija koja nas vodi na view na kom se nalazi forma za insertovanje novog terena
    public function insertCourts(){
        return view('admin\insert_courts');
    }

    // funkcije koje se odnose na dodavanje terena 
    public function addCourt()
    {
        if (!$this->validate([
            'court_type' => ['label'=>'Tip terena', 'rules'=> 'required'],
            'court_description' => ['label'=>'Opis terena', 'rules'=> 'required|max_length[600]'],
            'poster_vertical' => ['label'=>'Fotografija', 'rules'=> 
                'uploaded[poster_vertical]',
                'max_size[poster_vertical,1024]',
                'mime_in[poster_vertical,image/png,image/jpeg, image/jpg]'
            ],
        ])) {
            return redirect()->back()->withInput() 
                ->with('errors', $this->validator->listErrors('list'));
        }
        $court = [
            'tippod' => $this->request->getPost('court_type'),
            'opis' => $this->request->getPost('court_description'),
        ];

        if ($court['tippod'] != 'S' && $court['tippod'] != 'T' && $court['tippod'] != 'B') {
            return redirect()->back()->withInput()->with('errors', "Pogrešan tip terena");
        }
        
        $courtModel = new CourtModel();
        $courtId = $courtModel->insert($court);

        $posterVertical = $this->request->getFile('poster_vertical');
        $posterVerticalName = $courtId . "_vertical." . $posterVertical->getExtension();
        $posterVertical->move("../public/assets/img/tenis", $posterVerticalName, true);

        $court = ['poster_vertical' => $posterVerticalName];
        $courtModel->update($courtId, $court);
        session()->setFlashdata('msg','Uspešno ste dodali novi teniski teren');
        return view("admin\insert_courts");
    }

    // funkcija koja nas vodi na formu za pretragu terena
    public function searchCourt(){
        return view('admin\search_courts');
    }

    // funkcija koja generise tabelu sa rezultatima pretrage po tipu terena
    public function searchCourts()
    {
        if (!$this->validate(['court_type' => ['label'=>'Tip terena', 'rules'=> 'required']])) {
            return redirect()->back()->with('errors', $this->validator->listErrors('list'));
        }
        $courtModel =  new CourtModel();
        $courts = $courtModel->builder()->select('idteren, tippod, opis'); // ne radi bez buildera
        $courts = $courtModel->getCourts($this->request->getVar('court_type')); // prosledjivanje samo jednog parametra, po cemu i pretrazujemo
        return view ('admin\show_courts', ['courts'=>$courts]);
    }

    // NE VRACA MI DOBAR VIEW, ALI BRISE U BAZI
    public function deleteCourts($idteren, $oldCourt)
    {
        $courtModel =  new CourtModel();
        $oldCourt=$courtModel->find($idteren)->oldCourt;
        $courtModel->delete($idteren);
        $courts = $courtModel->getCourts($idteren);     
        return view('admin/show_all_courts', ['courts'=>$courts]);
    }

    public function tariff()
    {
        return view('admin\insert_new_tariff');
    }

    public function addTariff()
    {
        if (!$this->validate([
            'name' => ['label'=>'Naziv nove ponude', 'rules'=> 'required'],
            'total' => ['label'=>'Iznos cene', 'rules'=> 'required|integer'],
        ])) {
            return redirect()->back()->withInput() 
                ->with('errors', $this->validator->listErrors('list'));
        }
        $tariff = [
            'naziv' => $this->request->getPost('name'),
            'ukupno' => $this->request->getPost('total'),
        ];
        
        $tariffModel = new TariffModel();
        $tariffs = $tariffModel->insert($tariff);
        session()->setFlashdata('msg','Uspešno ste dodali novu ponudu');
        return view("admin\insert_new_tariff", ['tariffs'=>$tariffs]);
    }

    // funkcija koja nas vodi na pogled gde se izlistava cenovnik kluba
    public function changePrice(){ 
        $tariffModel = new TariffModel();
        $tariffs = $tariffModel->builder()
            ->select("idcena, naziv, ukupno")->get()->getResult();
        return view('admin\change_tariff', ['tariffs'=>$tariffs]);
    }

    // NE VRACA MI DOBAR VIEW, ALI BRISE U BAZI
    public function deletePrice($idcena)
    {
        $tariffModel = new TariffModel();
        $oldTariff=$tariffModel->find($idcena);
        $tariffModel->delete($idcena);
        $tariffs = $tariffModel->getTariffs($idcena);
        // PROBLEM: NE ZNAM NA STA DA SE REDIREKTUJEM
        return view('admin\change_tariff', ['tariffs'=>$tariffs]);
    }
}
