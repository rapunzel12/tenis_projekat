<?php

$this->extend('layout');
$this->section('content');
?>
<?= view("trener/trener_header.php")?>
<section class="page-section">
<div class="container">
    <?php 
        $session = \Config\Services::session();
        if ($session->getFlashdata('msg')){
            echo "<div class='alert alert-success' role='alert'>";
            echo $session->getFlashdata('msg');
            echo "</div>";
        }
        if ($session->getFlashdata('errors')){
            echo "<div class='alert alert-danger' role='alert'>";
            echo $session->getFlashdata('errors');
            echo "</div>";
        }
        
        
        
    ?>
        
            
        <?php 
        helper('html');    
        echo "<div class='row gy-4'><h2 class='text-center'>Pregled grupa</h2>";
            if (!empty($grupe)) {
                foreach ($grupe as $grupa) {        
                    
                        echo "<div class='col-xl-6'>";                        
                            echo "<div class='bg-light border border-warning rounded p-3'>";
                                echo "<p class='text-black-50 mb-0' style='float: left;'>NAZIV GRUPE</p><p class='text-end mb-0'>".anchor('grupa/delGrupa/'.$grupa->idgru, '<i class="fa-solid fa-square-xmark fa-2xl" style="color: #ad0123;" title="Obriši grupu"></i>') . "</p>";                        

                                echo "<h3 class='text-warning'>".$grupa->naziv."</h3>"; 
                                
                                
                                foreach ($clanoviGrupe as $clanGrupe) { 
                                    if ($grupa->idgru == $clanGrupe->grupa_idgru)
                                    {                                                                
                                        echo img('assets/img/users/'.$clanGrupe->poster, false, ['alt' => $clanGrupe->prezime, 'width' => '50', 'class' => 'rounded-circle img-fluid']);
                                        echo "  ".$clanGrupe->ime. " ".$clanGrupe->prezime."  ";
                                    } 
                                    
                                }           
                            echo "</div>";
                        echo "</div>";
                    
                }
                echo "</div>";     
            } else echo "Nema grupa.";
            echo "<br>";
            echo "<div class='d-grid col-6 mx-auto'>";                
                echo anchor('grupa/formaAddGrupa', 'Kreiraj novu grupu', ['class'=> 'btn btn-primary']);
            echo "</div>";
        
        ?>
    </div>
        </section>
<?= $this->endSection() ?>