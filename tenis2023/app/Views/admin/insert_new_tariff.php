<?php

$this->extend('layout');
// this->extend('user');
$this->section('content');

?>


<div class="masthead container">
<div class="row">
    <div class="col-sm-6">
        <br>
        <hr>
        <?php $session = \Config\Services::session(); ?>
        <?= $session->getFlashdata('msg') ?>
        <?= $session->getFlashdata('errors') ?>
        <br>
        <h2 class="section-heading text-uppercase">Uneti novu ponudu</h2>
        <form action="<?= site_url("Admin/addTariff") ?>" method="post" enctype="multipart/form-data">

            <label for="name" class="form-label">Nova ponuda:</label>
            <input type="text" class="form-control" name="name" />
            <br />
            <label for="total" class="form-label">Uneti cenu nove ponude:</label>
            <input type="text" class="form-control" name="total" />
            <br />

            <button type="submit" class="btn btn-primary">Uneti novu ponudu</button>

        </form>
    </div>


    <?php
$this->endSection();
?>