<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CoachModel;
use App\Models\MemberModel;
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
            'name' =>'required|min_length[3]|max_length[25]', //|regex_match[/regex/]', // prvo slovo velikim slovom
            'lastname' =>'required|min_length[3]|max_length[35]', //|regex_match[/regex/]', // prvo slovo velikim slovom
            'username' =>'required|is_unique[korisnik.korime]|min_length[3]|max_length[15]',
            // Koja je fora? prhihvata sve sifre bez obzira na to da li maju slova, 
            // bojeve i znake za interpunkciju
            'password' =>'required|alpha_numeric_punct|min_length[8]|max_length[15]', // alpha_numeric radi, ali ne ono sto sam ja zelela
            'passconf' => 'required|matches[password]', // ova provera radi
            'email' =>'required|valid_email',
            'tel' =>'required|integer|max_length[15]',
            'user_type' =>'required',
            'poster' => [
                'uploaded[poster]',
                'max_size[poster,1024]',
                'mime_in[poster,image/png,image/jpeg, image/jpg]'
            ],
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
            'tip' =>((int)$this->request->getPost('user_type')),
            'status' => '0' // ne radi ni ovako
            // dodati status da je 0 = na cekanju, i posle to administrator dohvata te podatke
            // na ovaj nacin se upisuje u bazi 0, administartor mora da uradi update i da azurira to
            
        ];

        var_dump($user);
        
        $userModel = new UserModel();
        $userModel->insert($user);

        $userId=$userModel->db->insertID();
        // return;


        if($user['tip']==0) 
        {
            $memberModel = new MemberModel();
            $memberModel->insert([
                'idkor' => $userId,
            ]);
        }

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
            ]);
        } 

        if($user['tip']==3) 
        {
            $adminModel = new AdminModel();
            $adminModel->insert([
                'idkor' => $userId,
            ]);
        } 
        // nakon upisivanja korisnika u bazu moram da uradi update i da dodam sliku koja ce autoinkrementom da dobije svoj naziv
        // $userModel = new UserModel();
        // visak $userId = $userModel->insert($user); // dohvatam dodeljeni Id useru te se sada slikama moze dodati odgovarajuci broj koji korespondira sa id-em

        $poster = $this->request->getFile('poster');
        $posterName = $userId. ".".$poster->getExtension();; // trebalo bi da se proveri koja je ekstenzija i da se konkatenira sa njom
        $poster->move("../public/assets/img/users", $posterName, true);

        $user = [
            'tip' => 'user_type',
            'poster'=> $posterName,
        ];

        $userModel->update($userId, $user);

        
        
        
        return redirect()->to('Register/index')->with("msg", 'Success');
    }


    

}
