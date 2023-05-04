<?php

namespace App\Controllers;

use App\Models\UserModel;

class Register extends BaseController
{
    public function index()
    {
        return view('register');
    }

    public function register()
    {
        $userModel = new UserModel();
        
        $user = [
            'ime' =>$this->request->getPost('name'),
            'prezime' =>$this->request->getPost('lastname'),
            'korime' =>$this->request->getPost('username'),
            'pass' =>$this->request->getPost('password'),
            'email' =>$this->request->getPost('email'),
            'brtel' =>$this->request->getPost('tel'),
            // Kako resiti user_type?? 'user_type' =>$this->request->getPost('user_type'),
        ];
        
        $userModel->insert($user);
        
        // return view('register');
        // $this->session->set('korisnik', $user);
        $this->session->set('user', $user);
        return redirect()->to('User');
        // mozda REDIRECT???? return view('');
    }


    

}
