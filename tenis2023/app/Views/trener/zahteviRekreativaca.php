<?php
    $this->extend('layout');
    $this->section('content');
?>
<?= view("trener/trener_header.php")?>
<div class="container">
    <div class="row">
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
        
        
        

        echo "<h2 class='text-center'>Zahtevi rekreativaca</h2>";    
        
        if (!empty($zahteviRekreativaca))
        {
            echo form_open('zahtevi/zahteviRekreativaca', ['method' =>'get']);                
            
            $status = ['' => '', 'rez' => 'Rezervisan', 'otk' => "Otkazan", 'cek' => "Na čekanju"];        
            echo form_label('Filter status:', 'status');
            echo form_dropdown('status', $status, $_GET['status']??"");
            echo form_submit('search', 'Prikaži', ['class'=> 'btn btn-primary']);
            if (isset($_GET['status'])) echo "<a href='zahteviRekreativaca' class='btn btn-primary'>Reset</a>";
            echo form_close();
            echo "<br><br>";


            echo "<table class='table table-bordered table-hover'>";
            echo "<thead class='thead-light bg-warning'>
                <tr>
                    <th class='text-center'>Datum</th>
                    <th class='text-center'>Vreme</th>
                    <th class='text-center'>Ime rekreativca</th>            
                    <th class='text-center'>Broj reketa</th>
                    <th class='text-center'>Cena</th>
                    <th class='text-center'>Teren</th>
                    <th class='text-center'>Status</th>
                    <th class='text-center'>Otkaži</th>
                    <th class='text-center'>Obriši</th>
                </tr>
                </thead>";       
            

            foreach ($zahteviRekreativaca as $zahtev) {        
        
                if (isset($_GET['status']) and !empty($_GET['status']) and $zahtev->status != $_GET['status']) continue;
                    echo "<tr>";
                    echo "<td>".$zahtev->datum."</td>";
                    echo "<td>".$zahtev->vreme."</td>";    
                    echo "<td>".$zahtev->ime." ".$zahtev->prezime."</td>";                
                    echo "<td class='text-center'>".$zahtev->brrek."</td>";
                    echo "<td class='text-center'>".$zahtev->cena."</td>";
                    switch ($zahtev->tippod) {
                        case 'S':
                            $zahtev->tippod = "Šljaka";
                            break;
                        case 'T':
                            $zahtev->tippod = "Trava";
                            break;
                        case 'B':
                            $zahtev->tippod = "Beton";
                            break;
                    }               
                    echo "<td class='text-center'>Teren ".$zahtev->tippod."</td>";  
                    switch ($zahtev->status) {
                        case 'slo':
                            $zahtev->status= "Slobodan";
                            break;
                        case 'rez':
                            $zahtev->status= "Rezervisan";
                            break;
                        case 'odb':
                            $zahtev->status= "Odbijen";
                            break;
                        case 'otk':
                            $zahtev->status= "Otkazan";
                            break;
                        case 'cek':
                            $zahtev->status= "Na čekanju";
                            break;
                    }               
                    echo "<td class='text-center'>".$zahtev->status."</td>";                
                    
                    if ($zahtev->status == 'Otkazan') 
                    {
                        echo "<td class='text-center'><i class=\"fa-solid fa-square-xmark fa-2xl\" style=\"color: #f1f1f1;\" title=\"Otkaži\"></i></td>";
                        echo "<td class='text-center'>".anchor('zahtevi/obrisiZahtevRekreativca/'.$zahtev->idrez, '<i class="fa-solid fa-trash-can fa-2xl" style="color: #ad0123;" title="Obriši"></i>')."</td>";
                    }
                    else {
                        echo "<td class='text-center'>".anchor('zahtevi/otkaziZahtevRekreativca/'.$zahtev->idrez, '<i class="fa-solid fa-square-xmark fa-2xl" style="color: ##ffc800;" title="Otkaži"></i>')."</td>";
                        echo "<td class='text-center'><i class=\"fa-solid fa-trash-can fa-2xl\" style=\"color: #f1f1f1;\" title=\"Obriši\"></i></td>";
                    }                
                    
                echo "</tr>";
            }         
        }
        else echo "Nema zahteva.";
        echo "</table>";
    ?>
    </div>
</div>

<?= $this->endSection() ?>