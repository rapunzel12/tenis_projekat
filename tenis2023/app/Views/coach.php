<?php
    $this->extend('layout');
    $this->section('content');
    helper('html');     
?>

<section class="page-section">
<div class="container">
    <div class="row">        
        <h2 class="text-center mb-5">Trener meni</h2> 
        
        <div class="col-sm-12 col-md-6 d-grid gap-2">       
            <a href="<?= base_url('zahtevi/zahteviUcenika') ?>" class="btn btn-outline-warning mb-3 p-3">Zahtevi od učenika <span class="badge rounded-pill text-bg-danger"> <?= $ukupnoZahtevaUcenika?></span></a>
            <a href="<?= base_url('zahtevi/zahteviRekreativaca') ?>" class="btn btn-outline-warning mb-3 p-3">Zahtevi rekreativaca za trening <span class="badge rounded-pill text-bg-danger"><?= $rezervacijaNaCekanju ?></span></a>
            <a href="<?= base_url('Coach/rezervisanjeTermina') ?>" class="btn btn-outline-danger mb-3 p-3">Rezervisanje termina sa učenicima</a>
            <a href="<?= base_url('Coach/pregledRezervacijaGrupe') ?>" class="btn btn-outline-info mb-3 p-3">Zakazani grupni termini - pregled <span class="badge rounded-pill text-bg-info"><?= $ukupnoRezervacijaGrupni ?></span></a></a>
            <a href="<?= base_url('Coach/pregledRezervacija') ?>" class="btn btn-outline-info mb-3 p-3">Zakazani individualni termini - pregled <span class="badge rounded-pill text-bg-info"><?= $ukupnoRezervacija ?></span></a></a>
        </div>
        <div class="col-sm-12 col-md-6 d-grid gap-2">
            <a href="<?= base_url('grupa/pregledGrupa') ?>" class="btn btn-outline-secondary mb-3 p-3">Grupe - pregled <span class="badge rounded-pill text-bg-secondary"><?= $ukupnoGrupa ?></span></a>
            <a href="<?= base_url('grupa/kreiranjeGrupe') ?>" class="btn btn-outline-secondary mb-3 p-3">Grupe - kreiranje</a>
            <a href="<?= base_url('Coach/pregledTerena') ?>" class="btn btn-outline-success mb-3 p-3">Svi tereni - pregled</a>
            <a href="<?= base_url('Coach/pregledTrenera') ?>" class="btn btn-outline-success mb-3 p-3">Svi treneri - pregled</a>
            <a href="#trenerModal" class="btn btn-outline-dark mb-3 p-3" data-bs-toggle="modal" data-target="#trenerModal">Moji podaci - pregled</a>            
        </div>        

        
    </div>
</div>


    <div class="portfolio-modal modal fade" id="trenerModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="<?= base_url('assets/img/close-icon.svg')?>" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project details-->
                                <h2 class="text-uppercase">Trener</h2>
                                <h3 class="item-intro text-muted"><?php echo $korisnik->ime.' '.$korisnik->prezime; ?></h3>
                                <br>
                                <?php echo img('assets/img/users/'.$korisnik->poster, false, ['alt' => $korisnik->ime.' '.$korisnik->prezime, 'width' => '250', 'class' => 'img-fluid']);?>
                                
                                <p><?php echo $korisnik->opis; ?></p>
                                <ul class="list-inline">
                                    <li>
                                        <strong>Email:</strong>
                                        <?php echo $korisnik->email; ?>
                                    </li>
                                    <li>
                                        <strong>Kontakt:</strong>
                                        <?php echo $korisnik->brtel; ?>
                                    </li>
                                </ul>
                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                    <i class="fas fa-xmark me-1"></i>
                                    ZATVORI
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script><!-- OVA LINIJA BLOKIRA IZVRSAVANJE SERVERSKE STRANE KODA-->
    <!-- Core theme JS--> 
    <script src="js/scripts.js"></script><!-- OVA LINIJA BLOKIRA IZVRSAVANJE SERVERSKE STRANE KODA-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> <!-- OVA LINIJA BLOKIRA IZVRSAVANJE SERVERSKE STRANE KODA-->


<?php $this->endSection() ?>


