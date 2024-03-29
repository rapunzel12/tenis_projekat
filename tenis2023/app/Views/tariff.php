<!-- PREGLED CENOVNIKA KOJI SE PRIKAZUJE SVAKOM POSETIOCU SAJTA-->
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
            <h2 class="section-heading text-uppercase">Cenovnik kluba</h2>
            <br>
            <?php if (isset($tariffs)) { ?>
                <div>
                    <table class="table table-hover table-striped table-bordered" border="1" cellpadding="2" cellspacing="1">
                        <tr>
                            <th>Redni broj</th>
                            <th>Naziv usluge</th>
                            <th>Cena usluge</th>
                        </tr>
                        <?php
                        $rb = 1;
                        foreach ($tariffs as $tariff) { ?>
                            <tr>
                                <td><?php
                                    echo $rb . ". ";
                                    $rb++;
                                    ?></td>
                                <td><?= $tariff->naziv ?></td>
                                <td><?= $tariff->ukupno . ",00 RSD" ?></td>
                            </tr>

                        <?php } ?>
                    </table>
                <?php } ?>
                </div>
                <br>
                <br>
                <br>
        </div>
    </div>
</div>
<?php
$this->endSection();
?>