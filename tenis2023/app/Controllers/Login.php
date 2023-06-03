<?php

namespace App\Controllers;

use App\Models\UserModel;

use function PHPUnit\Framework\countOf;

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
            'username' =>'required|if_exist', 
            'password' =>'required|if_exist', 
            'user_type' =>'required'
        ])) {
            return redirect()->back()->withInput() // cuvaju se svi inputi koji su vec uneti
                ->with('errors', $this->validator->listErrors('list'));
        }

        $user = [
            'korime' =>$this->request->getPost('username'),
            'pass' =>$this->request->getPost('password'),
            'tip' =>$this->request->getPost('user_type'),
            'status'=>'1'
        ];
        // dohvatanje modela
        $userModel = new UserModel();
        $users = $userModel->where($user)->get()->getResult();
        // var_dump($user[0]);
        if ($users == null || count($users)==0) {  // provera da li postoji korisnik kojeg smo zadali, NESTO NE RADI, DORADITI
            // prihvata sve podatke iako mozda takvi korisnici ne postoje u bazi
            return redirect()->back()->withInput() // cuvaju se svi inputi koji su vec uneti
                ->with('errors', "Korisnik ne postoji" );
        } 
        
        $user = $users[0];
        $session = \Config\Services::session(); 

        $this->session->set('user', $user);  // prvi user je sacuvan u sesiji, na to se odnosi 'user'
        
        if($user->tip == 0) {
        
            return redirect()->to('Member'); 
        }
        if($user->tip == 1) {
        
            return redirect()->to('Student');
        }

        if($user->tip == 2) {
        
            return redirect()->to('Coach'); 
        }
        if($user->tip == 3) {
        
            return redirect()->to('Admin');
        }
        
    }

}