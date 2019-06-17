<?php
/*Les modèles sont chargé de gérer les données et leur persistance .
Il se comporte comme un portail permettant au reste de l'application d'accéder au données et de les conserver au besoin.
Souvent on associera les modèles à une base de données mais il est tout à fait possible d'avoir des modèles intéragissant avec une API externes (comme twitter par exemple)

Les vues permettent de gérer l'affichage final de nos page.
Elles génèreront le code HTML qui sera affiché aux utilisateurs à partir des variables récupérées depuis le controller.

Le controller est le dernier élément de la structure MVC et c'est aussi l'élément liant.
Il va s'occupper de recevoir les données entrées par l'utilisateur et de communiquer les changements aux modèles.
Il pourra aussi communiquer avec les modèles pour obtenir des informations qu'il pourra ensuite transférer à la vue.*/

  class patients {

    private $db = NULL;
    public $id = 0;
    public $lastname = '';
    public $firstname = '';
    public $birthdate = '1970-01-01';
    public $phone = '';
    public $mail = '';

  public function __construct() {

      try{
    /*Se connecter à MySQL avec PDO*/
      	$this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'admin_hospitalE2N', 'pwd_8hospitalE2N');
        /*En cas d'erreur, PDO renvoie ce qu'on appelle une exception qui permet de « capturer » l'erreur.*/
      }  catch (Exception $e) {
    /*Tester la présence d'erreurs*/
         die('Erreur : ' . $e->getMessage());
      }
    }

    public function addPatient(){
       $query = 'INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`) '
               . 'VALUES (:lastname, :firstname, :birthdate, :phone, :mail)';
       $queryExecute = $this->db->prepare($query);

       $queryExecute->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
       $queryExecute->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
       $queryExecute->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
       $queryExecute->bindValue(':phone', $this->phone, PDO::PARAM_STR);
       $queryExecute->bindValue(':mail', $this->mail, PDO::PARAM_STR);
       return $queryExecute->execute();
    }

      public function getPatientsList(){

     $query = 'SELECT  UPPER(`lastname`) AS `lastname`, `firstname`, DATE_FORMAT(`birthdate`, \'%d/%m/%Y\') AS `birthdate`, `phone`, `mail`, `id`, FLOOR(DATEDIFF(NOW(), `birthdate`)/365) AS `age` '
            . 'FROM `patients`';
      //$this->db->query($query) me permet d'executer ma requête (query($query)) dans ma base de données ($this->db)
      $queryExecute = $this->db->query($query);
      /*
     * fetchAll me permet de récupérer tous les résultats en objet (PDO::FETCH_OBJ)
     * Attention : fetchAll récupère un tableau de résultats
     */
      return $queryExecute->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPatientProfil(){

      $query = 'SELECT `id`, UPPER(`lastname`) AS `lastname`, `firstname`, `birthdate`, `phone`, `mail`, FLOOR(DATEDIFF(NOW(), `birthdate`)/365) AS `age` '
              . 'FROM `patients` '
              . 'WHERE `id` =  :id ';
      $queryExecute = $this->db->prepare($query);
      $queryExecute->bindValue(':id',$this->id, PDO::PARAM_INT) ;
      $queryExecute->execute();
      return $queryExecute->fetch(PDO::FETCH_OBJ);
    }



     public function modifyPatient(){


      $query = 'UPDATE patients SET lastname= :lastname, firstname= :firstname, birthdate= :birthdate, phone= :phone, mail= :mail '
      . 'WHERE id = :id ';

       $queryExecute = $this->db->prepare($query);
       $queryExecute->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
       $queryExecute->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
       $queryExecute->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
       $queryExecute->bindValue(':phone', $this->phone, PDO::PARAM_STR);
       $queryExecute->bindValue(':mail', $this->mail, PDO::PARAM_STR);
       $queryExecute->bindValue(':id',$this->id, PDO::PARAM_INT) ;

       $queryExecute->execute();
       return $queryExecute->fetch(PDO::FETCH_OBJ);
     }

    public function __destruct() {
      $this->db = NULL;
    }
  }

 ?>
