

<!-- view ucenika  koji se poziva nakon registracije/logina -->
<?php

use App\Controllers\Student;

$this->extend('layout');
$this->section('content');

?>
<div class="masthead container">
    <div class="row">


        <div class="col-sm-6">
            <br>

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br> 
            <!-- mislim da ovo treba da bude section user view-a   class="img-thumbnail"-->
           
            Dobrodošli, <?= $name ?> 
            <br>
           
            <img class='user-poster' 
                src="<?= base_url('assets/img/users/' . $user->poster) ?>"  
                
                alt="..." width="200px">  
            
            
            <?= anchor("Student/searchSheduledTerm", "Pretraga zakazanih termina"); ?>
    </div>
</div>
   
<?php
$this->endSection();
?>