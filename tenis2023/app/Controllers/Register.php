<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\UserModel;

class Register extends BaseController
{
    public function index()
    {
        return view('register');
    }

    public function register()
    {
        if(!$this->validate([
            // KOJA JE FUNKCIJA TRIM AKO SAM USPESNO REGISTROVALA KORISNIKA SA SVIM BELINAMA 
            // OKO SVIH POLJA GDE JE POSTAVLJENA REC TRIM???
            'name' =>'required', //|regex_match[/regex/]', // prvo slovo velikim slovom
            'lastname' =>'required', //|regex_match[/regex/]', // prvo slovo velikim slovom
            'username' =>'required|is_unique[korisnik.korime]',
            // Koja je fora? prhihvata sve sifre bez obzira na to da li maju slova, 
            // bojeve i znake za interpunkciju
            'password' =>'required|alpha_numeric_punct|min_length[8]|max_length[15]', // alpha_numeric radi, ali ne ono sto sam ja zelela
            'passconf' => 'trim|required|matches[password]', // ova provera radi
            'email' =>'trim|required|valid_email',
            'tel' =>'trim|required',

            // ^(\d{10,11}|\d\S{10,11}|\d\s{10,13})$  // proba
            // ("^\\+?(\\(\\d+\\)|\\d+/?)[\\d ]+$");
            'user_type' =>'required'
        ])){
            // ako validacija ne vrati tacno, redirektujemo se na istu stranicu sa vec unetim podacima
            return redirect()->back()->withInput() // cuvaju se svi inputi koji su vec uneti
                ->with('errors', $this->validator->listErrors('list'));
        }
        // pozvati funkciju trim od sting
        // 

        $user = [
            'ime' =>$this->request->getPost('name'),
            'prezime' =>$this->request->getPost('lastname'),
            'korime' =>$this->request->getPost('username'),
            'pass' =>$this->request->getPost('password'),
            'passconf' =>$this->request->getPost('passconf'),
            'email' =>$this->request->getPost('email'),
            'brtel' =>$this->request->getPost('tel'),
            'tip' =>$this->request->getPost('user_type'),
            // dodati status da je 0 = na cekanju, i posle to administrator dohvata te podatke
            // na ovaj nacin se upisuje u bazi 0, administartor mora da uradi update i da azurira to
            
        ];
        $userModel = new UserModel();
        $userModel->insert($user);
        if($user['tip']==1) 
        {
            $studentModel = new StudentModel();
            $studentModel->insert([
                'idkor' => $userModel->db->insertID(),
            ]);
        }
        
        if($user['tip']==1) 
        {
            $studentModel = new StudentModel();
            $studentModel->insert([
                'idkor' => $userModel->db->insertID(),
            ]);
        } 
        // uraditi za sve tipove korisnika
        // return view('register');
        // $this->session->set('korisnik', $user);
        
        //$this->session->set('user', $user);
        
        //if($user == 0) {
        //    return view('member');
        //}
        //if($user == 1) {
        //    return view('student');
        //}
        //if($user == 2) {
        //    return view('coach');
        //}
        //if($user == 3) {
        //    return view('admin');
        //}
        // return redirect()->to('User');

        return redirect()->to('Register/index')->with("msg", 'Success');
        // mozda REDIRECT???? return view('');
    }


    

}
