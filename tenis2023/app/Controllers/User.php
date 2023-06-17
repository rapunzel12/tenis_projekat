<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\GrupaModel;
use App\Models\RezervacijaModel;
use App\Models\RezervacijaGrupaModel;
use App\Models\ZahtevModel;


class User extends Main
{

    public function index()
    {
        // $name = "moj username"; // radi 
        $user = $this->session->get("user");
        $name = $user->korime; 
        if($user->tip == 0) {
        
            return view('member', ['name'=> $name, 'user'=>$user]);
        }
        if($user->tip == 1) {
        
            return view('student', ['name'=> $name, 'user'=>$user]);
        }
        if($user->tip == 2) {
            // brojaci na trener meni stranici
            
            // ukupno zahteva rekreativaca na cekanju
            $rezervacijaModel = new RezervacijaModel();
            $rezervacijaNaCekanju = $rezervacijaModel
            ->join('korisnik', 'rezervacija.korisnik_idkor = korisnik.idkor')
            ->where('trener_idkor', $this->session->get("user")->idkor)
            ->where('rezervacija.status', 'cek')
            ->where('korisnik.tip', '0')->countAllResults();
            
            $grupaModel = new GrupaModel();
            $sveGrupe = $grupaModel->sveGrupeTrenera($this->session->get("user")->idkor);
            $ukupnoGrupa = count($sveGrupe);

            // ukupno zahteva od ucenika na cekanju
            $zahtevModel = new ZahtevModel();
            $ukupnoZahtevaUcenika = $zahtevModel
            ->where('trener_idkor', $this->session->get("user")->idkor)
            ->where('status', 'cek')->countAllResults();            

            // ukupno rezervacija za individualni trening od ucenika i rekreativaca
            $ukupnoRezervacija = $rezervacijaModel
            ->where('status', 'rez')
            ->where('trener_idkor', $this->session->get("user")->idkor)->countAllResults();

            // ukupno rezervacija za grupni trening
            $rezervacijaGrupaModel = new RezervacijaGrupaModel();
            $ukupnoRezervacijaGrupni = $rezervacijaGrupaModel
            ->where('status', 'rez')
            ->where('trener_idkor', $this->session->get("user")->idkor)->countAllResults();

            // za trener menu modal, podaci o treneru
            $korisnikModel = new UserModel();
            $korisnik = $korisnikModel
            ->join('trener', 'korisnik.idkor = trener.idkor')
            ->find($this->session->get("user")->idkor);

        return view('coach', ['name'=> $name, 'user'=>$user, 'rezervacijaNaCekanju' => $rezervacijaNaCekanju, 'ukupnoGrupa' => $ukupnoGrupa, 'ukupnoZahtevaUcenika' => $ukupnoZahtevaUcenika, 'korisnik' => $korisnik, 'ukupnoRezervacija' => $ukupnoRezervacija, 'ukupnoRezervacijaGrupni' => $ukupnoRezervacijaGrupni]);        
            
        }

        if($user->tip == 3) {
    
            return view('admin', ['name'=> $name, 'user'=>$user]);
        }
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to("");
    }
   
    /*public function showImage($idkor, $poster)
    {
        $user = new UserModel();
        $users = $user->select($idkor, ["poster"=>$poster]);
        return view('admin', ['users'=>$users]);
    }
*/
}