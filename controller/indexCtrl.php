<?php

$regexName = '#^([A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+)([- ]{1}[A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+){0,1}$#';
$regexBirthDate = '#^(((19|20)[0-9]{2})\-{1}(0[1-9]{1}|1[0-2]{1})\-(0[1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1}))$#';
$regexPhoneNumber =  '#^[0][1-9][0-9]{8}$#';
$regexMail = '#^([a-zA-Z0-9À-ÖØ-öø-ÿ\.\-\_]+)@([a-zA-Z0-9À-ÖØ-öø-ÿ\-\_\.]+)\.([a-zA-Z\.]{2,250})$#';
$formErrors = array();
  if (count($_POST) > 0) {
  $patients = new patients();

    if (!empty($_POST['lastname'])) {

      if (preg_match($regexName, $_POST['lastname'])) {
        //On utilise la fonction htmlspecialchars pour supprimer les éventuelles balises html => on a aucun intérêt à garder une balise html dans ce champs
        $patients->lastname = htmlspecialchars($_POST['lastname']);
      } else {
        $formErrors['lastname'] = 'Merci de renseigner un nom de famille valide';
      }
    } else {
      $formErrors['lastname'] = 'Merci de renseigner votre nom de famille';
    }

    if (!empty($_POST['firstname'])) {
      if (preg_match($regexName, $_POST['firstname'])) {
        $patients->firstname = htmlspecialchars($_POST['firstname']);
      } else {
        $formErrors['firstname'] = 'Merci de renseigner un prénom valide';
      }
    } else {
      $formErrors['firstname'] = 'Merci de renseigner votre prénom';
    }

    if (!empty($_POST['birthdate'])) {
      if(preg_match($regexDate, $_POST[birthdate])) {
        $patients->birthdate =  htmlspecialchars($_POST['birthdate']);
    } else {
      $formErrors['birthdate'] = 'Merci de renseigner votre date de naissance';
    }
    }else {
      $formErrors['birthdate'] = 'Merci de renseigner votre date de naissance';
    }

    if (!empty($_POST['phone'])) {
      if (preg_match($regexPhoneNumber, $_POST['phone'])) {
        $patients->phone =  htmlspecialchars($_POST['phone']);
      } else {
        $formErrors['phone'] = 'Merci de renseigner un numéro de téléphone valide';
      }
    } else {
      $formErrors['phone'] = 'Merci de renseigner votre numéro de téléphone';
    }

    if (!empty($_POST['mail'])) {
      if (preg_match($regexMail, $_POST['mail'])) {
        $patients->mail =  htmlspecialchars($_POST['mail']);
      } else {
        $formErrors['mail'] = 'Merci de renseigner un mail valide';
      }
    } else {
      $formErrors['mail'] = 'Merci de renseigner votre mail';
    }

    if(count($formErrors) == 0){
      if($patients->addPatient()){
        $phoneSuccess = 'Energistement effectué';
      }else{
        $formSuccess['add'] = 'Une erreur est survenu';
     }
    }
  }

 ?>
