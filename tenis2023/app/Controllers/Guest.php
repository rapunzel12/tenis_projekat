<?php

namespace App\Controllers;

use App\Filters\AdminFilter;
use App\Models\AdminModel;
use App\Models\CoachModel;
use App\Models\MemberModel;
use App\Models\StudentModel;
use App\Models\TariffModel;
use App\Models\UserModel;


class Guest extends Main
{
   
    public function showRegistration(){
        return view('register');
    }
    public function register()
    {
        if(!$this->validate([
            'name' =>['label'=>'Ime', 'rules'=> 'required|alpha|min_length[3]|max_length[25]'], //|regex_match[/regex/]', // prvo slovo velikim slovom
            'lastname' =>['label'=>'Prezime', 'rules' => 'required|alpha_space|min_length[3]|max_length[35]'], //|regex_match[/regex/]', // prvo slovo velikim slovom
            'username' =>['label'=>'Korisničko ime', 'rules' => 'required|is_unique[korisnik.korime]|min_length[3]|max_length[15]'],
            'password' =>['label'=>'Šifra', 'rules' => 'required|min_length[8]|max_length[15]'], 
            'passconf' => ['label'=>'Ponovljena šifra', 'rules' => 'required|matches[password]'],
            'email' =>['label'=>'E-mail', 'rules' => 'required|valid_email'],
            'tel' =>['label'=>'Telefon', 'rules' => 'required|integer|max_length[15]'],
            'user_type' =>['label'=>'Tip korisnika', 'rules' => 'required'],
            'poster' => ['label'=>'Fotografija', 'rules' => 
                'uploaded[poster]',
                'max_size[poster,1024]',
                'mime_in[poster,image/png,image/jpeg, image/jpg]'
            ],
        ])){
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
            'tip' =>((int)$this->request->getPost('user_type')),
            'status' => '0' 
        ];

        // var_dump($user); // provera da li kupi sve podatke pre upisa u bazu
        
        $userModel = new UserModel();
        $userModel->insert($user);

        $userId=$userModel->db->insertID();
        // return;


        if($user['tip']==1) 
        {
            $studentModel = new StudentModel();
            $studentModel->insert([
                'idkor' => $userId,
            ]);
        }
        
        if($user['tip']==2) 
        {
            $coachModel = new CoachModel();
            $coachModel->insert([
                'idkor' => $userId,
                'opis' => $this->request->getPost('description'),
            ]);
        } 

        if($user['tip']==3) 
        {
            $adminModel = new AdminModel();
            $adminModel->insert([
                'idkor' => $userId,
                'opis' => $this->request->getPost('description'),
            ]);
        } 
        // nakon upisivanja korisnika u bazu moram da uradi update i da dodam sliku koja ce autoinkrementom da dobije svoj naziv
        $poster = $this->request->getFile('poster');
        $posterName = $userId. ".".$poster->getExtension();; 
        $poster->move("../public/assets/img/users", $posterName, true);

        $user = [
            // 'tip' => 'user_type', - na ovaj nacin bih ponovo prebrisala tip korisnika i upisivala se 0. 
            'poster'=> $posterName,
        ];
        $userModel->update($userId, $user);

        return redirect()->to('Guest/showRegistration')->with("msg", 'Uspešno ste poslali podatke za registraciju!');
    }


    public function viewLogin()
    {
        return view('login');
    }



    public function login()
    {
        // provere za login ako su polja prazna i prelazak na sledecu stranicu
        if (!$this->validate([
            'username' =>['label'=>'Korisničko ime', 'rules'=> 'required|if_exist'], 
            'password' =>['label'=>'Šifra', 'rules'=> 'required|if_exist'], 
            'user_type' =>['label'=>'Tip korisnika', 'rules'=> 'required']
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
        if ($users == null || count($users)==0) {  // provera da li postoji korisnik kojeg smo zadali, 
            // prihvata sve podatke iako mozda takvi korisnici ne postoje u bazi
            return redirect()->back()->withInput()
                ->with('errors', "Korisnik ne postoji." );
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
