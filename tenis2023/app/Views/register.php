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
            <h2 class="section-heading text-uppercase">Registruj se</h2>
            
            <br>
            <form action="<?=site_url("Register/register") ?>" method="post">

                <label for="text" class="form-label" >Ime: </label>
                <input type="text" class="form-control" name="name">
                <br>

                <label for="text" class="form-label" >Prezime: </label>
                <input type="text" class="form-control" name="lastname">
                <br>

                <label for="text" class="form-label" >Korisničko ime: </label>
                <input type="text" class="form-control" name="username">
                <br>

                <label for="password" class="form-label" >Šifra: </label>
                <input type="password" class="form-control" name="password">
                <br>

                <label for="email" class="form-label" >E-mail: </label>
                <input type="email" class="form-control" name="email">
                <br>

                <label for="tel" class="form-label" >Broj telefona: </label>
                <input type="tel" class="form-control" name="tel">
                <br>

                <label for="" class="form-label" >Tip korisnika:</label>
                <select class="form-control" name="user_type">
                    <option value="">Izaberi tip naloga</option>
                    <option value="1">rekreativac</option>
                    <option value="2">učenik</option>
                    <option value="3">trener</option>
                    <option value="4">administrator</option>
                </select>
                <br>

                <label for="poster" class="form-label">Fotografija</label>
                <input type="file" class="form-control" name="poster" accept="image/*">
                <br/>

                <button type="submit" class="btn btn-primary">Registruj se</button>




            </form>
        </div>
</div>


<?php
$this->endSection();
?>