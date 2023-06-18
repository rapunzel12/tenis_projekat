
<!-- view rekreativca koji se poziva nakon registracije/logina -->
<?php

$this->extend('layout');
$this->section('content');
?>
<div class="container" style="margin-top: 150px;">
  <h1>Pregled rezervisanih termina</h1>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Datum</th>
        <th scope="col">Vreme</th>
        <th scope="col">Teren</th>
        <th scope="col">Trener</th>
        <th scope="col">Reket</th>
        <th scope="col">Status</th>
        <th scope="col">Dejstva</th>
      </tr>
    </thead>
    <tbody>
      
      <?php if($data == []){?>

        <tr>
        <td colspan=7>Ne postoje rezervacije.</td>
      </tr>
        
        <?php }else{
          foreach($data as $rezervacija){ ?>
      <tr>
        <td><?php echo $rezervacija->datum; ?></td>
        <td><?php echo $rezervacija->vreme; ?></td>
        <td><?php echo $rezervacija->poster_vertical; ?></td>
        <td><?php echo $rezervacija->opis; ?></td>
        <td><?php echo $rezervacija->brrek; ?></td>
        <td><?php echo $rezervacija->status; ?></td>
        <td>
        <form action="<?=site_url("Member/otkazi") ?>" method="POST">
          <!-- Ne prikazuje se na frontu, ali sluzi da bi znao koju rezervaciju da obrises -->
          <input type="hidden" name="id_rezervacije" value="<?php echo $rezervacija->idrez; ?>">
          <button type="submit" class="btn btn-sm btn-danger">Otkazi</button>
        </form>
        <form action="<?=site_url("Member/obrisi") ?>" method="POST">
          <input type="hidden" name="id_rezervacije" value="<?php echo $rezervacija->idrez; ?>">
          <button type="submit" class="btn btn-sm btn-warning">Obrisi</button>
        </form>
        </td>
      </tr>
  <?php } }?>
    </tbody>
  </table>
</div>

<?php
$this->endSection();
?>