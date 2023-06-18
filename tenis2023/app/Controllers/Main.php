<?php
namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CourtModel;
use App\Models\TariffModel;
use App\Models\UserModel;

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
        return view('tenis_coaches');
    }
    
    public function price(){
        $tariffModel = new TariffModel();
        $tariffs = $tariffModel->findAll();
        return view('tariff', ['tariffs'=>$tariffs]);
    }

    public function viewAdmins(){
        
        $userModel = new UserModel(); 
        $users= $userModel->select('korisnik.idkor, administrator.idkor, opis') 
        ->where('korisnik.idkor = administrator.idkor');
        // ->where('tip', '3')->findAll();
        //->get()
        //->getResult();
        return view('admins', ['users'=>$users]);
    }

}
