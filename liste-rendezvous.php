<?php
require_once 'models/patients.php';
require 'models/appointments.php';
require 'controller/addAppointmentCtrl.php';
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

<table>
  <thead>
    <tr>
    <!-- <th><a href="ajout-rendezvous.php?id=<?php echo $appointmentPatient->id; ?>">Création de RDV</a></th> -->
      <th>Date/Heur RDV</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Date de naissance</th>
      <th>Phone</th>
      <th>CREER RDV</th>
      <th> VOIR RDV</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($appointmentsList as $appointmentPatient) { ?>
    <tr>
      <td><?= $appointmentPatient->dateHour ?></td>
      <td><?= $appointmentPatient->lastname ?></td>
      <td><?= $appointmentPatient->firstname ?></td>
      <td><?= $appointmentPatient->birthdate ?></td>
      <td><?= wordwrap($appointmentPatient->phone, 2, ' ', true) ?></td>
      <td><a href="ajout-rendezvous.php?id=<?php echo $appointmentPatient->id; ?>">Création de RDV</a></td>
      <td><a href="rendezvous.php?id=<?php echo $appointmentPatient->id; ?>">Rendez-vous</a></td>

    </tr>
  <?php } ?>
  </tbody>
</table>
  </body>
</html>
