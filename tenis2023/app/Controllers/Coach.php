<?php

namespace App\Controllers;

use App\Models\CoachModel;
use App\Models\CourtModel;
use App\Models\GrupaModel;
use App\Models\UserModel;
use App\Models\RezervacijaModel;
use App\Models\RezervacijaGrupaModel;
use App\Models\ZahtevModel;
use App\Models\TerminModel;
use CodeIgniter\Support\Helpers;

class Coach extends User
{   
    
    public function pregledTerena()
    {
        $terenModel = new CourtModel();        
        $tereni = $terenModel->findAll();

        return view("trener/teren", ["tereni" => $tereni]);        
    }

    public function pregledTrenera()
    {
        $trenerModel = new CoachModel();        
                
        $treneri = $trenerModel
        ->join('korisnik', 'korisnik.idkor = trener.idkor')
        ->where("korisnik.idkor = trener.idkor")
        ->findAll();

        return view("trener/treneri", ["treneri" => $treneri]);  
        
    }

    public function pregledGrupa()
    {
        $grupaModel = new GrupaModel();        
                
        $grupe = $grupaModel        
        ->where("trener_idkor", $this->session->get("user")->idkor)
        ->orderby("idgru desc") // sortiramo po idgrupe opadajuce da bi poslednje kreirane bile na pocetku
        ->findAll();

        $korisnikModel = new UserModel();
        $clanoviGrupe = $korisnikModel
        ->join('clan', 'korisnik.idkor = clan.ucenik_idkor')
        ->where("clan.ucenik_idkor = korisnik.idkor")        
        ->findAll();

        return view("trener/grupe", ["clanoviGrupe" => $clanoviGrupe, "grupe" => $grupe]);         
        
    }

    public function rezervisanjeTermina()
    {
        $terenModel = new CourtModel();
        $tereni['Izaberite teren']= $terenModel->sviTereni();

        
        $grupaModel = new GrupaModel();        
        $grupe['Izaberite grupu']= $grupaModel->sveGrupeTrenera($this->session->get("user")->idkor);
        
        
        // svi korisnici koji su ucenici trenera i prihvaceni od strane trenera
        $korisnikModel = new UserModel();
        $korisnici = $korisnikModel
        ->join('zahtev', 'korisnik.idkor = zahtev.ucenik_idkor')
        ->where('trener_idkor', $this->session->get("user")->idkor)
        ->where('zahtev.status', 'slo')
        ->orderby("korisnik.prezime asc")->findAll();        
        
        foreach ($korisnici as $korisnik){
            $ucenici['Izaberite učenika'][$korisnik->idkor] = $korisnik->ime.' '.$korisnik->prezime;
        }        

        return view("trener/rezervisanjeTermina", ["tereni"=>$tereni, "grupe"=>$grupe, "ucenici"=>$ucenici]);
    }    


