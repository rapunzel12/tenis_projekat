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

    // kreiranje grupe - skok na formu za kreiranje grupe
    public function createGroup()
    {
        return view('insert_group');
    }

    // kreiranje grupe - forma za kreiranje grupe
    public function insertGroup()
    {

    }
    // funkcija za prikazivanje pretrage to nazivu grupe
    public function searchGroups()
    {
        $groupModel = new GroupModel();
        $data['groups']=$groupModel->getGroups();
        return view('coach\search_groups', $data);
    }
    // rezultat pretrage - generisana tabela
    public function showGroup()
    {

        return view('coach\show_groups');
    }

}