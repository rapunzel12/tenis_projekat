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
            <h2 class="section-heading text-uppercase">Registruj se</h2>

            <br>
            <?php $session = \Config\Services::session(); ?>
            <h4><?= $session->getFlashdata('msg') ?></h4>
            <h4><?= $session->getFlashdata('errors') ?></h4>
            <br>
            <form action="<?= site_url("Guest/register") ?>" method="post" enctype="multipart/form-data">

                <label for="text" class="form-label">Ime: </label>
                <input type="text" class="form-control" name="name" placeholder="Unesite ime..." value="<?= set_value('name') ?>">
                <br>

                <label for="text" class="form-label">Prezime: </label>
                <input type="text" class="form-control" name="lastname" placeholder="Unesite prezime..." value="<?= set_value('lastname') ?>">
                <br>

                <label for="text" class="form-label">Korisničko ime: </label>
                <input type="text" class="form-control" name="username" placeholder="Unesite korisničko ime..." value="<?= set_value('username') ?>">
                <br>

                <label for="password" class="form-label">Šifra: </label>
                <input type="password" class="form-control" name="password" placeholder="Unesite šifru..." value="<?= set_value('password') ?>">
                <br>

                <label for="passconf" class="form-label">Ponovljena šifra: </label>
                <input type="password" class="form-control" name="passconf" placeholder="Ponovite šifru..." value="<?= set_value('passconf') ?>">
                <br>

                <label for="email" class="form-label">E-mail: </label>
                <input type="email" class="form-control" name="email" placeholder="Unesite mejl adresu..." value="<?= set_value('email') ?>">
                <br>

                <label for="tel" class="form-label">Broj telefona: </label>
                <input type="tel" class="form-control" name="tel" placeholder="Unesite broj telefona..." value="<?= set_value('tel') ?>">
                <br>

                <label for="user_type" class="form-label">Tip korisnika:</label>
                <select class="form-select" name="user_type" id="user_type">
                    <option selected disabled hidden value="">Izaberite...</option>
                    <option value="0" <?= set_select('user_type', '0') ?>>rekreativac</option>
                    <option value="1" <?= set_select('user_type', '1') ?>>učenik</option>
                    <option value="2" <?= set_select('user_type', '2') ?>>trener</option>
                    <option value="3" <?= set_select('user_type', '3') ?>>administrator</option>
                </select>
                <br>

                <label for="description" class="form-label" id="description_name" hidden>Kratka biografija</label>
                <textarea row="4" class="form-control" name="description" placeholder="Napišite kratku biografiju do 1024 karaktera..." id="description" hidden><?= set_value("description") ?></textarea>
                <br />

                <label for="poster" class="form-label">Unesite fotografiju dimenzija 200 x 200</label>
                <input type="file" class="form-control" name="poster" accept="image/*" value="<?= set_value('poster') ?>">
                <br />
                
                <button type="submit" class="btn btn-primary">Registruj se</button>
                <br>
                <br>
                <br>
            </form>
        </div>
    </div>
</div>

<script>
    // Javascript funkcija za prikazivanje polja za Kratku biografiju nakon odabira tipa korisnika = trener
    document.querySelector('#user_type').addEventListener("change", function() {
        let opis = document.getElementById('description');
        let opis_name = document.getElementById('description_name');
        if (this.value == "2" || this.value == "3") {
            opis.removeAttribute('hidden');
            opis_name.removeAttribute('hidden');
        } else {
            opis.setAttribute('hidden', true);
            opis_name.setAttribute('hidden', true);
        }
    });
</script>

<?php
$this->endSection();
?>