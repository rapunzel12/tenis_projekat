<?php

$this->extend('layout');
$this->section('content');

?>
<div class="masthead container">
    <div class="row">



        <div class="col-sm-6">
            <br>

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h2 class="section-heading text-uppercase">Pretraži</h2>
            <br>
            <form action="<?= site_url("Student/searchSheduledTerm") ?>" method="post">

                <label for="date" class="form-label">Datum: </label>
                <input type="date" class="form-control" name="date" placeholder="Odaberite datume..." value="<?= set_value('date') ?>">
                <br>

                <label for="time" class="form-label">Vreme: </label>
                <input type="time" class="form-control" name="time" placeholder="Odaberite vreme..." value="<?= set_value('time') ?>">
                <br>

                <label for="training_type" class="form-label">Tip treninga</label>
                <select class="form-select" name="training_type">
                    <option selected disabled hidden value="">Izaberite...</option>
                    <option value="0" <?= set_select('training_type', '0') ?>>Individualni</option>
                    <option value="1" <?= set_select('training_type', '1') ?>>Grupni</option>
                </select>
                <br>
                <label for="court_type" class="form-label">Tip terena:</label>
                <select class="form-select" name="court_type">
                    <option selected disabled hidden value="">Izaberite...</option>
                    <option value="S" <?= set_select('court_type', 'S') ?>>šljaka</option>
                    <option value="T" <?= set_select('court_type', 'T') ?>>trava</option>
                    <option value="B" <?= set_select('court_type', 'B') ?>>beton</option>
                </select>
                <br>
                <button type="submit" class="btn btn-primary">Pretraži</button>
            </form>
        </div>
    </div>
</div>


<?php
$this->endSection();
?>