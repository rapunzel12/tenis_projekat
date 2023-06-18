
<?php

$this->extend('layout');
$this->section('content');

?>
<div class="wrapper_userpicture">
    <div class="container py-5">
       <div class="profile-heading">
         <img src="<?= base_url("assets/img/users/{$_SESSION['user']->poster}") ?>" alt="User Picture" class="profile-picture">
         <h5 class="profile-name"><?php echo $_SESSION['user']->korime ?></h5>
         <p class="profile-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tristique rhoncus ultricies.
         Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tristique rhoncus ultricies
         Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tristique rhoncus ultricies
         </p>
       </div>
       <div class="profile-actions">
         <a href="http://localhost:8080/index.php/Rezervacija" class="btn btn-primary profile-button me-2">REZERVACIJA TERENA</a>
         <a href="http://localhost:8080/index.php/Rezervacija/pregled" class="btn btn-secondary profile-button">PREGLED REZERVACIJE</a>
       </div>
    </div>
    </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>


<?php
$this->endSection();
?>