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
            <h2 class="section-heading text-uppercase">Pretraga prema statusu korisnika</h2>
            <br>
            <?php $session = \Config\Services::session(); ?>
            <h4><?= $session->getFlashdata('msg') ?></h4>
            <h4><?= $session->getFlashdata('errors') ?></h4>
            <br>
            <form action="<?= site_url("Admin/search") ?>" method="post">

                <label for="status" class="form-label">Status:</label>
                <select class="form-select" name="status">
                    <option selected disabled hidden value="">Izaberite...</option>
                    <option value="0" <?= set_select('status', '0') ?>>na čekanju</option>
                    <option value="1" <?= set_select('status', '1') ?>>prihvaćen</option>
                    <option value="2" <?= set_select('status', '2') ?>>odbijen</option>
                    <option value="3" <?= set_select('status', '3') ?>>arhiviran</option>
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