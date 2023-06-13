<?php 
    helper('html');
    $session = \Config\Services::session();     
    $user = $session->get('user');   
    
    if (!$user->tip == 2 || !$user->tip == 3) {
        header('Location: ' . base_url());
        exit;
    }    
?>
<br><br><br><br>
<div class="text-end p-2 mt-2 mb-3">
    <a href="<?= base_url() ?>coach">
        <?php echo $user->ime.' '.$user->prezime.' '; echo img('assets/img/users/'.$user->poster, false, ['alt' => $user->ime.' '.$user->prezime, 'width' => '30', 'class' => 'img-fluid']); ?>
    </a>
</div>
