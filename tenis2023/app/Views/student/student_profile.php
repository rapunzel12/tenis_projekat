<?php

$this->extend('layout');
$this->section('content');

?>
<div class="wrapper_userpicture">
  <div class="d-flex">
    <div class="container py-5">
      <div class="profile-heading">
        <img src="<?= base_url("assets/img/users/{$_SESSION['user']->poster}") ?>" alt="User Picture" class="profile-picture">
        <h5 class="profile-name"><?php echo $_SESSION['user']->korime ?></h5>
      </div>
    </div>
    <div class="container py-5">
      <?php if ($personalCoach == null) {
        echo "";
      } else { ?>
        <h3>Informacije o treneru</h3>
        <div class="profile-heading">
          <img src="<?= base_url("assets/img/users/{$_SESSION['user']->poster}") ?>" alt="User Picture" class="profile-picture">
          <h5 class="profile-name"><?php echo $personalCoach->korime; ?></h5>
          <p class="profile-description">
            <?php echo $personalCoach->opis; ?>
          </p>
        </div>
      <?php } ?>
    </div>
  </div>
  <div>
    <form class="d-flex" action="<?= site_url("Student/reserveCoach") ?>" method="POST">
      <div class="form-group">
        <label for="trener">Trener:</label>
        <select class="form-control" id="trener" name="trener">
          <?php
          foreach ($treneri as $trener) { ?>
            <option value="<?php echo $trener->idkor ?>"><?php echo $trener->opis ?></option>
          <?php } ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Pošalji zahtev treneru</button>
    </form>
  </div>

</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Datum</th>
      <th scope="col">Vreme</th>
      <th scope="col">Teren</th>
      <th scope="col">Trener</th>
      <th scope="col">Status</th>
      <th scope="col">Dejstva</th>
    </tr>
  </thead>
  <tbody>

    <?php if ($reservations == []) { ?>

      <tr>
        <td colspan=7>Ne postoje rezervacije.</td>
      </tr>

      <?php } else {
      foreach ($reservations as $key => $rezervacija) { ?>
        <tr class="
      <?php if ($rezervacija->status == 'rez') {
          echo "table-success";
          // }else if($rezervacija->status == 'slo'){
          //     echo "table-primary";
        } elseif ($rezervacija->status == 'otk') {
          echo "table-danger";
        }
      ?>">
          <td><?php echo $key + 1; ?></td>
          <td><?php echo $rezervacija->datum; ?></td>
          <td><?php echo $rezervacija->vreme; ?></td>
          <td><?php echo $rezervacija->poster_vertical; ?></td>
          <td><?php echo $rezervacija->opis; ?></td>
          <td><?php echo $rezervacija->status; ?></td>
          <td class="d-flex">
            <div class="me-3">
              <form action="<?= site_url("Student/cancel") ?>" method="POST">
                <!-- Ne prikazuje se na frontu, ali sluzi da bi znala koju rezervaciju da obrisem -->
                <input type="hidden" name="id_rezervacije" value="<?php echo $rezervacija->idrez; ?>">
                <button type="submit" class="btn btn-sm btn-danger" <?php echo $rezervacija->status == "otk" ? 'disabled' : '' ?>>Otkazi</button>
              </form>
            </div>
            <div>
              <form action="<?= site_url("Student/destroy") ?>" method="POST">
                <input type="hidden" name="id_rezervacije" value="<?php echo $rezervacija->idrez; ?>">
                <button type="submit" class="btn btn-sm btn-warning">Obrisi</button>
              </form>
            </div>
          </td>
        </tr>
    <?php }
    } ?>
  </tbody>
</table>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>


<?php
$this->endSection();
?>
