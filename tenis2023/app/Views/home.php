<?php

$this->extend('layout');
$this->section('content');
?>

<!-- Masthead-->
<div class="owl-carousel owl-theme">

  <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="item">
          <header class="masthead masthead_wrapper">
            <div class="container">
              <div class="masthead-subheading">Dobro došli na tenis</div>
              <div class="masthead-heading text-uppercase">Uskoro se družimo</div>
            </div>
          </header>
        </div>
      </div>
      <div class="carousel-item">
        <div class="item">
          <header class="masthead1 masthead_wrapper">
            <div class="container">
              <div class="masthead-subheading">Dobro došli na tenis</div>
              <div class="masthead-heading text-uppercase">Uskoro se družimo</div>
            </div>
          </header>
        </div>
      </div>
      <div class="carousel-item">
        <div class="item">
          <header class="masthead2 masthead_wrapper">
            <div class="container">
              <div class="masthead-subheading">Dobro došli na tenis</div>
              <div class="masthead-heading text-uppercase">Uskoro se družimo</div>
            </div>
          </header>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
    </header>
  </div>
  <div class="Onama">
    <h1>Teniski klub</h1>
    <p>Teniski klub "Team 1" je otvoren septembra 2008. godine</p>
    <p>Klub poseduje modernu klupsku zgradu, sest terena za tenis sa vrhunskim podlogama (trava,sljaka,beton) koji se rredovno odrzavaju.</p>
    <p>Dva terena imaju podlogu na kojoj cesto nasi reprezentativci Janko Tipsarevic, Nenad Zimonjic, Viktor Troicki,Ana Jovanovic,Bojana JOvanovski,Miki Jankovic,Dusan Vukicevic.</p>
    <p>Klub poseduje fantasticne uslove za trening takmicara tako da usko saradjuju sa Teniskim Savezom Srbije</p>
    <p>Zbog svog svojstvenog stila i duha klub ima dosta stalnih clanova koji se rekreativno bave tenisom po najpovoljnijim cenama i suszivaju u njegovim mogucnostima.Nas klub nudi kvalitetne programe za rekreativca u ucesnike.</p>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="map-container">
          <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2856.620868283015!2d-122.41963618447715!3d37.77492927910468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sSan%20Francisco%2C%20CA%2C%20USA!5e0!3m2!1sen!2sca!4v1632467241476!5m2!1sen!2sca" allowfullscreen="" loading="lazy"></iframe>
          <div class="text-container">
            <h2>Lokacija</h2>
            <p>Adresa: Primjer ulica 123, Grad, Država</p>
            <p>Telefon: +123 456 789</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- About-->
  <!--
<section class="page-section" id="about">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">About</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
        <ul class="timeline">
            <li>
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="<?= base_url("assets/img/about/1.jpg") ?>" alt="..." /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>2009-2011</h4>
                        <h4 class="subheading">Our Humble Beginnings</h4>
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                    </div>
                </div>
            </li>
            <li class="timeline-inverted">
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="<?= base_url("assets/img/about/2.jpg") ?>" alt="..." /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>March 2011</h4>
                        <h4 class="subheading">An Agency is Born</h4>
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="<?= base_url("assets/img/about/3.jpg") ?>" alt="..." /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>December 2015</h4>
                        <h4 class="subheading">Transition to Full Service</h4>
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                    </div>
                </div>
            </li>
            <li class="timeline-inverted">
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="<?= base_url("assets/img/about/4.jpg") ?>" alt="..." /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>July 2020</h4>
                        <h4 class="subheading">Phase Two Expansion</h4>
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                    </div>
                </div>
            </li>
            <li class="timeline-inverted">
                <div class="timeline-image">
                    <h4>
                        Be Part
                        <br />
                        Of Our
                        <br />
                        Story!
                    </h4>
                </div>
            </li>
        </ul>
    </div>
</section>
-->
  <!-- Clients-->
  <!--
<div class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 col-sm-6 my-3">
                <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="<?= base_url("assets/img/logos/microsoft.svg") ?>" alt="..." aria-label="Microsoft Logo" /></a>
            </div>
            <div class="col-md-3 col-sm-6 my-3">
                <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="<?= base_url("assets/img/logos/google.svg") ?>" alt="..." aria-label="Google Logo" /></a>
            </div>
            <div class="col-md-3 col-sm-6 my-3">
                <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="<?= base_url("assets/img/logos/facebook.svg") ?>" alt="..." aria-label="Facebook Logo" /></a>
            </div>
            <div class="col-md-3 col-sm-6 my-3">
                <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="<?= base_url("assets/img/logos/ibm.svg") ?>" alt="..." aria-label="IBM Logo" /></a>
            </div>
        </div>
    </div>
</div>
-->

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