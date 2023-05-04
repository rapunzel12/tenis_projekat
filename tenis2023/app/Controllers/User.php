<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        // echo "Ulogovan";
        $name = "moj username";
        // $name = $this->session->get('user')->korime;
        return view('user', ['name'=> $name]);
    }

}