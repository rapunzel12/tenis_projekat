
<!-- view rekreativca koji se poziva nakon registracije/logina -->
<?php

$this->extend('layout');
$this->section('content');

?>

<div class="container rezervacija" style="margin-top:170px;">
    <h1 style="text-align:center;">Резервација тениског терена</h1>
    
    <!-- odradi table za zauzete termine, u foreach ubacujes polje tr umesto li taga -->
    <ul>
        <?php if(empty($busy)){
            echo '<li>All terms are available.</li>';
        } else {
        foreach($busy as $term){
            echo "<li>$term</li>";
           }} ?>
    </ul>
    <form action="<?=site_url("Reservation/store") ?>" method="POST">
        <input type="hidden" name="teren" value="<?php echo $teren;?>">
      <div class="form-group">
        <label for="datum">Датум:</label>
        <input type="date" class="form-control" id="datum" name="datum" value="<?php echo $datum ?>" readonly>
      </div>
     
      <div class="form-group">
        <label for="vreme">Време:</label>
        <input type="number" class="form-control" id="vreme" name="vreme" min=0 max=23 required>
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