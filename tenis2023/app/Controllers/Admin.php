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
        if (!$this->validate(['status' => 'required'])) {
            return redirect()->back()->with('errors', $this->validator->listErrors('list'));
        }
        $userModel = new UserModel();
        //$users = $userModel->builder()
        //    ->select("idkor, korime, pass, ime, prezime, brtel, email, tip, status")->get()->getResult();

        $users = $userModel->getUsers($this->request->getVar('status'));
        
        // var_dump($users); radi, dohvata kao niz, kao array
        return view('admin\show_user_status', ['users'=>$users]); // vratice rec 'test' ako skace na pretragu :)
    }
    // uradi ovo za pretragu po tipu terena

    public function updateUser($idkor, $status)
    {
        $userModel = new UserModel();
        $oldStatus=$userModel->find($idkor)->status;
        $userModel->update($idkor, ['status' => $status]);
        $users = $userModel->getUsers($oldStatus);
        return view("admin\show_user_status", ['users'=>$users]);
        // var_dump($user);
    }

    // funkcija koja nas vodi na view na kom se nalazi forma za insertovanje novog terena - NE RADI
    public function insertCourts(){
        return view('admin\insert_courts');
    }
    // funkcije koje se odnose na dodavanje terena - ne radi
// PROBLEM JE STO SE REDIREKTUJE NA KONTROLER ADMIN
    public function addCourt()
    {
        if (!$this->validate([
            'court_type' => 'required',
            'court_description' => 'required',
            'poster_vertical' => [
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
            return redirect()->back()->withInput() // cuvaju se svi inputi koji su vec uneti
            ->with('errors', "Pogresan tip terena");
        }
        
        $courtModel = new CourtModel();
        $courtId = $courtModel->insert($court);

        $posterVertical = $this->request->getFile('poster_vertical');
        $posterVerticalName = $courtId . "_vertical." . $posterVertical->getExtension();
        $posterVertical->move("../public/assets/img/tenis", $posterVerticalName, true);

        $court = [
            'poster_vertical' => $posterVerticalName,
        ];

        $courtModel->update($courtId, $court);
        // PROBLEM JE STO SE REDIREKTUJE NA KONTROLER ADMIN
        session()->setFlashdata('msg','Success');
        return view("admin\insert_courts");
        // return redirect()->to('Admin/addCourt')->with("msg", 'Success');
    }

    // funkcija koja nas vodi na formu za pretragu terena
    public function searchCourt(){
        return view('admin\search_courts');
    }

    // funkcija koja generise tabelu sa rezultatima pretrage po tipu terena
    public function searchCourts()
    {
        if (!$this->validate(['court_type' => 'required'])) {
            return redirect()->back()->with('errors', $this->validator->listErrors('list'));
        }
        $courtModel =  new CourtModel();
        $courts = $courtModel->builder()
            ->select('idteren, tippod, opis');
        $courts = $courtModel->getCourts(
            $this->request->getVar('court_type'), // prosledjivanje samo jednog parametra, po cemu i pretrazujemo
        );
        // var_dump($courts); // daje pregled svih terena kao object
        return view ('admin\show_courts', ['courts'=>$courts]);
    }

    public function deleteCourts($idteren)
    {
        $courtModel =  new CourtModel();
        $courts= $courtModel->delete($idteren);        
        //var_dump($courtModel); // daje pregled svih terena kao object
        //return view('admin\show_all_courts', ['courts'=>$courts]);
        // return $this->redirect('admin\show_all_courts',$courts);
    }

    public function tariff()
    {
        return view('admin\insert_new_tariff');
    }

    public function addTariff()
    {
        if (!$this->validate([
            'name' => 'required',
            'total' => 'required',
        ])) {
            return redirect()->back()->withInput() 
                ->with('errors', $this->validator->listErrors('list'));
        }
        $tariff = [
            'naziv' => $this->request->getPost('name'),
            'ukupno' => $this->request->getPost('total'),
        ];
        
        $tariffModel = new TariffModel();
        $tariffId = $tariffModel->insert($tariff);

        // PROBLEM JE STO SE REDIREKTUJE NA KONTROLER ADMIN
        return redirect()->to('Admin/addTariff')->with("msg", 'Success');
    }


    public function changePrice(){
        $tariffModel = new TariffModel();
        $tariffs = $tariffModel->builder()
            ->select("idcena, naziv, ukupno")->get()->getResult();
        return view('admin\change_tariff', ['tariffs'=>$tariffs]);
    }
    public function deletePrice($idcena)
    {
        $tariff = new TariffModel();
        $tariffs = $tariff->delete($idcena);
        // PROBLEM: NE ZNAM NA STA DA SE REDIREKTUJEM
        return view('admin\change_tariff', ['tariffs'=>$tariffs]);
    }
}
