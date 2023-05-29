<?php

namespace App\Controllers;

class Admin extends User
{
    public function index()
    {
        echo "Admin";
        //$name = "moj username";
        // $name = $this->session->get('user')->korime;
        //return view('user', ['name'=> $name]);
    }

}