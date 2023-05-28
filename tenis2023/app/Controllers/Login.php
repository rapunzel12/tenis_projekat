<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }



    public function login()
    {
        // provere za login ako su polja prazna i prelazak na sledecu stranicu
        if (!$this->validate([
            'username' =>'required|if_exist', // matches[korisnik.korime,korime,{$korime}]', // ne radi
            'password' =>'required|if_exist', // matches[korisnik.pass] // ne radi
            'user_type' =>'required'
        ])) {
            return redirect()->back()->withInput() // cuvaju se svi inputi koji su vec uneti
                ->with('errors', $this->validator->listErrors('list'));
        }

        // podaci navedeni za svaki slucaj
        $user = [
            'korime' =>$this->request->getPost('username'),
            'pass' =>$this->request->getPost('password'),
            'tip' =>$this->request->getPost('user_type')
        ];
        // dohvatanje modela
        $userModel = new UserModel();
        $user = $userModel->find($this->request->getVar('idkor'));
        if ($user == null) {  // provera da li postoji korisnik kojeg smo zadali, NESTO NE RADI, DORADITI
            // prihvata sve podatke iako mozda takvi korisnici ne postoje u bazi
            return redirect()->back()->withInput() // cuvaju se svi inputi koji su vec uneti
                ->with('errors', $this->validator->listErrors('list'));
        } 
        
        $session = \Config\Services::session(); 
        $user = $this->session->set('user', $user);
        $user = $this->session->get('user', $user);
        if ($session->has('user')) {
            return redirect()->to('User');
        }

        //    if($user == 0) {
        //    $this->session->set('member', $user);
        //        return view('member');
        //        return redirect()->to('User'); // DA LI JE POTREBNO NAPRAVITI MODEL ZA MEMBER, STUDENT, COACH, ADMIN?????
        //    }
        //    if($user == 1) {
        //    $this->session->set('student', $user);
        //        return view('student');
        //    }
        //    if($user == 2) {
        //    $this->session->set('coach', $user);
        //        return view('coach');
        //    }
        //   if($user == 3) {
        //    $this->session->set('admin', $user);
        //        return view('admin');
        //    }
        // return redirect()->to('User');
        // MOZDA REDIRECT ???    return view('');
    }

}