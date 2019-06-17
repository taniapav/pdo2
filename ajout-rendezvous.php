<?php
$regexId = '#^[1-9]([0-9]+)?$#';
$regexDate = '#^(2019|(20[2-9][0-9]))-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$#';
$regexHour = '#^([0-1][0-9]|2[0-3])(:)(00|30)$#';
$regexTime = '#^([0-1][0-9]|2[0-3])(:)([0-5][0-9]):[0-5][0-9]$#';
require 'models/patients.php';
require 'models/appointments.php';
require 'controller/ajoutrdvCtrl.php';

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
    <p>Ajout RDV</p>
    <div class="pres">
      <div class="container">
       <div class="row">
         <div class="col-md-12">
           <div class="row">
           <div class="col-md-8 offset-2">
            <?php if (isset($formErrors['add'])) { ?>
               <p><?= $formErrors['add'] ?></p>
               <?php } elseif (isset($formSuccess)) { ?>
               <p><?= $formSuccess ?></p>
            <?php } ?>
             <form action="ajout-rendezvous.php" method="POST">
                <fieldset>
                <legend class="text-center"><h2>Ajout RDV</h2></legend>
              <div class="form-group">
                <div class="col-lg-6 col-md-6 col-12">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" />
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <label for="hour">Heures</label>
                <select name="hour" class="form-control" id="hour">
                   <option value="0" disabled selected>Choisissez une heure de rendez-vous</option>
                   <?php foreach ($hours as $hour) { ?>
                      <option value="<?= $hour . ':00' ?>"><?= $hour . 'h00' ?></option>
                      <option value="<?= $hour . ':30' ?>"><?= $hour . 'h30' ?></option>
                    <?php } ?>
                </select>
                <?php if (isset($formErrors['hour'])) { ?>
                   <div class="invalid-feedback"><?= $formErrors['hour'] ?></div>

                <?php } elseif (isset($formErrors['check'])) { ?>
                   <div class="invalid-feedback"><?= $formErrors['check'] ?></div>
                <?php } ?>
              </div>
                <div class="col-lg-6 col-md-6 col-12">
                <select name="patient" class="form-control" id="patient">
                   <option disabled selected>Sélectionnez un patient</option>
                   <?php foreach ($patientsList as $patient) { ?>
                  <option value="<?= $patient->id ?>"><?= $patient->lastname . ' ' . $patient->firstname . ' ' . $patient->birthdate ?></option>
                  <?php } ?>
                  </select>
                  </div>
                 </div>
                </fieldset>
              <div class="text-center"><input type="submit" name="send" class="btn btn-outline-secondary btContact" value="Envoyer"/></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
