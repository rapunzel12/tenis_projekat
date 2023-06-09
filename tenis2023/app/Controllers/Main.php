<?php

namespace App\Controllers;

use App\Models\AdminModel;
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

    public function viewTenisCoaches(){
        return view('tenis_coaches');
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
