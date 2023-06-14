<?php

namespace App\Controllers;

class Member extends User
{
    public function index()
    {
        return view('member');
    }

    public function rezervacija()
    {
        // UBACITI U BAZU
        return view('rezervacija');
    }

}