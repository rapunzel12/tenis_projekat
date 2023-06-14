
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

      <tr>
        <td>Mark</td>
        <td>Otto</td>
        <td>Otto</td>
        <td>Otto</td>
        <td>Otto</td>
        <td>Otto</td>
        <td>
          <button class="btn btn-sm btn-danger" onclick="otkaziTermin(1)">Otkazi</button>
          <button class="btn btn-sm btn-warning" onclick="obrisiTermin(1)">Obrisi</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<?php
$this->endSection();
?>