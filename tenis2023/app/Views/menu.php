


<li class="nav-item"><?= anchor("Main/index", "O nama", ["class"=>"nav-link"] ) ?></li>
<li class="nav-item"><?= anchor("Main/viewTenisCourts", "Teniski tereni", ["class"=>"nav-link"] ) ?></li>
<li class="nav-item"><?= anchor("Main/viewTenisCoaches", "Treneri", ["class"=>"nav-link"] ) ?></li>
<li class="nav-item"><?= anchor("Main/price", "Cenovnik", ["class"=>"nav-link"] ) ?></li>
<li class="nav-item"><?= anchor("Main/viewAdmins", "Administratori", ["class"=>"nav-link"] ) ?></li>

<?php if(!session()->has('user')) { ?>
<li class="nav-item"><?= anchor("Guest/showRegistration", "Registruj se", ["class"=>"nav-link"] ) ?></li>
<li class="nav-item"><?= anchor("Guest/viewLogin", "Uloguj se", ["class"=>"nav-link"] ) ?></li>

<?php } else { ?>

<li class="nav-item"><?= anchor('User/index', 'Moj profil', ["class"=>"nav-link"] ) ?></li>
<li class="nav-item"><?= anchor('User/logout', 'Odjava', ["class"=>"nav-link"] ) ?></li>

<?php } ?>