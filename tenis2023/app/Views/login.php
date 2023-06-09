<?php



$this->extend('layout');
$this->section('content');
?>



    <div class="masthead container">
        <div class="row">
        <div class="col-sm-6">
        <br>
        <br>
        <br>
        <br>
            <h2 class="section-heading text-uppercase">Uloguj se</h2>
            
            <br>
            <?php $session = \Config\Services::session(); ?>
            <?= $session->getFlashdata('msg') ?>
            <?= $session->getFlashdata('errors') ?>
            <br>
            <form action="<?=site_url("Guest/login") ?>" method="post">
                <label for="text" class="form-label">Korisničko ime: </label>
                <input type="text" class="form-control" name="username" 
                    placeholder="Unesite svoje ime..." value="<?= old('username') ?>">
                <br>

                <label for="password" class="form-label" >Šifra: </label>
                <input type="password" class="form-control" name="password" 
                    placeholder="Unesite svoju šifru..."  value="<?= old('password') ?>">
                <br>

                <label for="user_type" class="form-label" >Tip korisnika:</label>
                <select class="form-select" name="user_type" >
                    <option selected disabled hidden value="">Izaberite...</option>
                    <option value="0" <?= set_select('user_type', '0')?> >rekreativac</option>
                    <option value="1" <?= set_select('user_type', '1')?> >učenik</option>
                    <option value="2" <?= set_select('user_type', '2')?> >trener</option>
                    <option value="3" <?= set_select('user_type', '3')?> >administrator</option>
                </select>
                <br>

                <button type="submit" class="btn btn-primary">Uloguj se</button>


            </form>
        </div>
</div>
<br>
        <br>
        <br>
        <br>
        <!-- * * * * * * * * * * * * * * *-->
        <!-- * * SB Forms Contact Form * *-->
        <!-- * * * * * * * * * * * * * * *-->
        <!-- This form is pre-integrated with SB Forms.-->
        <!-- To make this form functional, sign up at-->
        <!-- https://startbootstrap.com/solution/contact-forms-->
        <!-- to get an API token!-->
        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" id="name" type="text" placeholder="Your Name *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                    </div>
                    <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                    </div>
                    <div class="form-group mb-md-0">
                        <!-- Phone number input-->
                        <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-textarea mb-md-0">
                        <!-- Message input-->
                        <textarea class="form-control" id="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                        <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                    </div>
                </div>
            </div>
            <!-- Submit success message-->
            <!---->
            <!-- This is what your users will see when the form-->
            <!-- has successfully submitted-->
            <div class="d-none" id="submitSuccessMessage">
                <div class="text-center text-white mb-3">
                    <div class="fw-bolder">Form submission successful!</div>
                    To activate this form, sign up at
                    <br />
                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                </div>
            </div>
            <!-- Submit error message-->
            <!---->
            <!-- This is what your users will see when there is-->
            <!-- an error submitting the form-->
            <div class="d-none" id="submitErrorMessage">
                <div class="text-center text-danger mb-3">Error sending message!</div>
            </div>
            <!-- Submit Button-->
            <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled" id="submitButton" type="submit">Send Message</button></div>
        </form>
    </div>













<?php
$this->endSection();
?>