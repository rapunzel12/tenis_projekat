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
                
                
                

                echo "<h2 class='text-center'>Zahtevi učenika</h2>";    
                
                if (!empty($zahteviUcenika))
                {
                    echo form_open('zahtevi/zahteviUcenika', ['method' =>'get']);        
                    $status = ['' => "Svi", 'cek' => "Na čekanju", 'otk' => "Odbijen", 'slo' => 'Prihvaćen'];        
                    echo form_label('Filter status:', 'status');
                    echo form_dropdown('status', $status, $_GET['status']??"");
                    echo form_submit('search', 'Prikaži', ['class'=> 'btn btn-primary']);
                    echo form_close();
                    echo "<br><br>";


                    echo "<table class='table table-bordered table-hover'>";
                    echo "<thead class='thead-light bg-warning'>
                        <tr>
                            <th class='text-center'>Učenik</th>                
                            <th class='text-center'>Status</th>
                            <th class='text-center'>Prihvati</th>
                            <th class='text-center'>Odbij</th>
                            <th class='text-center'>Obriši</th>
                        </tr>
                        </thead>";       
                    

                    foreach ($zahteviUcenika as $zahtev) {        
                
                        if (isset($_GET['status']) and !empty($_GET['status']) and $zahtev->status != $_GET['status']) continue;
                            echo "<tr>";                
                            
                            echo "<td>" . img('assets/img/users/'.$zahtev->poster, false, ['width' => '40', 'class' => 'center img-fluid']).' '.$zahtev->ime." ".$zahtev->prezime."</td>";
                            
                            switch ($zahtev->status) {
                                case 'cek':                                    
                                    echo "<td class='text-center'>Na čekanju</td>";
                                    echo "<td class='text-center'>".anchor('zahtevi/zahteviUcenikaUpdate/accept/'.$zahtev->idzahtev, '<i class="fa-solid fa-square-check fa-2xl" style="color: #098202;" title="Prihvati"></i>')."</td>";
                                    echo "<td class='text-center'>".anchor('zahtevi/zahteviUcenikaUpdate/cancel/'.$zahtev->idzahtev, '<i class="fa-solid fa-square-xmark fa-2xl" style="color: #ad0123;" title="Odbij"></i>')."</td>";
                                    echo "<td class='text-center'><i class=\"fa-solid fa-trash-can fa-2xl\" style=\"color: #f1f1f1;\" title=\"Obriši\"></i></td>";
                                    break;
                                case 'otk':                                    
                                    echo "<td class='text-center'>Odbijen</td>";
                                    echo "<td class='text-center'><i class=\"fa-solid fa-square-check fa-2xl\" style=\"color: #f1f1f1;\" title=\"Prihvati\"></i></td>";
                                    echo "<td class='text-center'><i class=\"fa-solid fa-square-xmark fa-2xl\" style=\"color: #f1f1f1;\" title=\"Odbij\"></i></td>";
                                    echo "<td class='text-center'>".anchor('zahtevi/zahteviUcenikaUpdate/del/'.$zahtev->idzahtev, '<i class="fa-solid fa-trash-can fa-2xl" style="color: #ad0123;" title="Obriši"></i>')."</td>";
                                    break;
                                case 'slo':                                    
                                    echo "<td class='text-center'>Prihvaćen</td>";
                                    echo "<td class='text-center'><i class=\"fa-solid fa-square-check fa-2xl\" style=\"color: #f1f1f1;\" title=\"Prihvati\"></i></td>";                                
                                    echo "<td class='text-center'><i class=\"fa-solid fa-square-xmark fa-2xl\" style=\"color: #f1f1f1;\" title=\"Odbij\"></i></td>";
                                    echo "<td class='text-center'><i class=\"fa-solid fa-trash-can fa-2xl\" style=\"color: #f1f1f1;\" title=\"Obriši\"></i></td>";
                                    break;
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
