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
            <h2 class="section-heading text-uppercase">Uneti novu ponudu</h2>
            <br>
            <?php $session = \Config\Services::session(); ?>
            <h4><?= $session->getFlashdata('msg') ?></h4>
            <h4><?= $session->getFlashdata('errors') ?></h4>
            <br>
            <form action="<?= site_url("Admin/addTariff") ?>" method="post" enctype="multipart/form-data">

                <label for="name" class="form-label">Nova ponuda:</label>
                <input type="text" class="form-control" name="name" />
                <br />
                <label for="total" class="form-label">Uneti cenu nove ponude:</label>
                <input type="number" class="form-control" name="total" />
                <br />

                <button type="submit" class="btn btn-primary">Uneti novu ponudu</button>

            </form>
        </div>


        <?php
        $this->endSection();
        ?>