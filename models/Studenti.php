<?php

/**
 * Studenti
 * Model dell'area riservata agli studenti
 *
 * Classe per effettuare richieste al database
 * da parte del controller che gestisce
 * l'area riservata agli studenti laureati
 *
 * @author     Gianluca Bonifazi
 * @category   models 
 * @copyright  STI Uniurb (c) 2017
 */

class Studenti {

    // Metodo che restituisce i dettagli di uno studente
    public static function userData($username) {

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo
        // la password in quanto non utile
        $sql = "SELECT ID, Nome, Cognome, Matricola, CF, Sesso, Data_n, Luogo_n, Prov_n, Luogo_r, Prov_r, Telefono, e_mail, Titolo_tesi, tipologia, Voto_laurea, cum_laude, Data_Laurea, Visibility, Note, relatore, curriculum, CV_download, Tesi_download FROM laureati_tb WHERE username = :username";
        // Preparo la query
        $stmt = $db->prepare($sql);
        // Una volta preparata la query sostituisco
        // :username con il valore dell'username
        // ricevuto come parametro e la eseguo
        $rows = $stmt->execute(array(':username' => $username));

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Prendo il risultato della query
      // e lo ritorno come oggetto
      return $stmt->fetchObject();
    }

    // Metodo utilizzato per l'upload del curriculum
    public static function uploadCV($filename, $username) {

      $result = FALSE;

        // Entro nella sezione critica dove 
        // effetuerò la query di update
        // del curriculum
        try {

          // Mi collego al Database
          $db = Db::getInstance();
          // Compongo la query
          $sql = "UPDATE laureati_tb SET CV_download = :cv_download WHERE username = :username";
          // Preparo la query 
          $stmt = $db->prepare($sql);
          // Eseguo la query
          $stmt->execute(array(':cv_download' => $filename, ':username' => $username));

          $result = TRUE;

        } catch(PDOException $ex) {

          // Errore. Stampo l'eccezione
          die('Errore: '.$sql.' - '.$ex->getMessage());

        }

      return $result;
    }

    // Metodo utilizzato per la modifica dei dati
    public static function updateData($value, $username) {

      $result = FALSE;

      // Mi assicuro che il campo visibility
      // non sia stato manomesso o che sia 
      // stato inserito un valore diverso da 0 o 1
      $visibility = ($value['Visibility'] != 0 && $value['Visibility'] != 1) ? 0 : $value['Visibility'];
      // Metto la provincia in maiuscolo
      $Prov_n = strtoupper($value['Prov_n']);
      $Prov_r = strtoupper($value['Prov_r']);

        // Entro nella sezione critica dove 
        // effetuerò la query di update
        // dei dati
        try {

          // Mi collego al Database
          $db = Db::getInstance();
          // Compongo la query
          $sql = "UPDATE laureati_tb SET Data_n = :Data_n, Sesso = :Sesso, CF = :CF, Luogo_n = :Luogo_n, Prov_n = :Prov_n, Luogo_r = :Luogo_r, Prov_r = :Prov_r, Telefono = :Telefono, e_mail = :e_mail, Note = :Note, Visibility = :Visibility WHERE username = :username";
          // Preparo la query 
          $stmt = $db->prepare($sql);
          // Eseguo la query
          $stmt->execute(array(':Data_n' => $value['Data_n'], ':Sesso' => $value['Sesso'], ':CF' => $value['CF'], ':Luogo_n' => $value['Luogo_n'], ':Prov_n' => $Prov_n, ':Luogo_r' => $value['Luogo_r'], ':Prov_r' => $Prov_r, ':Telefono' => $value['Telefono'], ':e_mail' => $value['e_mail'], ':Note' => $value['Note'], ':Visibility' => $visibility, ':username' => $username));

          $result = TRUE;

        } catch(PDOException $ex) {

          // Errore. Stampo l'eccezione
          die('Errore: '.$sql.' - '.$ex->getMessage());

        }

      return $result;
    }


    // Metodo che fa l'update della password
    public static function updatePwd($pwd_attuale,$pwd_nuova,$username) {

      $result = FALSE;
      // Compongo un array con l'username
      // e la password attuale dello studente
      $value = array('username' => $username, 'password' => $pwd_attuale);

      // Richiedo il modello per il login
      require_once('models/Login.php');

      // Se il login va a buon fine la password
      // è corretta e quindi posso modificarla
      if(Login::loginResult($value,'laureati_tb')){

        // Il 'salt' è generato casualmente per proteggere
        // il login contro gli attacchi brute force e gli attacchi
        // rainbow table. La seguente istruzione genera un hexadecimal
        // value di un salt ad 8 bit. Ciò non porta maggiore sicurezza
        // ma è più facile da leggere per gli umani.
        // Per maggiori informazioni:
        // http://en.wikipedia.org/wiki/Salt_%28cryptography%29
        // http://en.wikipedia.org/wiki/Brute-force_attack
        // http://en.wikipedia.org/wiki/Rainbow_table
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));

        // Creo ora una stringa di hash utilizzando la password concatenato al salt
        // la quale verrà inserita all'interno del database. L'output di questa
        // istruzione è un hexadecimal di 64 byte che rappresenta la stringa a 32
        // byte dell'algoritmo sha256. La password originale è impossibile da estrarre
        // perchè è un algoritmo one-way.
        // Per maggiori informazioni:
        // http://en.wikipedia.org/wiki/Cryptographic_hash_function
        $pwd = hash('sha256', $pwd_nuova . $salt);

        // Successivamente facciamo un ulteriore funzione di hash sull'hash stesso
        // per 65536 volte. Lo scopo di questo passaggio è quello di offrire un'ulteriore
        // protezione contro gli attacchi bruteforce. Infatti ora un'eventuale attacco
        // deve calcolare l'hash 65536 volte per ogni hash.
        for($round = 0; $round < 65536; $round++) {
            $pwd = hash('sha256', $pwd . $salt);
        }

        // Entro nella sezione critica dove 
        // effetuerò la query di update
        // della password
        try {

          // Mi collego al Database
          $db = Db::getInstance();
          // Compongo la query
          $sql = "UPDATE laureati_tb SET password = :new_pwd, salt = :salt WHERE username = :username";
          // Preparo la query 
          $stmt = $db->prepare($sql);
          // Eseguo la query
          $stmt->execute(array(':new_pwd' => $pwd, ':salt' => $salt, ':username' => $username));

          $result = TRUE;

        } catch(PDOException $ex) {

          // Errore. Stampo l'eccezione
          die('Errore: '.$sql.' - '.$ex->getMessage());

        }

      }

      return $result;

    }

}
?>