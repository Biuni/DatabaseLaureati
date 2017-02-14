<?php

class Studenti {

    // Funzione che restituisce i dettagli di uno studente
    public static function userData($username) {

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo la password
        // in quanto non utile
        $sql = "SELECT ID, Nome, Cognome, Matricola, CF, Sesso, Data_n, Luogo_n, Prov_n, Luogo_r, Prov_r, Telefono, e_mail, Titolo_tesi, tipologia, Voto_laurea, cum_laude, Data_Laurea, Visibility, Note, relatore, curriculum, CV_download, Tesi_download FROM laureati_tb WHERE username = :username";
        // Preparo la query
        $stmt = $db->prepare($sql);
        // Una volta preparata la query sostituisco
        // :username con il valore dell'username
        // ricevuto come parametro e la eseguo
        $rows = $stmt->execute(array(':username' => $username));

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Prendo il risultato della query
      // e lo ritorno come oggetto
      return $stmt->fetchObject();
    }

}
?>