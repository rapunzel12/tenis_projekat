<?php
    $this->extend('layout');
    $this->section('content');
?>
<section class="page-section">
<div class="container">
    <div class="row">
    <?php 
        $session = \Config\Services::session();
        if ($session->getFlashdata('msg')){
            echo "<div class='alert alert-success' role='alert'>";
            echo $session->getFlashdata('msg');
            echo "</div>";
        }      
        
        

        echo "<h2 class='text-center'>Zakazani grupni termini</h2>";    
        
        if (!empty($rezervacije))
        {
            echo form_open('Coach/pregledRezervacijaGrupni', ['method' =>'get']);            
            
            $status = ['' => '', 'rez' => 'Rezervisan', 'otk' => 'Otkazan'];        
            echo form_label('Filter status:', 'status');
            echo form_dropdown('status', $status, $_GET['status']??"");
            echo form_submit('search', 'Prikaži', ['class'=> 'btn btn-primary']);
            if (isset($_GET['status'])) echo "<a href='pregledRezervacijaGrupni' class='btn btn-primary'>Reset</a>";
            echo form_close();
            echo "<br><br>";


            echo "<table class='table table-bordered table-hover'>";
            echo "<thead class='thead-light bg-warning'>
                <tr>
                    <th class='text-center'>Datum</th>
                    <th class='text-center'>Vreme</th>                    
                    <th class='text-center'>Naziv grupe</th>            
                    <th class='text-center'>Broj reketa</th> 
                    <th class='text-center'>Teren</th>                   
                    <th class='text-center'>Status</th>
                    <th class='text-center'>Otkaži</th>
                    <th class='text-center'>Obriši</th>
                </tr>
                </thead>";       
            

            foreach ($rezervacije as $rezervacija) {        
        
                if (isset($_GET['status']) and !empty($_GET['status']) and $rezervacija->status != $_GET['status']) continue;
                    echo "<tr>";
                    echo "<td>".$rezervacija->datum."</td>";
                    echo "<td>".$rezervacija->vreme."</td>";                   
                    echo "<td class='text-center'>".$rezervacija->naziv."</td>";
                    
                    echo "<td class='text-center'>".$rezervacija->brrek."</td>";                    
                    switch ($rezervacija->tippod) {
                        case 'S':
                            $rezervacija->tippod = "Šljaka";
                            break;
                        case 'T':
                            $rezervacija->tippod = "Trava";
                            break;
                        case 'B':
                            $rezervacija->tippod = "Beton";
                            break;
                    }               
                    echo "<td class='text-center'>Teren ".$rezervacija->tippod."</td>";  
                    switch ($rezervacija->status) {
                        case 'slo':
                            $rezervacija->status= "Slobodan";
                            break;
                        case 'rez':
                            $rezervacija->status= "Rezervisan";
                            break;
                        case 'odb':
                            $rezervacija->status= "Odbijen";
                            break;
                        case 'otk':
                            $rezervacija->status= "Otkazan";
                            break;
                        case 'cek':
                            $rezervacija->status= "Na čekanju";
                            break;
                    }               
                    echo "<td class='text-center'>".$rezervacija->status."</td>";              
                    if ($rezervacija->status == 'Otkazan') 
                    {
                        echo "<td class='text-center'><i class=\"fa-solid fa-square-xmark fa-2xl\" style=\"color: #f1f1f1;\" title=\"Otkaži\"></i></td>";
                        echo "<td class='text-center'>".anchor('Coach/rezervacijaGrupa/obrisi/'.$rezervacija->idrez, '<i class="fa-solid fa-trash-can fa-2xl" style="color: #ad0123;" title="Obriši"></i>')."</td>";
                    }
                    else {
                        echo "<td class='text-center'>".anchor('Coach/rezervacijaGrupa/otkazi/'.$rezervacija->idrez, '<i class="fa-solid fa-square-xmark fa-2xl" style="color: ##ffc800;" title="Otkaži"></i>')."</td>";
                        echo "<td class='text-center'><i class=\"fa-solid fa-trash-can fa-2xl\" style=\"color: #f1f1f1;\" title=\"Obriši\"></i></td>";
                    }   
                                    
                    
                echo "</tr>";
            }         
        }
        else echo "Nema zakazanih termina.";
        echo "</table>";
    ?>
    </div>
</div>
</section>
<?= $this->endSection() ?>