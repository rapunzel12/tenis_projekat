<?php

namespace App\Controllers;

use App\Models\GroupModel;

class Coach extends User
{
    public function index()
    {
        // echo "Coach";
        return view('coach');
    }

}