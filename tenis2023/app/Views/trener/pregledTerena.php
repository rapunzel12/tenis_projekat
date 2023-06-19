<?php
$this->extend('layout');
$this->section('content');
?>
<?= helper('html'); ?>
<section class="page-section">
<h2 class='text-center'>Pregled svih terena</h2>
<div class="container"> 
    <div class='row g-4 mt-4'>
        <?php            
                $i = 0;
                if (!empty($tereni))
                foreach ($tereni as $teren) {        
                    echo "<div class='col-sm-12 col-md-6 col-lg-4'>";
                    echo "<div class='bg-light border border-warning rounded text-center p-3'>";
                    echo img('assets/img/slike/'.$teren->poster_vertical, false, ['alt' => 'teren', 'width' => '250', 'class' => 'img-fluid border border-5"></']);                                                   
                    echo "<p class='text-warning'>Teren ".++$i . "</p>";
                    
                    switch ($teren->tippod) {
                        case 'S':
                            echo "Šljaka";
                            break;
                        case 'T':
                            echo "Trava";
                            break;
                        case 'B':
                            echo "Beton";
                            break;
                    }
                    
                    
                    echo "<p class='text-secondary'>".$teren->opis . "</p>";                    
                    
                    echo "</div>";    
                    echo "</div>";
                }
        ?>
</div>
</div>
</section>
<?= $this->endSection() ?>