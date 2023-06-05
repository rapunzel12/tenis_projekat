<?php

namespace App\Controllers;

use App\Models\CourtModel;
use App\Models\UserModel;

class Admin extends User
{
    public function index()
    {
        return view('admin');
        //$name = "moj username";
        // $name = $this->session->get('user')->korime;
        //return view('user', ['name'=> $name]);
    }

    public function showRequest()
    {
        $user = [
            'ime' => $this->request->getPost('name'),
            'prezime' => $this->request->getPost('lastname'),
            'korime' => $this->request->getPost('username'),
            'pass' => $this->request->getPost('password'),
            'passconf' => $this->request->getPost('passconf'),
            'email' => $this->request->getPost('email'),
            'brtel' => $this->request->getPost('tel'),
            'tip' => $this->request->getPost('user_type'),
            'status' => '0'
            // ove kolone staviti u tabelu sa pristiglim zahtevima
            // dodati status da je 0 = na cekanju, i posle to administrator dohvata te podatke
            // na ovaj nacin se upisuje u bazi 0, administartor mora da uradi update i da azurira to

        ];
        // $userModel = new UserModel();
        // $userModel = $this->find($user);

        return view('admin', $user);
    }

    // metoda koja ce da radi pretragu korisnika prema statusu 
    // 0 = na cekanju, 
    // 1 = prihvacen, 
    // 2 = odbijen, 
    // 3 = arhiviran

    public function search()
    {
        if (!$this->validate([
            'status' => 'required'
        ])) {
            return redirect()->back()->with('errors', $this->validator->listErrors('list'));
        }
        return 'test'; // vratice rec 'test' ako skace na pretragu :)
    }
    // funkcije koje se odnose na dodavanje terena 

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
            // ako validacija ne vrati tacno, redirektujemo se na istu stranicu sa vec unetim podacima
            return redirect()->back()->withInput() // cuvaju se svi inputi koji su vec uneti
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

        return redirect()->to('Admin/index')->with("msg", 'Success');
    }


    // funkcija koja se odnosi na pregled terena kada se unese neki novi teren
    public function showAllCourts()
    {
        $courtModel = new CourtModel();
        $courts = $courtModel->get()->getResult();
        // var_dump($court[0]);
        return view ('admin_show_courts', ['courts'=>$courts]);
    }



    public function searchCourts()
    {
        if (!$this->validate([
            'court_type' => 'required'
        ])) {
            return redirect()->back()->with('errors', $this->validator->listErrors('list'));
        }
        $courtModel =  new CourtModel();
        $courts = $courtModel->getCourts(
            $this->request->getVar('court_type'),
        );
        // echo $courts; // Array to string conversion
        // var_dump($courts); // sada radi
        return view ('admin_show_courts', ['courts'=>$courts]);
        // return 'test'; // vratice rec 'test' ako skace na pretragu :)
    }
}
