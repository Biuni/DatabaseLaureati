<?php
class Login {

    private $loginResult;

    // Funzione che restituisce i dettagli di uno studente
    public static function loginStudenti($value) {

      $pwd_studente   = $value['pwd_studente'];
      $user_studente  = $value['user_studente'];

      // Mi collego al Database
      $db = Db::getInstance();
      // Preparo al query
      $sql = $db->prepare('SELECT ID FROM laureati_tb WHERE Password = PASSWORD(:password) and Username = :username');
      // Una volta preparata la query sostituisco
      // :id con il valore dell'id ricevuto come parametro
      // e la eseguo
      $sql->execute(array(':password' => $pwd_studente, ':username' => $user_studente));
      
      $rows = $sql->fetch(PDO::FETCH_NUM);

      if($rows > 0) {
        $loginResult = true;
      } else {
        $loginResult = false;
      }

      return $loginResult;
    }

}
?>