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
        if(!$this->validate([
            // KOJA JE FUNKCIJA TRIM AKO SAM USPESNO REGISTROVALA KORISNIKA SA SVIM BELINAMA 
            // OKO SVIH POLJA GDE JE POSTAVLJENA REC TRIM???
            'name' =>'trim|required', //|regex_match[/regex/]', // prvo slovo velikim slovom
            'lastname' =>'trim|required', //|regex_match[/regex/]', // prvo slovo velikim slovom
            'username' =>'trim|required|is_unique[korisnik.korime]',
            // Koja je fora? prhihvata sve sifre bez obzira na to da li maju slova, 
            // bojeve i znake za interpunkciju
            'password' =>'trim|required|alpha_numeric_punct|min_length[8]|max_length[15]',
            'passconf' => 'trim|required|matches[password]', // ova provera radi
            'email' =>'trim|required|valid_email',
            //regex_match[/"^([a-zA-Z]|\d|\W|\w)+
            //                    @+([a-z]+\.+[a-z]{2,5}|  
            //                    [a-z]+\.+[a-z]+\.+[a-z]{2,3}|
            //                    [a-z]+\.+[a-z]+\.+[a-z]+\.+[a-z]{2,3})$/]"/,"i"',

                                // Milica"?/_.123.petrovic@gmail.com
                                // 555ilica"?/_.123.petrovic@gmail.com
                                // milica"?/_.123.petrovic@gmail.com
                                //                        @etf.bg.ac
                                //                        @etf.bg.ac.rs
            'tel' =>'trim|required',

            // ^(\d{10,11}|\d\S{10,11}|\d\s{10,13})$  // proba
            // ("^\\+?(\\(\\d+\\)|\\d+/?)[\\d ]+$");
            'user_type' =>'required'
        ])){
            // ako validacija ne vrati tacno, redirektujemo se na istu stranicu sa vec unetim podacima
            return redirect()->back()->withInput() // cuvaju se svi inputi koji su vec uneti
                ->with('errors', $this->validator->listErrors('list'));
        }
        
        $user = [
            'ime' =>$this->request->getPost('name'),
            'prezime' =>$this->request->getPost('lastname'),
            'korime' =>$this->request->getPost('username'),
            'pass' =>$this->request->getPost('password'),
            'passconf' =>$this->request->getPost('passconf'),
            'email' =>$this->request->getPost('email'),
            'brtel' =>$this->request->getPost('tel'),
            'tip' =>$this->request->getPost('user_type')
            
        ];
        $userModel = new UserModel();
        $userModel->insert($user);
        
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
