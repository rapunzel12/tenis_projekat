<?php

namespace App\Controllers;

use App\Models\GrupaModel;
use App\Models\ClanModel;
use App\Models\CoachModel;
use App\Models\UserModel;
use App\Models\ZahtevModel;
use PHPUnit\Util\Xml\Loader;

class Grupa extends User
{
   
    public function delGrupa($id)
    {
        $clanModel = new ClanModel();                
        $clanModel->delete($id); // brisanje svih clanova grupe koju brisemo

        $grupaModel = new GrupaModel();
        $grupa = $grupaModel->find($id)->naziv; // pre brisanja da uzmemo naziv grupe                
        $grupaModel->delete($id); // brisanje grupe

        return redirect()->to('coach/pregledGrupa')->with("msg", 'Grupa "' . strtoupper($grupa) . '" je obrisana.');        
    }

    public function addGrupa() {
        
        if(!$this->validate(
            [
                'naziv' => ['label' => 'Naziv grupe', 'rules' => 'required|min_length[3]|max_length[15]|alpha_numeric_punct'],
                'ucenik' => ['label' => 'Učenik', 'rules' => 'required']
            ]
        )) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors('list'));
        }       
        
        $grupaModel = new GrupaModel();
        $grupa = [
            'naziv' => $this->request->getPost("naziv"),            
            'trener_idkor' => $this->session->get("user")->idkor            
            ];        
        $grupaModel->insert($grupa);      
        $idGrupe = $grupaModel->insertID(); // id kreirane grupe
        $nazivGrupe = $grupaModel->find($idGrupe)->naziv;
        
        var_dump($this->request->getPost("ucenik"));
        // unos u tabelu clan sve izabrane ucenike
        foreach ($this->request->getPost("ucenik") as $selektovaniUcenik)
        {
            $noviClan = ['grupa_idgru' => $idGrupe, 'ucenik_idkor' => $selektovaniUcenik];
            $clanModel = new ClanModel();
            $clanModel->insert($noviClan);
        } 
        return redirect()->to('coach/pregledGrupa')->with("msg", 'Grupa "'.strtoupper($nazivGrupe).'" je uspešno kreirana.');
        
    }
    public function formaAddGrupa(){    
       
        $korisnikModel = new UserModel();  
        $clanModel = new ClanModel();

        $sviClanovi = $clanModel->findAll();        
        $exclude_ids = array_column($sviClanovi, 'ucenik_idkor'); // kolonu ucenik_idkor pretvara u niz
        if (empty($exclude_ids)) $exclude_ids[0]=0; // izbacuje gresku ako je niz prazan, mozda postoji bolje nacin ali radi i ovako
                
        // prikazujemo samo ucenike koji su prihvaceni od strane trenera i nisu clan ni jedne grupe
        $ucenici = $korisnikModel        
        ->join('zahtev', 'korisnik.idkor = zahtev.ucenik_idkor')
        ->where('zahtev.status', 'slo')
        ->where('zahtev.trener_idkor', $this->session->get("user")->idkor)
        ->whereNotIn('korisnik.idkor', $exclude_ids)
        ->findAll();

        return view("trener/formaAddGrupa", ["ucenici" => $ucenici]);        
    }

    
}
