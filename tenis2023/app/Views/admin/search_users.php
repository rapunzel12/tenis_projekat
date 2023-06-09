
<?php

$this->extend('layout');
// this->extend('user');
$this->section('content');

?>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="masthead container">
    <div class="row">
        <div class="col-sm-6">







        
            <br>
            <?php $session = \Config\Services::session(); ?>
            <?= $session->getFlashdata('msg') ?>
            <?= $session->getFlashdata('errors') ?>
            <br>
            <h2 class="section-heading text-uppercase">Pretraga prema statusu korisnika</h2>
            <form action="<?= site_url("Admin/search") ?>" method="post">

                <label for="status" class="form-label">Status:</label>
                <select class="form-select" name="status">
                    <option selected disabled hidden value="">Izaberite...</option>
                    <option value="0" <?= set_select('status', '0') ?>>na čekanju</option>
                    <option value="1" <?= set_select('status', '1') ?>>prihvaćen</option>
                    <option value="2" <?= set_select('status', '2') ?>>odbijen</option>
                    <option value="3" <?= set_select('status', '3') ?>>arhiviran</option>
                    
                    <option value="4" <?= set_select('status', '4') ?>>svi korisnici</option>
                </select>
                <br>

                <button type="submit" class="btn btn-primary">Pretraga</button>
            </form>
        </div>

    </div>
</div>



<?php
$this->endSection();
?>