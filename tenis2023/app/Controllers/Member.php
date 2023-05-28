<?php

namespace App\Controllers;

class Member extends User
{
    public function index()
    {
        echo "Member";
        //$name = "moj username";
        // $name = $this->session->get('user')->korime;
        //return view('user', ['name'=> $name]);
    }

}