<!-- view admina koji se poziva nakon registracije/logina -->
<?php

$this->extend('layout');
$this->section('content');
?>

<div class="masthead container">
    <div class="row">
        <div class="col-sm-5">
            <br>
            <br>
            <br>
            <?php $session = \Config\Services::session(); ?>
            <?= $session->getFlashdata('msg') ?>
            <?= $session->getFlashdata('errors') ?>
            <br>
            <h2 class="section-heading text-uppercase">Pregled pristiglih zahteva za registraciju</h2>
            <br>

            <?php if (isset($user)) { ?>
                <div>
                    <table border="1">
                        <tr>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Korisničko ime</th>
                            <th>Šifra</th>
                            <th>E-mail</th>
                            <th>Broj telefona</th>
                            <th>Tip korisnika</th>
                            <th>Opis korisnika</th> <!-- cist visak -->
                            <th>Status</th>
                            <th>Prihvaćen</th>
                            <th>Odbijen</th>
                            <th>Arhiviran</th>
                        </tr>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td><?= $user['korime'] ?></td>
                                <td><?= $user['pass'] ?></td>
                                <td><?= $user['ime'] ?></td>
                                <td><?= $user['prezime'] ?></td>
                                <td><?= $user['brtel'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['tip'] ?></td>
                                <td><?= $user['status'] ?></td>
                                <td><?= anchor('Admin/naziv metodee/'.$user['idkor'], 'Prihvati')?><td>
                            </tr>

                        <?php
                        }
                        ?>

                    </table>
                <?php
            }
                ?>
                </div>

                <br>


                <div class="col-sm-5">
                    <br>
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
                        </select>
                        <br>

                        <button type="submit" class="btn btn-primary">Pretraga</button>
                    </form>
                </div>
               
        </div>
    </div>

    <div class="row">
        <div class="col-sm-5">
            <br>
            <hr>
            <?= $session->getFlashdata('msg') ?>
            <?= $session->getFlashdata('errors') ?>
            <br>
            <h2 class="section-heading text-uppercase">Uneti novi teniski teren</h2>
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
                <textarea row="4" class="form-control" name="court_description" placeholder="Opis teniskog terena do 1024 karaktera...">
                    <?= set_value("court_description") ?>
                </textarea>
                <br />

                <label for="poster_vertical" class="form-label">Fotografija dimenzija 200 x 200...</label>
                <input type="file" class="form-control" name="poster_vertical" accept="image/*" value="<?= set_value('poster_vertical') ?>">
                <br />

                <button type="submit" class="btn btn-primary">Uneti novi teniski teren</button>

            </form>
        </div>

        <button type="submit" class="btn btn-primary">Prikaz svih terena</button>

        <div class="col-sm-5">
            <br>
            <hr>
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