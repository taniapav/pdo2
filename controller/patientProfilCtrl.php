<?php
$regexName = '#^([A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+)([- ]{1}[A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+){0,1}$#';
$regexBirthDate = '#^(((19|20)[0-9]{2})\-{1}(0[1-9]{1}|1[0-2]{1})\-(0[1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1}))$#';
$regexPhoneNumber =  '#^[0][1-9][0-9]{8}$#';
$regexMail = '#^([a-zA-Z0-9À-ÖØ-öø-ÿ\.\-\_]+)@([a-zA-Z0-9À-ÖØ-öø-ÿ\-\_\.]+)\.([a-zA-Z\.]{2,250})$#';
$regexId = '/^[1-9]([]0-9]+)?$/';
$patients = new patients();
$appointments = new appointments();


if(!empty($_GET['id'])){
  if (preg_match($regexId, $_GET['id'])){
  $patients->id = htmlspecialchars($_GET['id']);
  //On récupére l'id en paramétre d'url pour l'affecter à l'attribut de l'instance appointments
//et on appelle la méthose qui affichera tous les rdv par patient
$appointments->idPatients = htmlspecialchars($_GET['id']);
$appointmentsPatient = $appointments->getAppointmentListPatient();

  }
 if(count($_POST) > 0){
   $formErrors = array();
    if(!empty($_POST['lastname'])){
      if (preg_match($regexName, $_POST['lastname'])){
        $patients->lastname=htmlspecialchars($_POST['lastname']);
      }else{
        $formErrors['lastname'] = 'Merci de renseigner un nom de famille valide';
      }
    }else{
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
        $patients->birthdate =  htmlspecialchars($_POST['birthdate']);
    } else {
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

      $patients->modifyPatient();
    }
  }
    $patientProfil = $patients->getPatientProfil();

 }else{
   header('location:liste-patients.php');
   exit;
 }

?>
