<?php

$this->extend('layout');
$this->section('content');
?>
<style>
    .dropdown {
      display: none;
    }
  </style>
<?= view("trener/trener_header.php")?>
<h2 class='text-center'>Rezervisanje termina</h2>
<div class="container"> 
    <div class='row g-4'>
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
              
              echo form_open("coach/addRezervisanjeTermina", ['method' => 'post']);
              echo form_label('Teren: ', 'teren');
              echo form_dropdown('teren', $tereni);
              echo '<br><br>';
              echo form_label('Tip treninga:  ', 'tip');        
              echo form_radio('tip', 'individualni', '');
              echo form_label('individualni', 'tip');        
              echo form_radio('tip', 'grupni', '');
              echo form_label('grupni', 'tip');
              echo '<br>';
              
              // lista ucenika ili grupa
              echo form_dropdown('ucenik', $ucenici, '', ['id'=>'ddUcenici', 'class'=>'dropdown form-select']);              
              echo form_dropdown('grupa', $grupe, '', ['id'=>'ddGrupe', 'class'=>'dropdown form-select']);

              echo '<br>';
              echo form_label('Broj reketa: ', 'brreketa');              
              echo form_input('brreketa', '0', '','number');
              echo '<br><br>';
              echo form_label('Termin: ', 'datum');
              echo form_input('datum', '','', 'datetime-local');
              echo '<br><br>';
              
              echo "<div class='d-grid col-6 mx-auto'>";                
                
            
              echo form_submit('rezervisi', 'Rezerviši termin', ['class'=> 'btn btn-primary']);
              echo "</div>";
              echo form_close();
              


      ?>
      </div>
</div>

<script>    
    const grupni = document.querySelector('input[value="grupni"]');
    const individualni = document.querySelector('input[value="individualni"]');
    const ddGrupe = document.getElementById('ddGrupe');
    const ddUcenici = document.getElementById('ddUcenici');

    // Add event listeners to the radio buttons
    grupni.addEventListener('change', showDropdown);
    individualni.addEventListener('change', showDropdown);

    
    function showDropdown() {
      if (grupni.checked) {
        ddGrupe.style.display = 'block';
        ddUcenici.style.display = 'none';
      } else if (individualni.checked) {
        ddGrupe.style.display = 'none';
        ddUcenici.style.display = 'block';
      } else {
        ddGrupe.style.display = 'none';
        ddUcenici.style.display = 'none';
      }
    }
  </script>
<?= $this->endSection() ?>


