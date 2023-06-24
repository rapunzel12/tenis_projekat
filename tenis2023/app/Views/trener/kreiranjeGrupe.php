<?php
  $this->extend('layout');
  $this->section('content');
  helper('html');
?>

<section class="page-section">
<h2 class='text-center'>Kreiranje nove grupe</h2>

<?php  
  echo "<div class='container'>";
  echo "<div class='row'>";
	if (!empty($ucenici)){
      
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

      echo form_open("grupa/addGrupa", ['method' => 'post', 'id' => 'formGrupa']);

      echo form_label("Naziv grupe: ", "naziv");
      echo form_input("naziv", '', ['class' => 'form-control']);
      echo "<br>";
      echo form_label("Učenici: ", "ucenici");
      echo "<br>";
      echo "<div class='row g-4'>";
      
    foreach ($ucenici as $ucenik) { 
        echo "<div class='col-sm-6 col-md-4 col-lg-3'>";         
        echo "<div class='border border-warning p-1 text-center rounded'>";  
          $ime_prezime = $ucenik->ime . ' ' . $ucenik->prezime;
          echo img('assets/img/users/'.$ucenik->poster, false, ['alt' => $ucenik->prezime, 'width' => '70', 'class' => 'center rounded-circle img-fluid']);
          echo "<br>";        
          echo form_checkbox("ucenik[]", $ucenik->idkor);
          echo form_label($ime_prezime , $ucenik->idkor);          
        echo "</div>";
      echo "</div>";        
    }
    echo "<p class='text-danger text-end'>*Odabrati minimum dva učenika, najviše tri.</p>";
    echo "<div class='d-grid col-6 mx-auto'>";
    echo form_submit("dodaj", "Dodaj grupu", ['class'=> 'btn btn-primary']);
    echo "</div>";
    echo form_close();
  }
	else echo "<p class='m-5'>Nemate slobodnih učenika.</p>";
  echo "</div>";    
?>
  </div>
  </div>
  </section>
  <script>
    // js za proveru da li je izabrano minimum dva a najvise tri ucenika
      window.onload = function() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]'); // svi checkboxovi
        var odabraniUcenici = [];

        for (var i = 0; i < checkboxes.length; i++) {
          checkboxes[i].addEventListener('change', handleCheckboxChange);
        }

        function handleCheckboxChange(event) {
          var clicked = event.target;
          var value = clicked.value;

          if (clicked.checked) {          
            if (odabraniUcenici.length >= 3) {
              clicked.checked = false;
              alert('Odaberite najviše tri učenika.');
              return;
            }

            odabraniUcenici.push(value);
          } else {
            var index = odabraniUcenici.indexOf(value);
            odabraniUcenici.splice(index, 1);
          }

          console.log('Selektovani ID:', odabraniUcenici);
        }
      };
      document.getElementById('formGrupa').addEventListener('submit', function(event) {
      var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked'); // svi checkirani
      if (checkboxes.length < 2) { // ako je manje od dva chekirana
        event.preventDefault(); // spreci slanje forme
        alert('Grupa mora imati najmanje dva učenika.'); // obavesti korisnika
      }
    });
  </script>
  <?= $this->endSection() ?>
  