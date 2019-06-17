<?php
require 'models/patients.php';
require 'models/appointments.php';
require 'controller/patientProfilCtrl.php';


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pdo2 Exo3</title>
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

    <table>
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>date de naissance</th>
      <th>Age</th>
      <th>Phone</th>
      <th>Mail</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?= $patientProfil->lastname ?></td>
      <td><?= $patientProfil->firstname ?></td>
      <td><?= date('d/m/Y', strtotime($patientProfil->birthdate)) ?></td>
      <td><?= $patientProfil->age ?></td>
      <td><a href="telto:<?= $patientProfil->phone ?>"><?= wordwrap($patientProfil->phone,2,' ',true); ?></a></td>
      <td><a href="mailto:<?= $patientProfil->mail ?>"><?= $patientProfil->mail ?></a></td>
    </tr>
  </tbody>
</table>
<table>
  <thead>
     <tr>
        <th>Dates</th>
        <th>heures</th>
     </tr>
  </thead>
  <tbody>
     <?php foreach ($appointmentsPatient as $appointment) {?>
     <tr>
        <td><?=$appointment->date;?></td>
        <td><?=$appointment->hour;?></td>
     </tr>
     <?php   } ?>
  </tbody>
</table>
    <div class="pres">
      <div class="container">
       <div class="row">
         <div class="col-md-12">
           <div class="row">
           <div class="col-md-8 offset-2">
             <form action="profil-patient.php?id=<?php echo $patients->id ?>" method="POST">
                <fieldset>
                  <legend class="text-center"><h2>Identité</h2></legend>
              <div class="form-group">
                <label for="lastname">Nom</label>
                <input  maxlength="50" autocomplete="on" type="text" required name="lastname" value="<?= isset($formErrors) && count($formErrors) > 0 ? htmlspecialchars($_POST['lastname']) : $patientProfil->lastname ?>" class="form-control bg-transparent"  id="lastname" placeholder="ex : Dupont" />
                <?php if (isset($formErrors['lastname'])) { ?>
                  <div classe="text-danger"><?= $formErrors['lastname'] ?></div>
                <?php } ?>
              </div>
              <div class="form-group">
                <label for="frstName">Prénom</label>
                  <input maxlength="50" autocomplete="on" type="text" required name="firstname" value="<?= isset($formErrors) && count($formErrors) > 0 ? htmlspecialchars($_POST['firstname']) : $patientProfil->firstname ?>" class="form-control bg-transparent" id="firstname" placeholder="ex : Jean" />
                  <?php if (isset($formErrors['firstname'])) { ?>
                    <div classe="text-danger"><?= $formErrors['firstname'] ?></div>
                  <?php } ?>
              </div>
              <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-12">
                  <label for="birthdate">Date de naissance</label>
                  <input type="date" autocomplete="on" required name="birthdate" value="<?= isset($formErrors) && count($formErrors) > 0 ? htmlspecialchars($_POST['birthdate']) : $patientProfil->birthdate ?>" class="form-control" id="birthdate" />
                  <?php if (isset($formErrors['birthdate'])) { ?>
                    <div classe="text-danger"><?= $formErrors['birthdate'] ?></div>
                  <?php } ?>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                  <label for="phone">Numéro de téléphone</label>
                  <input type="text" autocomplete="on" required name="phone" value="<?= isset($formErrors) && count($formErrors) > 0 ? htmlspecialchars($_POST['phone']) : $patientProfil->phone ?>" id="phone" placeholder="01 02 03 04 05" />
                   <?php if (isset($formErrors['phone'])) { ?>
                    <div classe="text-danger"><?= $formErrors['phone'] ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label for="mail">Adresse mail</label>
                <input type="email" class="form-control bg-transparent" name="mail" value="<?= isset($formErrors) && count($formErrors) > 0 ? htmlspecialchars($_POST['mail']) : $patientProfil->mail ?>"id="email" aria-describedby="emailHelp" placeholder="ex : adresse@mail.com" required>
                 <?php if (isset($formErrors['phone'])) { ?>
                    <div classe="text-danger"><?= $formErrors['mail'] ?></div>
                  <?php } ?>
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
