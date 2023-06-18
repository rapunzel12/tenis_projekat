<?php




// override core en language system validation or define your own en language validation message
return [
// spisak pravila koja ja hocu da koristim napisati ovde

    // Rule Messages
    'alpha'                 => ' {field} može da sadrži samo znakove alfabeta.',
    'alpha_space'           => ' {field} može da sadrži samo znakove alfabeta i razmak.',
    'required'              => ' {field} je obavezno polje.',
    'valid_email'           => ' {field} mora da sadrži validnu e-mail adresu.',
    'integer'               => ' {field} mora da sadrži brojeve.',
    'is_unique'             => ' {field} mora da bude jedinstveno.',
    'max_length'            => ' {field} može biti maksimalne dužine od {param} karaktera.',
    'min_length'            => ' {field} može biti najkraće dužine od {param} karaktera.',
    'matches'               => ' {field} se ne poklapa sa poljem {param}.',

     // Files
     'uploaded' => '{field} nije validan fajl.',
     'max_size' => ' {field} je prevelika.',
     'is_image' => '{field} nije validna, uploadujte fajl slike.',
     'mime_in'  => '{field} nema adekvatnu ekstenziju/ nije u odgovarajućem formatu.', 
];
