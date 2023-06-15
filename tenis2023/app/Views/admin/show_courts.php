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
            <h2 class="section-heading text-uppercase">Rezultati pretrage prema tipu podloge teniskog terena</h2>
            <br>
            <?php $session = \Config\Services::session(); ?>
            <h4><?= $session->getFlashdata('msg') ?></h4>
            <h4><?= $session->getFlashdata('errors') ?></h4>
            <br>
            <?php if (isset($courts)) {
                if (sizeof($courts) == 0) {
                    echo "Nema rezultata pretrage";
                } else {
                $court = $courts[0];
                if ($court['tippod'] == 0) {
                    echo "Tip terena - šljaka";
                }
                if ($court['tippod'] == 1) {
                    echo "Tip terena - trava";
                }
                if ($court['tippod'] == 2) {
                    echo "Tip terena - beton";
                }
            }
            ?>
                <div>
                    <table class="table table-hover table-striped table-bordered" border="1" cellpadding="2" cellspacing="1">
                        <tr>
                            <th>Redni broj</th>
                            <th>Tip podloge</th>
                            <th>Opis terena</th>
                            <th>Obriši</th>
                        </tr>
                        <?php
                        $rb = 1;
                        foreach ($courts as $court) { ?>
                            <tr>
                                <td><?php
                                    echo $rb  . ". ";
                                    $rb++;
                                    ?></td>
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
                ?>
                </div>

                <br>


        </div>


    </div>

    <?php
    $this->endSection();
    ?>