<?php
class appointments {
  private$db = '';
  public $id = 0;
  public $dateHour = '';
  public $idPatients = 0;


  public function __construct() {
     try {
        $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'admin_hospitalE2N', 'pwd_8hospitalE2N');
     } catch (Exception $ex) {
        die('Erreur : ' . $ex->getMessage());
     }
}

public function addAppointements(){
  $query = 'INSERT INTO `appointments` (`dateHour`, `idPatients`) '
  . 'VALUE (:dateHour, :idPatients)';
  $queryExecute = $this->db->prepare($query);
  $queryExecute->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
  $queryExecute->bindValue(':idPatients', $this->idPatients, PDO::PARAM_STR);
  return $queryExecute->execute();

  /**
   * Méthode permettant de vérifier que la plage horaire est libre.
   * Retour possible : false -> la requête ne s'est pas exécutée.
   *                   0     -> la plage horaire est disponible.
   *                   1     -> la plage horaire est prise.
   * @return boolean
   */
}
   public function checkFreeAppointments(){
  //On créé une variable de type booléen.
  $isOk = false;
  $query = 'SELECT COUNT(`id`) AS `isFree` FROM `appointments` WHERE `dateHour` = :dateHour';
  $queryExecute = $this->db->prepare($query);
  $queryExecute->bindValue('dateHour', $this->dateHour, PDO::PARAM_STR);
  //Si ma méthode (ici $queryExecute)->execute() = true
  if ($queryExecute->execute()) {
    $result = $queryExecute->fetch(PDO::FETCH_OBJ);
    $isOk = $result->isFree;
    }
    return $isOk;
   }

   public function getAppointmentsList(){

     $query = 'SELECT `a`.`id`, DATE_FORMAT(`a`.`dateHour`, \'%d/%m/%Y %h:%i\' ) AS `dateHour`, UPPER(`p`.`lastname`) AS `lastname`, `p`.`firstname`, DATE_FORMAT(`p`.`birthdate`, \'%d/%m/%Y\') AS `birthdate`, `p`.`phone` '
             . 'FROM `appointments` AS `a` '
             . 'INNER JOIN `patients` AS `p` ON `a`.`idPatients` = `p`.`id` '
             . 'ORDER BY `dateHour`';
    $queryExecute = $this->db->query($query);

    return $queryExecute->fetchAll(PDO::FETCH_OBJ);

  }
  public function getAppointment() {

      $query = 'SELECT `a`.`id`, `a`.`dateHour`, UPPER(`p`.`lastname`) AS `lastname`, `p`.`firstname`, DATE_FORMAT(`p`.`birthdate`, \'%d/%m/%Y\') AS `birthdate`, `p`.`phone`, `p`.`mail`, `idPatients` '
              . 'FROM `appointments` AS `a` '
              . 'INNER JOIN `patients` AS `p` ON `a`.`idPatients` = `p`.`id` '
              . 'WHERE `a`.`id` = :id ';

      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
      $queryExecute->execute();
      return $queryExecute->fetch(PDO::FETCH_OBJ);
  }
  public function modifyAppointment(){

     $query = 'UPDATE `appointments` SET `dateHour` = :dateHour WHERE `id` = :id ';
     $queryExecute = $this->db->prepare($query);
     $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
     $queryExecute->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
     return $queryExecute->execute();
   }

   public function getAppointmentListPatient() {
      $query= 'SELECT DATE_FORMAT(`dateHour`, \'%d/%m/%Y\') AS date,DATE_FORMAT(`dateHour`, \'%Hh%i\') AS `hour` '
              . 'FROM `appointments` '
              . 'WHERE `idPatients` = :idPatients';
      $queryExecute= $this->db->prepare($query);
      $queryExecute->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
      $queryExecute->execute();
      return $queryExecute->fetchAll(PDO::FETCH_OBJ);
   }

   public function __destruct() {
     $this->db = NULL;
   }


 }
 ?>
