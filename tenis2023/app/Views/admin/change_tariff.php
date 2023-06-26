<!-- PREGLED CENOVNIKA KOJI ADMIN MOZE DA UPDATE-UJE i brise-->
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
            <h2 class="section-heading text-uppercase">Pregled cenovnika teniskog kluba</h2>
            <br>

            <?php if (isset($tariffs)) { 
                if (count($tariffs) == 0) {
                    echo "<h4>";
                    echo "Trenutno nema unetih ponuda.";
                    echo "</h4>";
                } else { 
                    $tariff = $tariffs[0];
                }
                    ?>
                <div>
                    <table class="table table-hover table-striped table-bordered" border="1" cellpadding="2" cellspacing="1">
                        <tr>
                            <th>Redni broj</th>
                            <th>Naziv usluge</th>
                            <th>Cena usluge</th>
                            <th>Obriši</th>
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
                                <td><?= anchor('Admin/deletePrice/' . $tariff->idcena, 'Obriši', ['class' => 'btn btn-primary']) ?></td>
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