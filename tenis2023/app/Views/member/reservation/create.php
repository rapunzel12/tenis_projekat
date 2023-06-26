
<!-- view rekreativca koji se poziva nakon registracije/logina -->
<?php

$this->extend('layout');
$this->section('content');

?>

  <div class="container rezervacija" style="margin-top:170px;">
    <h1 style="text-align:center;">Резервација тениског терена</h1>
    <form action="<?=site_url("Reservation/checkCourt") ?>" method="POST">
      <div class="form-group">
        <label for="datum">Датум:</label>
        <input type="date" class="form-control" id="datum" name="datum" required>
      </div>
      <div class="row row-cols-1 row-cols-md-3 g-4" style="margin:10% 5% 10% 5%;">
        <input type="radio" id="sljaka" name="tip_terena" value="S" style="display:none">
        <label for="sljaka" class="col">
          <div class="card h-100">
            <img src="<?= base_url("assets/img/slike/slika6.jpg") ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Šljaka</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          
          </div>
        </label>
        <input type="radio" id="trava" name="tip_terena" value="T" style="display:none">
        <label for="trava" class="col">
          <div class="card h-100">
            <img src="<?= base_url("assets/img/slike/beton.jpg") ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Trava</h5>
              <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
            </div>
          
          </div>
        </label>
        <input type="radio" id="beton" name="tip_terena" value="B" style="display:none">
        <label for="beton" class="col">
          <div class="card h-100">
            <img src="<?= base_url("assets/img/slike/beton.jpg") ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Beton</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
            </div>
        
          </div>
        </label>
      </div>
      
      <button type="submit" class="btn btn-primary">Резервиши</button>
    </form>
     
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>


<?php
$this->endSection();
?>