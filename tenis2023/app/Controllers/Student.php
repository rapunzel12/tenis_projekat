<?php

namespace App\Controllers;

use App\Models\TerminModel;
use App\Models\ZahtevModel;
use App\Models\RezervacijaModel;
use App\Models\UserModel;

class Student extends User
{

    public function reserveCoach(){
        $trener = $this->request->getPost('trener');
        $zahtev = new ZahtevModel();
        $id = session('user')->idkor;
        $data = [
            'ucenik_idkor' => $id,
            'trener_idkor' => $trener,
            'status' => 'cek'
        ];
        $zahtev->insert($data);
        $rezervacijaModal = new RezervacijaModel(); 
        $treneri = $rezervacijaModal->getCoaches();
        $user = $this->session->get("user");
        $name = $user->korime;
        
        $reservations = $rezervacijaModal->get_all_data($id);

        $coachAccepted = $zahtev->where('status', 'slo')->get();
        if ($coachAccepted->getNumRows() > 0) {
            
            $coachAccepted = $coachAccepted->getResult();
            $coach = $coachAccepted[0]->trener_idkor;
            $trenerModel = new UserModel();
            $trener = $trenerModel
            ->join('trener', 'korisnik.idkor = trener.idkor')
            ->find($coach);
        } else {
            $trener = null;
        }
        return view('student/student_profile', [
            'name'=> $name, 
            'user'=>$user, 
            'treneri'=>$treneri,
            'personalCoach'=>$trener,
            'reservations'=> $reservations]);
    }

    public function cancel(){

        $user = $this->session->get("user");
        $name = $user->korime;
        $idRez= $this->request->getPost('id_rezervacije');
        $id = session('user')->idkor;
        $rezervacijaModal = new RezervacijaModel();
        $status = [
            'status' => 'otk' // Set the new value for the 'status' field
        ];
        $rezervacijaModal->update($idRez, $status);
        $reservations = $rezervacijaModal->get_all_data($id);

        $treneri = $rezervacijaModal->getCoaches();
        $zahtev = new ZahtevModel();
        $coachAccepted = $zahtev->where('status', 'rez')->get();
        if ($coachAccepted->getNumRows() > 0) {
            
            $coachAccepted = $coachAccepted->getResult();
            $coach = $coachAccepted[0]->trener_idkor;
            $trenerModel = new UserModel();
            $trener = $trenerModel
            ->join('trener', 'korisnik.idkor = trener.idkor')
            ->find($coach);
        } else {
            $trener = null;
        }

        return view('student/student_profile', [
            'name'=> $name, 
            'user'=>$user, 
            'treneri'=>$treneri,
            'personalCoach'=>$trener,
            'reservations'=> $reservations]);
    }
    public function destroy(){
        
        $user = $this->session->get("user");
        $name = $user->korime;
        $idRez= $this->request->getPost('id_rezervacije');
        $id = session('user')->idkor;
        
        $rezervacijaModal = new RezervacijaModel();
        $rezervacijaModal->delete($idRez);
        $reservations = $rezervacijaModal->get_all_data($id);

        $treneri = $rezervacijaModal->getCoaches();
        $zahtev = new ZahtevModel();
        $coachAccepted = $zahtev->where('status', 'rez')->get();
        if ($coachAccepted->getNumRows() > 0) {
            
            $coachAccepted = $coachAccepted->getResult();
            $coach = $coachAccepted[0]->trener_idkor;
            $trenerModel = new UserModel();
            $trener = $trenerModel
            ->join('trener', 'korisnik.idkor = trener.idkor')
            ->find($coach);
        } else {
            $trener = null;
        }

        return view('student/student_profile', [
            'name'=> $name, 
            'user'=>$user, 
            'treneri'=>$treneri,
            'personalCoach'=>$trener,
            'reservations'=> $reservations]);
    }
}