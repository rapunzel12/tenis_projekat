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
            <h2 class="section-heading text-uppercase">



                <br>

                <br>


                <h2 class="section-heading text-uppercase">
                    <?php if (isset($users)) {
                        //var_dump($users);
                        // return;
                        //$user=reset($users);
                        //var_dump(array_key_first($users));
                        //var_dump($users[0]);
                        $user=$users[0];
                        // return;
                            if ($user['status'] == 0) {
                                echo "Rezultat pretrage - novi zahtevima za registraciju";
                            }
                            if ($user['status'] == 1) {
                                echo "Pregled korisnika sa prihvaćenim nalozima";
                            }
                            if ($user['status'] == 2) {
                                echo "Pregled korisnika sa odbijenim nalozima";
                            }
                            if ($user['status'] == 3) {
                                echo "Pregled korisnika sa arhiviranim nalozima";
                            }
                        

                    ?>

                </h2>
                <div>
                    <table table class="table table-hover table-striped table-bordered" border="1" cellpadding="2" cellspacing="1">
                        <tr>
                            <th>Id korisnika</th>
                            <th>Korisničko ime</th>
                            <th>Šifra</th>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Broj telefona</th>
                            <th>E-mail</th>
                            <th>Tip korisnika</th>
                            <th>Promena statusa</th>

                        </tr>
                        <?php 
                        $rb=1;
                        foreach ($users as $user) { ?>
                            <tr>
                                <td><?php 

                                echo $rb;
                                $rb++;
                                 
                                
                                
                                
                                ?></td>
                                <td><?= $user['korime'] ?></td>
                                <td><?= $user['pass'] ?></td>
                                <td><?= $user['ime'] ?></td>
                                <td><?= $user['prezime'] ?></td>
                                <td><?= $user['brtel'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?php if ($user['tip'] == 0) {
                                        echo "rekreativac";
                                    }
                                    if ($user['tip'] == 1) {
                                        echo "učenik";
                                    }
                                    if ($user['tip'] == 2) {
                                        echo "trener";
                                    }
                                    if ($user['tip'] == 3) {
                                        echo "administrator";
                                    }  ?></td>
<td>
                                <?php if ($user['status'] == 0 || $user['status'] == 2) { ?>
                                    <?= anchor("Admin/updateUser/" . $user['idkor'] . "/1", "Prihvati") ?> <br>

                                    <?php } ?>
                                        <?php if ($user['status'] == 0) { ?>
                                            <?= anchor('Admin/updateUser/' . $user['idkor'] . "/2", "Odbij") ?> <br>
                                        <?php } ?>


                                        <?php if ($user['status'] == 1) { ?>
                                            <?= anchor('Admin/updateUser/' . $user['idkor'] . "/3", "Arhiviraj") ?> 
                                    
                                <?php } ?>
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

        <?php
        $this->endSection();
        ?>