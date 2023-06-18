
<!-- view rekreativca koji se poziva nakon registracije/logina -->
<?php

$this->extend('layout');
$this->section('content');
var_dump($tereni,$treneri);
?>

  <div class="container rezervacija" style="margin-top:170px;">
    <h1 style="text-align:center;">Резервација тениског терена</h1>
    <form action="<?=site_url("Rezervacija/rezervisi") ?>" method="POST">
      <div class="row row-cols-1 row-cols-md-3 g-4" style="margin:10% 5% 10% 5%;">
        <input type="radio" id="sljaka" name="tip_terena" value="sljaka" style="display:none">
        <label for="sljaka" class="col">
          <div class="card h-100">
            <img src="<?= base_url("assets/img/slike/slika6.jpg") ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Šljaka</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          
          </div>
        </label>
        <input type="radio" id="trava" name="tip_terena" value="trava" style="display:none">
        <label for="trava" class="col">
          <div class="card h-100">
            <img src="<?= base_url("assets/img/slike/beton.jpg") ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Trava</h5>
              <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
            </div>
          
          </div>
        </label>
        <input type="radio" id="beton" name="tip_terena" value="beton" style="display:none">
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
      <div class="form-group">
        <label for="datum">Датум:</label>
        <input type="date" class="form-control" id="datum" name="datum" required>
      </div>
      <div class="form-group">
        <label for="vreme">Време:</label>
        <input type="time" class="form-control" id="vreme" name="vreme" required>
      </div>
      <div class="form-group">
        <label for="teren">Терен:</label>
        <select class="form-control" id="teren" name="teren" required>
          <?php
          foreach($tereni as $teren){?>
            <option value="<?php echo $teren->idteren ?>"><?php echo $teren->poster_vertical ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="broj_reketa">Број рекета:</label>
        <input type="number" class="form-control" id="broj_reketa" name="broj_reketa" required>
      </div>
      <div class="form-group">
        <label for="trener">Тренер:</label>
        <select class="form-control" id="trener" name="trener">
        <?php
          foreach($treneri as $trener){?>
            <option value="<?php echo $trener->idkor ?>"><?php echo $trener->opis ?></option>
          <?php } ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Резервиши</button>
    </form>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>


<?php
$this->endSection();
?>