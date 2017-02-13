<?php
  class Studenti {

    // Funzione che restituisce i dettagli di uno studente
    public static function userData($username) {
      // Mi collego al Database
      $db = Db::getInstance();
      // Preparo al query
      $sql = $db->prepare('SELECT ID, Nome, Cognome, Matricola, CF, Sesso, Data_n, Luogo_n, Prov_n, Luogo_r, Prov_r, Telefono, e_mail, Titolo_tesi, tipologia, Voto_laurea, cum_laude, Data_Laurea, Visibility, Note, relatore, curriculum, CV_download FROM laureati_tb WHERE username = :username');
      // Una volta preparata la query sostituisco
      // :id con il valore dell'id ricevuto come parametro
      // e la eseguo
      $sql->execute(array('username' => $username));
      // Ritorno il risultato della query come oggetto
      return $sql->fetchObject();
    }

  }
?>