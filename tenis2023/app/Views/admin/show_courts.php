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
            <?php $session = \Config\Services::session(); ?>
            <?= $session->getFlashdata('msg') ?>
            <?= $session->getFlashdata('errors') ?>
            <br>
            <h2 class="section-heading text-uppercase">Rezultati pretrage prema tipu podloge teniskog terena</h2>
            <br>


            <?php if (isset($courts)) {
                //if (sizeof($courts) == 0) {
                //    echo "Nema rezultata pretrage";
                //} else {

            ?>
                <div>
                    <table class="table table-hover table-striped table-bordered" border="1" cellpadding="2" cellspacing="1">
                        <tr>
                            <th>Redni broj</th>
                            <th>Tip podloge</th>
                            <th>Opis terena</th>
                            <th>Obriši</th>
                        </tr>
                        <?php foreach ($courts as $court) { ?>
                            <tr>
                                <td></td>
                                <td><?php if ($court['tippod'] == "S") {
                                        echo "šljaka";
                                    }
                                    if ($court['tippod'] == "T") {
                                        echo "trava";
                                    }
                                    if ($court['tippod'] == "B") {
                                        echo "beton";
                                    } ?></td>
                                <td><?= $court['opis'] ?></td>
                                <td><?= anchor('Admin/deleteCourts/' . $court['idteren'], 'Obriši', ['class' => 'btn btn-primary']) ?>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>

                    </table>
                <?php
            }
            //}
                ?>
                </div>

                <br>


        </div>


    </div>

    <?php
    $this->endSection();
    ?>