<?php

$this->extend('layout');
$this->section('content');
helper('html');
?>

<!-- TRENERI -->
<!-- Portfolio Grid-->
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Treneri</h2>
            <h3 class="section-subheading text-muted">Naši treneri su licencirani sa dugogodišnjim iskustvom.</h3>
        </div>
        <div class="row">
            <?php
                
                if (!empty($treneri)){
                foreach ($treneri as $trener) {
                    echo "<div class='col-lg-4 col-sm-6 mb-4'>
                        <div class='portfolio-item'>
                            <a class='portfolio-link' data-bs-toggle='modal' href='#portfolioModal".$trener->idkor."'>
                                <div class='portfolio-hover'>
                                    <div class='portfolio-hover-content'><i class='fas fa-plus fa-3x'></i></div>
                                </div>                                 
                                <img class='img-fluid' src='".base_url("assets/img/users/".$trener->poster)."' />
                            </a>
                            <div class='portfolio-caption'>
                                <div class='portfolio-caption-heading'>".$trener->ime." ".$trener->prezime."</div>
                                <div class='portfolio-caption-subheading text-muted'>trener</div>
                            </div>
                        </div>
                    </div>
                
                    <div class='portfolio-modal modal fade' id='portfolioModal".$trener->idkor."' tabindex='-1' role='dialog' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='close-modal' data-bs-dismiss='modal'><img src='".base_url('assets/img/close-icon.svg')."' alt='Close modal' /></div>
                                <div class='container'>
                                    <div class='row justify-content-center'>
                                        <div class='col-lg-8'>
                                            <div class='modal-body'>
                                                <!-- Project details-->
                                                <h2 class='text-uppercase'>".$trener->ime.' '.$trener->prezime."</h2>
                                                <p class='item-intro text-muted'>Trener</p>
                                                <img class='img-fluid d-block mx-auto' src='".base_url('assets/img/users/'.$trener->poster)."' alt='...' />
                                                <p>".$trener->opis."</p>
                                                <ul class='list-inline'>
                                                    <li>
                                                        <strong>Email:</strong>
                                                        ".$trener->email."
                                                    </li>
                                                    <li>
                                                        <strong>Kontakt:</strong>
                                                        ".$trener->brtel."
                                                    </li>
                                                </ul>
                                                <button class='btn btn-primary btn-xl text-uppercase' data-bs-dismiss='modal' type='button'>
                                                    <i class='fas fa-xmark me-1'></i>
                                                    Zatvori
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
                }
            } else echo "Nema registrovanih trenera u bazi.";
            ?>






            
            
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
    


<?php
$this->endSection();
?>

