<?php

namespace App\Controllers;

use App\Models\GrupaModel;
use App\Models\ClanModel;
use App\Models\CoachModel;
use App\Models\UserModel;
use App\Models\ZahtevModel;
use App\Models\RezervacijaGrupaModel;
use PHPUnit\Util\Xml\Loader;

class Grupa extends User
{

    public function pregledGrupa()
    {
        $grupaModel = new GrupaModel();        
                
        $grupe = $grupaModel        
        ->where("trener_idkor", session('user')->idkor)
        ->orderby("idgru desc") // sortiramo po idgrupe opadajuce da bi poslednje kreirane bile na pocetku
        ->findAll();

        $korisnikModel = new UserModel();
        $clanoviGrupe = $korisnikModel
        ->join('clan', 'korisnik.idkor = clan.ucenik_idkor')
        ->where("clan.ucenik_idkor = korisnik.idkor")        
        ->findAll();

        return view("trener/grupe", ["clanoviGrupe" => $clanoviGrupe, "grupe" => $grupe]);         
        
    }

    public function kreiranjeGrupe(){    
               
        $clanModel = new ClanModel();        
        $sviClanovi = $clanModel->findAll();

        $exclude_ids = array_column($sviClanovi, 'ucenik_idkor'); // kolonu ucenik_idkor pretvara u niz
        if (empty($exclude_ids)) $exclude_ids[0]=0; // izbacuje gresku ako je niz prazan pa moramo da dodamo 0
                
        // prikazujemo samo ucenike koji su prihvaceni od strane trenera i nisu clan ni jedne grupe
        $korisnikModel = new UserModel();  

        $ucenici = $korisnikModel        
        ->join('zahtev', 'korisnik.idkor = zahtev.ucenik_idkor')
        ->where('zahtev.status', 'slo')
        ->where('zahtev.trener_idkor', session('user')->idkor)
        ->whereNotIn('korisnik.idkor', $exclude_ids)
        ->findAll();

        return view("trener/kreiranjeGrupe", ["ucenici" => $ucenici]);        
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
            'trener_idkor' => session('user')->idkor
            ];        
        $grupaModel->insert($grupa);      

        $idGrupe = $grupaModel->insertID(); // id kreirane grupe potreban za unos u tabelu clan        
        
        // unos u tabelu clan sve izabrane ucenike
        $clanModel = new ClanModel();
        foreach ($this->request->getPost("ucenik") as $selektovaniUcenik)
        {
            $noviClan = [
                'grupa_idgru' => $idGrupe,
                'ucenik_idkor' => $selektovaniUcenik
            ];
            $clanModel->insert($noviClan);
        } 
        return redirect()->to('grupa/pregledGrupa')->with("msg", 'Grupa "'.strtoupper($grupa['naziv']).'" je uspešno kreirana.');
        
    }
   
    public function delGrupa($id)
    {
        // brisanje svih clanova grupe koju brisemo
        $clanModel = new ClanModel();                
        $clanModel->delete($id); 

        // zatim brisemo grupu
        $grupaModel = new GrupaModel();
        $grupa = $grupaModel->find($id)->naziv; // pre brisanja grupe da uzmemo naziv grupe da mozemo da prikazemo u poruci              
        $grupaModel->delete($id);

        return redirect()->to('grupa/pregledGrupa')->with("msg", 'Grupa "' . strtoupper($grupa) . '" je obrisana.');        
    }
    
}
