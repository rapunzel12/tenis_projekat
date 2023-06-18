<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends Main
{

    public function index()
    {
        // $name = "moj username"; // radi 
        $user = $this->session->get("user");
        $name = $user->korime; 
        if($user->tip == 0) {
        
            return view('my', ['name'=> $name, 'user'=>$user]);
        }
        if($user->tip == 1) {
        
            return view('student', ['name'=> $name, 'user'=>$user]);
        }
        if($user->tip == 2) {
        
            return view('coach', ['name'=> $name, 'user'=>$user]);
        }

        if($user->tip == 3) {
    
            return view('admin', ['name'=> $name, 'user'=>$user]);
        }
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to("");
    }
   
    /*public function showImage($idkor, $poster)
    {
        $user = new UserModel();
        $users = $user->select($idkor, ["poster"=>$poster]);
        return view('admin', ['users'=>$users]);
    }
*/
}