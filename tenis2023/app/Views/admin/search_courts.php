<?php

$this->extend('layout');

$this->section('content');

?>

<div class="masthead container">
    <div class="row">
        <?= view("admin/admin_menu") ?>
        <div class="col-sm-6">
            <br>
            <br>
            <br>
            <br>
            <h2 class="section-heading text-uppercase">Pretraga prema tipu podloge teniskog terena</h2>
            <br>
            <?php $session = \Config\Services::session(); ?>
            <h4><?= $session->getFlashdata('msg') ?></h4>
            <h4><?= $session->getFlashdata('errors') ?></h4>
            <br>
            <form action="<?= site_url("Admin/searchCourts") ?>" method="post">

                <label for="court_type" class="form-label">Tip podloge:</label>
                <select class="form-select" name="court_type">
                    <option selected disabled hidden value="">Izaberite...</option>


                    <option value="S" <?= set_select('court_type', 'S') ?>>šljaka</option>
                    <option value="T" <?= set_select('court_type', 'T') ?>>trava</option>
                    <option value="B" <?= set_select('court_type', 'B') ?>>beton</option>
                </select>
                <br>

                <button type="submit" class="btn btn-primary">Pretraga</button>
                <br>
                <br>
                <br>
            </form>
        </div>
    </div>


</div>

<?php
$this->endSection();
?>