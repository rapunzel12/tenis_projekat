<?php

$this->extend('layout');
$this->section('content');
?>


<!-- Team-->
<section class="page-section bg-light" id="team">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Ovo su članovi našeg tima</h2>
            <h3 class="section-subheading text-muted">Uvek su tu za vas</h3>
        </div>
        <div class="row">
            <?php foreach ($users as $user) { ?>
                <div class="col-lg-4">
                    <div class="team-member">
                        <?php if ($user->status == 1) { ?>
                            <img class="mx-auto rounded-circle" src="<?= base_url('assets/img/users/' . $user->poster) ?>" alt="..." />
                            <h4><?php echo $user->ime . " " . $user->prezime ?></h4>
                            <p class="text-muted"><?php echo $user->email ?></p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <p class="large text-muted">Ukoliko imate nekih pitanja, budite slobodni da kontaktirate naš tim</p>
            </div>
        </div>
    </div>
</section>

<?php
$this->endSection();
?>