<?php

namespace App\Controllers;

class Student extends User
{
    public function searchSheduledTerm(){
        return view("student/search_sheduled_term");
    }

}
