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
        if(!$this->validate(['username'=>'required', 'password'=>'required'])){
          $errorMsg=$this->validator->listErrors();
          return view('login', ['error'=>$errorMsg]);
        }
        // provera da li postoji autor koji smo zadali
        // dohvatanje modela
        $model = new UserModel();
        $user = $model->find($this->request->getVar('idkor'));
            if($user == null ) {
                return view('login', ['error' => 'Korisnik ne postoji']);
            }
            // if($user->pass != $this->request->getVar('pass')){
               //  return view('login', ['error' => 'Pogresna sifra!']);
            // } // nesto ne radi, mora da se doradi
        $this->session->set('user', $user);
        return redirect()->to('User');
        // MOZDA REDIRECT ???    return view('');
    }


}