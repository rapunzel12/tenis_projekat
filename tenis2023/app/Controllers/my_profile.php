<?php

namespace App\Controllers;

use App\Models\RezervacijaModel;

class my_profile extends User
{
    public function index()
    {
        return view('my_profile');
    }


}