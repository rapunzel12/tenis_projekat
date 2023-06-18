<!-- view admina koji se poziva nakon logina -->
<?php

$this->extend('layout');
// this->section('user');
$this->section('content');

?>
<div class="masthead container">
    <div class="row">
        
        
    <?= view("admin/admin_menu")?>


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
            
            
        </div>
    </div>
</div>
   
<?php
$this->endSection();
?>