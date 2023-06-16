<?php 
    helper('html');
    $session = \Config\Services::session();     
    $user = $session->get('user');
?>
<br><br><br><br>
<div class="text-end p-2 mt-2 mb-3">
    <a href="<?= base_url() ?>Coach">
        <?php echo $user->ime.' '.$user->prezime.' '; echo img('assets/img/users/'.$user->poster, false, ['alt' => $user->ime.' '.$user->prezime, 'width' => '30', 'class' => 'img-fluid']); ?>
    </a>
</div>
