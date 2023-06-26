<!-- view rekreativca koji se poziva nakon registracije/logina -->
<?php

$this->extend('layout');
$this->section('content');
?>
<div class="container" style="margin-top: 150px;">
  <div class="d-flex justify-content-between">
    <h1>Pregled rezervisanih termina</h1>
    <!-- датум,  време,  терен,  тренер  и  статуc -->
    <form class="d-flex" action="<?=site_url("Reservation/search") ?>" method="GET">
    <div class="d-flex flex-column">
      <label for="search">Search by date, time, court, coach or status</label>
      <input type="text" name="search" placeholder="Search...">
      <button type="submit" class="btn btn-sm btn-info mt-2">Pretrazi</button>
    </div>
    </form>
</div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
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
          foreach($data as $key=>$rezervacija){ ?>
      <tr class="
      <?php if($rezervacija->status == 'rez'){
        echo "table-success";
      // }elseif($rezervacija->status == 'slo'){
      //     echo "table-primary";
        }elseif($rezervacija->status == 'otk'){
          echo "table-danger";
        }
      ?>">
        <td><?php echo $key+1; ?></td>
        <td><?php echo $rezervacija->datum; ?></td>
        <td><?php echo $rezervacija->vreme; ?></td>
        <td><?php echo $rezervacija->poster_vertical; ?></td>
        <td><?php echo $rezervacija->opis; ?></td>
        <td><?php echo $rezervacija->brrek; ?></td>
        <td><?php echo $rezervacija->status; ?></td>
        <td class="d-flex">
          <div class="me-3">
            <form action="<?=site_url("Reservation/cancel") ?>" method="POST">
            <!-- Ne prikazuje se na frontu, ali sluzi da bi znao koju rezervaciju da obrises -->
            <input type="hidden" name="id_rezervacije" value="<?php echo $rezervacija->idrez; ?>">
            <button type="submit" class="btn btn-sm btn-danger" <?php echo $rezervacija->status == "otk" ? 'disabled': '' ?>>Otkazi</button>
          </form>
        </div>
          <div>
        <form action="<?=site_url("Reservation/destroy") ?>" method="POST">
          <input type="hidden" name="id_rezervacije" value="<?php echo $rezervacija->idrez; ?>">
          <button type="submit" class="btn btn-sm btn-warning">Obrisi</button>
        </form>
        </div>
        </td>
      </tr>
  <?php } }?>
    </tbody>
  </table>
</div>

<?php
$this->endSection();
?>