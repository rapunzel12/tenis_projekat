<?php

$this->extend('layout');
$this->section('content');
?>

<!-- TERENI -->
<!-- Services-->
<section class="page-section" id="services">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Teniski tereni</h2>
            <h3 class="section-subheading text-muted">Naši tereni su opremljeni savremenim podlogama koji se koriste na najvećim turnirima.</h3>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <div class="container">
                <div class="row">
                    <div class="card-wrapper col-lg-4 col-md-6 col-xs-12">
                        <div class="card">
                            <div class="card-img-wrapper">
                                <img class="card-img-top" src="<?= base_url("assets/img/slike/trava2.jpg") ?>" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">TRAVA</h5>
                                <div class="card-content">
                                    <p class="card-text">Doživite osećaj Wimboldona na našim terenima.</p>
                                    <?= anchor("Main/viewTenisCourtsTypes#trava", "Više", ["class" => "btn btn-primary"]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper col-lg-4 col-md-6 col-xs-12">
                        <div class="card">
                            <div class="card-img-wrapper">
                                <img class="card-img-top" src="<?= base_url("assets/img/slike/sljaka_teren.jpg") ?>" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">ŠLJAKA</h5>
                                <p class="card-text">Doživite osećaj Rolan Garosa na našim terenima.</p>
                                <?= anchor("Main/viewTenisCourtsTypes#sljaka", "Više", ["class" => "btn btn-primary"]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper col-lg-4 col-md-6 col-xs-12">
                        <div class="card">
                            <div class="card-img-wrapper">
                                <img class="card-img-top" src="<?= base_url("assets/img/slike/beton_teren.jpg") ?>" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">BETON</h5>
                                <p class="card-text">Doživite osećaj Austalian i US Opena na našim terenima.</p>
                                <?= anchor("Main/viewTenisCourtsTypes#beton", "Više", ["class" => "btn btn-primary"]); ?>
                            </div>
                        </div>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$this->endSection();
?>