<?php

require 'models/patients.php';
require 'controller/indexCtrl.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pdo2 Exo1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/minty/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <p>PDO2 exo1</p>

    <div class="pres">
      <div class="container">
       <div class="row">
         <div class="col-md-12">
           <div class="row">
           <div class="col-md-8 offset-2">
            <?php if (count($_POST) == 0 || count($formErrors) > 0) {
              if (isset($formErrors['add'])) {
                        echo $formErrors['add'];
                     }?>
             <form action="ajout-patient.php" method="POST">
                <fieldset>
                  <legend class="text-center"><h2>Identité</h2></legend>
              <div class="form-group">
                <label for="lastname">Nom</label>
                <input  maxlength="50" autocomplete="on" type="text" required name="lastname" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" class="form-control bg-transparent <?= isset($formErrors['lastname']) ? 'is-invalid' : (isset($lastname) ? 'is-valid' : '') ?>" id="lastname" placeholder="ex : Dupont" />
                <?php if (isset($formErrors['lastname'])) { ?>
                  <div class="invalid-feedback"><?= $formErrors['lastname'] ?></div>
                <?php } ?>
              </div>
              <div class="form-group">
                <label for="frstName">Prénom</label>
                  <input maxlength="50" autocomplete="on" type="text" required name="firstname" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>"  class="form-control bg-transparent <?= isset($formErrors['firstname']) ? 'is-invalid' : (isset($firstname) ? 'is-valid' : '') ?>" id="firstname" placeholder="ex : Jean" />
                  <?php if (isset($formErrors['firstname'])) { ?>
                    <div class="invalid-feedback"><?= $formErrors['firstname'] ?></div>
                  <?php } ?>
              </div>
              <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-12">
                  <label for="birthdate">Date de naissance</label>
                  <input type="date" autocomplete="on" required name="birthdate" value="<?= isset($_POST['birthdate']) ? $_POST['birthdate'] : '' ?>" class="form-control" id="birthdate" />
                  <?php if (isset($formErrors['birthdate'])) { ?>
                    <div class="invalid-feedback"><?= $formErrors['birthdate'] ?></div>
                  <?php } ?>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                  <label for="phone">Numéro de téléphone</label>
                  <input type="text" autocomplete="on" required name="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>" class="form-control <?= isset($formErrors['phone']) ? 'is-invalid' : (isset($phoneNumber) ? 'is-valid' : '') ?>" id="phone" placeholder="01 02 03 04 05" />
                  <?php if (isset($formErrors['phone'])) { ?>
                    <div class="invalid-feedback"><?= $formErrors['phone'] ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label for="mail">Adresse mail</label>
                <input type="email" class="form-control bg-transparent" name="mail" id="email" aria-describedby="emailHelp" placeholder="ex : adresse@mail.com" required>
              </div>
              </fieldset>
                <div class="text-center"><input type="submit" name="send" class="btn btn-outline-secondary btContact" value="Envoyer"/></div>
              </form>
            <?php }else {?>
            <div class="">
              <?php if(isset($formSuccess)) {?>
              <p><<?= $formSuccess ?></p>
            <?php } ?>
            </div>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
