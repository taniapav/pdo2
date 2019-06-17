<?php
session_start();
$regexId = '#^[1-9]([0-9]+)?$#';
$regexDate = '#^(2019|(20[2-9][0-9]))-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$#';
$regexHour = '#^([0-1][0-9]|2[0-3])(:)(00|30)$#';
require_once 'models/appointments.php';
require_once 'models/patients.php';
require_once 'controller/rendezvousCtrl.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pdo2 Exo2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/minty/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ajout-patient.php">Inscription</a>
          </li>
        </ul>
      </div>
    </nav>

    <?php if (isset($appointmentPatient) && is_object($appointmentPatient)) {
      ?>
      <table>
        <thead>
          <tr>
            <th>Rendez-vous</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Phone</th>
            <th>Mail</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?= date('d/m/Y H:i', strtotime($appointmentPatient->dateHour)) ?></td>
            <td><?= $appointmentPatient->lastname ?></td>
            <td><?= $appointmentPatient->firstname ?></td>
            <td><?= $appointmentPatient->birthdate ?></td>
            <td><?= wordwrap($appointmentPatient->phone, 2, ' ', true) ?></td>
            <td><?= $appointmentPatient->mail ?></td>
          </tr>
        </tbody>
      </table>
    <?php } else { ?>
    <p>Veuillez vous rapprocher de votre administrateur</p>
    <?php } ?>

    <div class="pres">
      <div class="container">
       <div class="row">
         <div class="col-md-12">
           <div class="row">
           <div class="col-md-8 offset-2">
             <form action="rendezvous.php?id=<?= $appointmentPatient->id ?>" method="POST">
                <fieldset>
                <legend class="text-center"><h2>MODIFIER RDV</h2></legend>
              <div class="form-group">
                <div class="col-lg-6 col-md-6 col-12">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" value="<?= isset($_POST['date']) ? $_POST['date'] : $dateHourArray[0] ?>" />
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <label for="hour">Heures</label>
                <input type="text" name="hour" value="<?= isset($_POST['hour']) ? $_POST['hour'] : $dateHourArray[1] ?>" class="form-control" id="hour" />

                <?php if (isset($formErrors['hour'])) { ?>
                   <div class="invalid-feedback"><?= $formErrors['hour'] ?></div>
                     <?php } ?>
              </div>
                <div class="col-lg-6 col-md-6 col-12">
                <select name="patient" class="form-control" id="patient">
                   <option disabled>Sélectionnez un patient</option>
                   <?php foreach ($patientsList as $patient) { ?>
                   <option <?= ($patient->id == $appointmentPatient->idPatients)? 'selected' : '' ; ?> value="<?= $patient->id ?>"><?= $patient->lastname . ' ' . $patient->firstname . ' ' . $patient->birthdate ?></option>
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
