<?php
$this->extend('layout');
$this->section('content');
?>

<?= helper('html'); ?>
<?= view("trener/trener_header.php")?>
<div class="container">    
        <h2 class='text-center'>Treneri</h2>
        <?php 
            echo "<div class='row g-4'>";
            if (!empty($treneri))
            foreach ($treneri as $trener) {   

                
                    echo "<div class='col-sm-12 col-md-4'>";
                        echo "<div class='bg-light border border-warning rounded text-center p-3'>";
                            echo img('assets/img/users/'.$trener->poster, false, ['alt' => $trener->prezime, 'width' => '200', 'class' => 'rounded-circle img-fluid border border-5"></']);                                                   
                            echo "<h5><label class='text-warning mt-5'></label> ".$trener->ime . " ".$trener->prezime;
                            echo "</h5><p><label class='text-warning'>Telefon:</label> ".$trener->brtel;
                            echo "</p><p><label class='text-warning'>E-mail:</label> ".$trener->email;
                            /*
                            switch ($trener->status) {
                                case 'slo':
                                    $trener->status= "Slobodan";
                                    break;                        
                                case 'cek':
                                    $trener->status= "Na čekanju";
                                    break;
                            }               
                            echo "<p><label class='text-warning'>Status:</label> ".$trener->status."</p>";  
                            */
                            echo "</p><p><label class='text-warning'>Opis:</label> ".$trener->opis;
                            echo "</p></div>";                   
                        echo "</div>";
            }
            echo "</div>";  
            

            
        ?>
    </div>
</div>
<?= $this->endSection() ?>