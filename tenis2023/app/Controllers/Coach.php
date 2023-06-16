<?php

namespace App\Controllers;

use App\Models\CoachModel;
use App\Models\CourtModel;
use App\Models\GrupaModel;
use App\Models\UserModel;
use App\Models\RezervacijaModel;
use App\Models\ZahtevModel;
use App\Models\TerminModel;

class Coach extends User
{
   
    public function coachMenu()
    {        
        
        $rezervacijaModel = new RezervacijaModel();
        $rezervacijaNaCekanju = $rezervacijaModel
        ->join('korisnik', 'rezervacija.korisnik_idkor = korisnik.idkor')
        ->where('trener_idkor', $this->session->get("user")->idkor)
        ->where('rezervacija.status', 'cek')
        ->where('korisnik.tip', '0')->countAllResults();


        $grupaModel = new GrupaModel();
        $sveGrupe = $grupaModel->sveGrupeTrenera($this->session->get("user")->idkor);
        $ukupnoGrupa = count($sveGrupe);

        $zahtevModel = new ZahtevModel();
        $ukupnoZahtevaUcenika = $zahtevModel->where('trener_idkor', $this->session->get("user")->idkor)->where('status', 'cek')->countAllResults();

        $korisnikModel = new UserModel();
        $korisnik = $korisnikModel
        ->join('trener', 'korisnik.idkor = trener.idkor')
        ->find($this->session->get("user")->idkor);

        $ukupnoRezervacija = $rezervacijaModel
        ->where('status', 'rez')
        ->where('trener_idkor', $this->session->get("user")->idkor)->countAllResults();

        return view("coach", ['rezervacijaNaCekanju' => $rezervacijaNaCekanju, 'ukupnoGrupa' => $ukupnoGrupa, 'ukupnoZahtevaUcenika' => $ukupnoZahtevaUcenika, 'korisnik' => $korisnik, 'ukupnoRezervacija' => $ukupnoRezervacija]);
    }
    
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
        ->orderby("idgru desc")
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
        $tereni['tereni']= $terenModel->sviTereni();

        $grupaModel = new GrupaModel();
        $grupe['grupe']= $grupaModel->sveGrupeTrenera($this->session->get("user")->idkor);
        
        // svi korisnici koji su ucenici trenera i prihvaceni od strane trenera
        $korisnikModel = new UserModel();
        $korisnici = $korisnikModel
        ->join('zahtev', 'korisnik.idkor = zahtev.ucenik_idkor')
        ->where('trener_idkor', $this->session->get("user")->idkor)
        ->where('zahtev.status', 'slo')
        ->orderby("korisnik.prezime asc")->findAll();
        foreach ($korisnici as $korisnik){
            $ucenici[$korisnik->idkor] = $korisnik->ime.' '.$korisnik->prezime;
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
        $idTermina = $terminModel->insertID(); // id termina

        $rezervacijaModel = new RezervacijaModel();

        $tip = $this->request->getPost("tip");
        
        if ($tip == 'individualni'){
            // snimi rezervaciju            
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
            // TODO grupni
        }

        

        $poruka = ucfirst($tip) . " termin je zakazan za " . $datumVremeObj->format('d-m-Y') . " u ".$datumVremeObj->format('H:i');        
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
        
        return redirect()->to('Coach/pregledRezervacija')->with("msg", 'Rezervacija je obrisana.');
    }

    public function otkaziRezervaciju($id){
        $rezervacijaModel = new RezervacijaModel();
        $rezervacija = $rezervacijaModel->find($id);
        $rezervacija->status = 'otk';
        $rezervacijaModel->update($id, $rezervacija);   
        
        return redirect()->to('Coach/pregledRezervacija')->with("msg", 'Rezervacija je otkazana.');
    }
    
}
