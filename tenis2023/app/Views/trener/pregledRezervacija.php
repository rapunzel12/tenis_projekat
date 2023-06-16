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
        
        

        echo "<h2 class='text-center'>Zakazani termini sa učenicima i rekreativcima</h2>";    
        
        if (!empty($rezervacije))
        {
            echo form_open('Coach/pregledRezervacija', ['method' =>'get']);            
            
            $status = ['' => '', 'rez' => 'Rezervisan', 'otk' => 'Otkazan'];        
            echo form_label('Filter status:', 'status');
            echo form_dropdown('status', $status, $_GET['status']??"");
            echo form_submit('search', 'Prikaži', ['class'=> 'btn btn-primary']);
            echo "<a href='pregledRezervacija' class='btn btn-primary'>Reset</a>";
            echo form_close();
            echo "<br><br>";


            echo "<table class='table table-bordered table-hover'>";
            echo "<thead class='thead-light bg-warning'>
                <tr>
                    <th class='text-center'>Datum</th>
                    <th class='text-center'>Vreme</th>                    
                    <th class='text-center'>Ime i prezime</th>            
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
                    echo "<td>".img('assets/img/users/'.$rezervacija->poster, false, ['width' => '40', 'class' => 'center img-fluid'])." ".$rezervacija->ime." ".$rezervacija->prezime."</td>";                
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
                    echo "<td class='text-center'>Teren br".$rezervacija->idteren." ".$rezervacija->tippod."</td>";  
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
                        echo "<td class='text-center'>".anchor('Coach/obrisiRezervaciju/'.$rezervacija->idrez, '<i class="fa-solid fa-trash-can fa-2xl" style="color: #ad0123;" title="Obriši"></i>')."</td>";
                    }
                    else {
                        echo "<td class='text-center'>".anchor('Coach/otkaziRezervaciju/'.$rezervacija->idrez, '<i class="fa-solid fa-square-xmark fa-2xl" style="color: ##ffc800;" title="Otkaži"></i>')."</td>";
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

<?= $this->endSection() ?>