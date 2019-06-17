<?php

//On créé un tableau de créneau horaires.
$hours = array('09', '10', '11', '15', '16');
//On créé un tableau d'erreurs
$formErrors = array();
//On instancie un objet.
$patients = new patients();
$patientsList = $patients->getPatientsList();

if (count($_POST) > 0) {
  //J'instancie l'objet appointments.
  $appointments = new appointments();
  if (!empty($_POST['date'])) {
    if (preg_match($regexDate, $_POST['date'])) {
      $date = htmlspecialchars($_POST['date']);
    } else {
      $formErrors['date'] = 'Merci de saisir une date valide.';
    }
  } else {
    $formErrors['date'] = 'Merci de remplir la date.';
  }

  if (!empty($_POST['hour'])) {
    if (preg_match($regexHour, $_POST['hour'])) {
      $hour = htmlspecialchars($_POST['hour']);
    } else {
      $formErrors['hour'] = 'Merci de saisir une heure valide.';
    }
  } else {
    $formErrors['hour'] = 'Merci de remplir l\'heure.';
  }

  if (!empty($_POST['patient'])) {
    if (preg_match($regexId, $_POST['patient'])) {
      $patient = htmlspecialchars($_POST['patient']);
    } else {
      $formErrors['patient'] = 'Merci de sélectionner un patient';
    }
  } else {
    $formErrors['patient'] = 'Merci de sélectionner un patient.';
  }
//S'il n'y a pas d'erreur dans le formulaire, j'insère dans la base:
  if (count($formErrors) == 0) {
    $appointments->dateHour = $date . ' ' . $hour;
    $check = $appointments->checkFreeAppointments();
    if ($check === false) {
      $formErrors['check'] = 'Une erreur est survenue.';
    } elseif ($check > 0) {
      $formErrors['check'] = 'Le randez-vous n\'est pas disponible.';
    } else {
      $appointments->idPatients = $patient;
      if ($appointments->addAppointements()) {
        $formSuccess = 'Le randez-vous a bien été enregistré.';
      } else {
        $formErrors['add'] = 'Une erreur est survenue';
      }
    }
  }
}

?>
