
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
        <hr>
        <?php $session = \Config\Services::session(); ?>
        <?= $session->getFlashdata('msg') ?>
        <?= $session->getFlashdata('errors') ?>
        <br>
        <h2 class="section-heading text-uppercase">Pretraga prema tipu podloge teniskog terena</h2>
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
        </form>
    </div>
</div>


</div>

<?php
$this->endSection();
?>


