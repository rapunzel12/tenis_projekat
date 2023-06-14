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
            <h2 class="section-heading text-uppercase">Uloguj se</h2>
            
            <br>
            <?php $session = \Config\Services::session(); ?>
            <h4><?= $session->getFlashdata('msg') ?></h4>
            <h4><?= $session->getFlashdata('errors') ?></h4>
            <br>
            <form action="<?=site_url("Guest/login") ?>" method="post">
                <label for="text" class="form-label">Korisničko ime: </label>
                <input type="text" class="form-control" name="username" 
                    placeholder="Unesite svoje ime..." value="<?= old('username') ?>">
                <br>

                <label for="password" class="form-label" >Šifra: </label>
                <input type="password" class="form-control" name="password" 
                    placeholder="Unesite svoju šifru..."  value="<?= old('password') ?>">
                <br>

                <label for="user_type" class="form-label" >Tip korisnika:</label>
                <select class="form-select" name="user_type" >
                    <option selected disabled hidden value="">Izaberite...</option>
                    <option value="0" <?= set_select('user_type', '0')?> >rekreativac</option>
                    <option value="1" <?= set_select('user_type', '1')?> >učenik</option>
                    <option value="2" <?= set_select('user_type', '2')?> >trener</option>
                    <option value="3" <?= set_select('user_type', '3')?> >administrator</option>
                </select>
                <br>

                <button type="submit" class="btn btn-primary">Uloguj se</button>


            </form>
        </div>
</div>

<?php
$this->endSection();
?>