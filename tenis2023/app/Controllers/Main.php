<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CourtModel;
use App\Models\TariffModel;
use App\Models\UserModel;
use App\Models\CoachModel;

class Main extends BaseController
{

    public function index()
    {
        return view('home');
    }


    public function viewTenisCourts(){
        return view('tenis_courts');
    }
    public function viewTenisCourtsTypes(){

        $courtModel = new CourtModel();

        $courts = $courtModel->findAll();

        return view('tenis_courts_types', ['courts'=>$courts]);
    }
    public function viewTenisCoaches(){

        $trenerModel = new CoachModel();                
        $treneri = $trenerModel
        ->join('korisnik', 'korisnik.idkor = trener.idkor')
        ->where("korisnik.idkor = trener.idkor")
        ->findAll();
         
        return view('tenis_coaches', ["treneri" => $treneri]);
    }
    
    public function price(){
        // dodati kod za prikazivanje spiska cena
        $tariffModel = new TariffModel();
        $tariffs = $tariffModel->findAll();
        // var_dump($tariffs);
        return view('tariff', ['tariffs'=>$tariffs]);
    }

    public function viewAdmins(){
        
        $userModel = new UserModel();
        $users= $userModel->where('tip', '3')->findAll();
        return view('admins', ['users'=>$users]);
    }

}
