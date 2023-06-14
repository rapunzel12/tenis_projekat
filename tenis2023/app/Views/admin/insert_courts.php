<?php

$this->extend('layout');
// this->extend('user');
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
            <h2 class="section-heading text-uppercase">Uneti novi teniski teren</h2>
            <br>
            <?php $session = \Config\Services::session(); ?>
            <h4><?= $session->getFlashdata('msg') ?></h4>
            <h4><?= $session->getFlashdata('errors') ?></h4>
            <br>
            
            <form action="<?= site_url("Admin/addCourt") ?>" method="post" enctype="multipart/form-data">

                <label for="court_type" class="form-label">Tip podloge:</label>
                <select class="form-select" name="court_type">
                    <option selected disabled hidden value="">Izaberite...</option>
                    <option value="S" <?= set_select('court_type', 'S') ?>>šljaka</option>
                    <option value="T" <?= set_select('court_type', 'T') ?>>trava</option>
                    <option value="B" <?= set_select('court_type', 'B') ?>>beton</option>
                </select>
                <br>

                <label for="court_description" class="form-label">Uneti kratak opis teniskog terena:</label>
                <textarea row="4" class="form-control" name="court_description" 
                placeholder="Opis teniskog terena do 1024 karaktera..."><?= set_value("court_description") ?></textarea>
                <br />

                <label for="poster_vertical" class="form-label">Fotografija dimenzija 200 x 200...</label>
                <input type="file" class="form-control" name="poster_vertical" accept="image/*" value="<?= set_value('poster_vertical') ?>">
                <br />

                <button type="submit" class="btn btn-primary">Uneti novi teniski teren</button>

            </form>
        </div>


        <?php
        $this->endSection();
        ?>