    public function addRezervisanjeTermina(){
        if(!$this->validate(
            [
                'teren' => ['label' => 'Teren', 'rules' => 'required'],
                'datum' => ['label' => 'Datum i vreme', 'rules' => 'required'],
                'tip' => ['label' => 'Tip treninga', 'rules' => 'required'],
                'brreketa' => ['label' => 'Broj potrebnih reketa', 'rules' => 'required|integer|less_than_equal_to[10]']
            ]
        )) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors('list'));
        }
        
        // snimimo prvo termin
        $terminModel = new TerminModel();
        $datumVreme = $this->request->getPost("datum");
        $datumVremeObj = new \DateTime($datumVreme);
        $termin = [
            'datum' => $datumVremeObj->format('Y-m-d'),            
            'vreme' => $datumVremeObj->format('H:i:s'),            
            ];        
        $terminModel->insert($termin);      
        $idTermina = $terminModel->insertID(); // ID novo kreiranog snimljenog termina        

        $tip = $this->request->getPost("tip");
        
        if ($tip == 'individualni'){
            // snimi rezervaciju            
            $rezervacijaModel = new RezervacijaModel();
            $rezervacija = [
                $this->request->getPost("teren"),
                $idTermina,
                'rez',
                ((int)$this->request->getPost("brreketa")),
                '0',
                $this->session->get("user")->idkor,
                $this->request->getPost("ucenik"),
                ];          
            $query= 'INSERT INTO rezervacija (idteren, idtermin, status, brrek, cena, trener_idkor, korisnik_idkor) VALUES (?,?,?,?,?,?,?)';
            $rezervacijaModel->query($query, $rezervacija);         
        }
        if ($tip == 'grupni')
        {
            // snimi rezervaciju            
            $rezervacijaGrupaModel = new RezervacijaGrupaModel();
            $rezervacija = [
                $this->request->getPost("teren"),
                $idTermina,
                'rez',
                ((int)$this->request->getPost("brreketa")),
                '0',
                $this->session->get("user")->idkor,
                $this->request->getPost("grupa"),
                ];          
            $query= 'INSERT INTO rezervacija_grupa (idteren, idtermin, status, brrek, cena, trener_idkor, idgru) VALUES (?,?,?,?,?,?,?)';
            $rezervacijaGrupaModel->query($query, $rezervacija);
        }        

        $poruka = ucfirst($tip) . " termin je zakazan za " . $datumVremeObj->format('d.m.Y.') . " u ".$datumVremeObj->format('H:i'); 

        return redirect()->to('coach/rezervisanjeTermina')->with("msg", $poruka);        

    }

    public function pregledRezervacija()
    {

        $rezervacijaModel = new RezervacijaModel();
        $rezervacije = $rezervacijaModel
        ->select('idrez, rezervacija.idteren, rezervacija.idtermin, rezervacija.status, brrek, korisnik_idkor, trener_idkor, termin.idtermin, datum, vreme, ime, prezime, tippod, opis, poster')
        ->join('korisnik', 'rezervacija.korisnik_idkor = korisnik.idkor')
        ->join('termin', 'rezervacija.idtermin = termin.idtermin')
        ->join('teren', 'rezervacija.idteren = teren.idteren')
        ->where('trener_idkor', $this->session->get("user")->idkor)
        ->where('rezervacija.status = "rez" or rezervacija.status = "otk"')
        ->orderby('termin.datum asc, termin.vreme asc')       
        ->findAll();

        return view('trener/pregledRezervacija', ['rezervacije' => $rezervacije]);
    }


    public function obrisiRezervaciju($id){
        $rezervacijaModel = new RezervacijaModel();  
        $idTermina = $rezervacijaModel->find($id)->idtermin;            
        $rezervacijaModel->delete($id);       

        $terminModel = new TerminModel();
        $terminModel->delete($idTermina);
        
        return redirect()->to('Coach/pregledRezervacija')->with("msg", 'Termin je obrisan.');
    }

    public function otkaziRezervaciju($id){
        $rezervacijaModel = new RezervacijaModel();
        $rezervacija = $rezervacijaModel->find($id);
        $rezervacija->status = 'otk';
        $rezervacijaModel->update($id, $rezervacija);   
        
        return redirect()->to('Coach/pregledRezervacija')->with("msg", 'Termin je otkazan.');
    }

    public function pregledRezervacijaGrupni()
    {

        $rezervacijaGrupaModel = new RezervacijaGrupaModel();
        $rezervacije = $rezervacijaGrupaModel
        ->select('idrez, rezervacija_grupa.idteren, rezervacija_grupa.idtermin, rezervacija_grupa.status, brrek, rezervacija_grupa.idgru, rezervacija_grupa.trener_idkor, termin.idtermin, datum, vreme, tippod, opis, naziv')
        ->join('grupa', 'rezervacija_grupa.idgru = grupa.idgru')
        ->join('termin', 'rezervacija_grupa.idtermin = termin.idtermin')
        ->join('teren', 'rezervacija_grupa.idteren = teren.idteren')
        ->where('rezervacija_grupa.trener_idkor', $this->session->get("user")->idkor)        
        ->orderby('termin.datum asc, termin.vreme asc')       
        ->findAll();

        return view('trener/pregledRezervacijaGrupni', ['rezervacije' => $rezervacije]);
    }


    public function rezervacijaGrupa($action, $id){
        $rezervacijaGrupaModel = new RezervacijaGrupaModel();

        if ($action == 'obrisi'){            
            $idTermina = $rezervacijaGrupaModel->find($id)->idtermin;            
            $rezervacijaGrupaModel->delete($id);       

            $terminModel = new TerminModel();
            $terminModel->delete($idTermina);
            $poruka = 'Rezervacija je obrisana.';
        
            
        }

        if ($action == 'otkazi'){            
            $rezervacija = $rezervacijaGrupaModel->find($id);
            $rezervacija->status = 'otk';
            $rezervacijaGrupaModel->update($id, $rezervacija);
            $poruka = 'Rezervacija je otkazana.';
        }

        return redirect()->to('Coach/pregledRezervacijaGrupni')->with("msg", $poruka);
    }    
    
}
