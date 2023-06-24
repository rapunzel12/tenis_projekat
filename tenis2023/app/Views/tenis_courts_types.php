<?php

$this->extend('layout');
$this->section('content');
?>

<!--About-->
<section class="page-section" id="about">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Teniski tereni</h2>
            <h3 class="section-subheading text-muted">Naši vrhunski teniski tereni omogući će vam da uživate u igri.</h3>
        </div>
        <ul class="timeline">
            <?php foreach ($courts as $court) { ?>
                <?php
                if ($court->tippod == "S") {
                    $courtN = "sljaka";
                }
                if ($court->tippod == "T") {
                    $courtN = "trava";
                }
                if ($court->tippod == "B") {
                    $courtN = "beton";
                }
                ?>
                <li>
                    <div class="timeline-image"><img class="mx-auto rounded-circle" src="<?= base_url('assets/img/tenis/' . $court->poster_vertical) ?>" width="157" height="157" alt="..."></div>
                    <div class="timeline-panel" id="<?= $courtN ?>">
                        <div class="timeline-heading">
                            <h4><?php
                                if ($court->tippod == "S") {
                                    echo "Šljaka";
                                }
                                if ($court->tippod == "T") {
                                    echo "Trava";
                                }
                                if ($court->tippod == "B") {
                                    echo "Beton";
                                }
                                ?>
                            </h4>
                            <h4 class="subheading"></h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">
                                <?= $court->opis ?>
                            </p>
                            <!--Travnati tereni su najbrži tereni. Oni sadrže travu koja je uzgajana na veoma tvrdoj zemlji slično golf terenima, koja daje dodatne efekte loptici. Poeni traju veoma kratko i servis igra najznačajniju ulogu, i zbog toga se faforizuju servis-volej igrači. Ova podloga je mekša od tvrde podloge i zbog toga loptica niže odskače tako da igrači moraju da udare lopticu mnogo ranije. Zbog velikih troškova izgradnje, ovi tereni su retki kao i zbog toga što se moraju zalivati i kositi veoma često a i vreme sušenja posle kiše je veliko.-->
                            <!--Naši tereni od šljake su napravljeni od lomljene cigle i crvene su boje. Šljakasti tereni se smatraju sporim terenima jer loptica odskače relativno visoko i sporije tako da je igračima teško da udare winere. Poeni obično traju duže i jako je mali broj winera. Zbog toga ovakve terene vole igrači koji igraju više sa osnovne linije i defanzivno. Kretanje na šljakastim terenima se veoma razlikuje od drugih terena. Igranje na šljaci često uključuje proklizavanje ka loptici tokom udarca. Najpoznatiji tereni od šljake su Roland Garros.-->
                            <!--Naši tvrdi treni su napravljeni od betona.Smatraju se srednje brzom podlogom gde loptica brzo ide i odskače nisko i zbog toga poeni traju relativno kratko. Snažni igrači sa jakim servisom imaju blagu prednost. Ovakvi tereni se mogu razlikovati po brzini ali su brži od šljakastih terena i sporiji od travnatih. Tvrdi tereni smatraju se pogodnim za najveći broj igrača.-->
                        </div>
                    </div>
                <?php } ?>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image">
                        <h4>
                            BUDI DEO
                            <br />
                            NAŠEG
                            <br />
                            KLUBA!
                        </h4>
                    </div>
                </li>
        </ul>
    </div>
</section>
<?php
$this->endSection();
?>