<?php

/**
 * Login
 * Gestione dei Login
 *
 * Classe per la gestione dei Login.
 * Utilizzata per interrogare il 
 * database e richiedere la verifica
 * delle credenziali inserite dagli
 * utenti lato client.
 *
 * @author     Gianluca Bonifazi
 * @category   models 
 * @copyright  STI Uniurb (c) 2017
 */

class Login {

    // Metodo che gestisce i login
    // di tutta l'applicazione
    public static function loginResult($value,$table) {

      $user     = $value['username'];
      $password = $value['password'];
      $result   = FALSE;

      // Provo a fare il login con la vecchia modalità
      if (Login::oldLogin($user,$password,$table)) {
        // Se sono qui l'utente ha inserito delle 
        // credenziali valide ma del vecchio tipo.
        // Per questo motivo faccio una chiamata al
        // metodo che mi aggiorna la password
        // con un nuovo algoritmo di hash.
        Login::updatePassword($user,$password,$table);
        // Login RIUSCITO.
        $result = TRUE;
        // Inserisco un record nella tabella
        // last login avendo effettuato il login
        // correttamente
        Login::lastLogin($user,$table);

      // Provo a fare il login con la nuova modalità
      } else if (Login::newLogin($user,$password,$table)) {
        // Login RIUSCITO.
        $result = TRUE;
        // Inserisco un record nella tabella
        // last login avendo effettuato il login
        // correttamente
        Login::lastLogin($user,$table);

      // Il login è fallito con entrambe le modalità
      } else {
        // Login FALLITO.
        $result = FALSE;
      }

      return $result;
    }

    // Metodo che gestisce il vecchio login
    private static function oldLogin($user,$password,$table) {
      // Valore che deve tornare come 
      // risultato del metodo
      $result = FALSE;

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      // per controllare l'esistenza dell'utente
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query
        $sql = "SELECT ID FROM $table WHERE password = PASSWORD(:password) and username = :username";
        // Preparo la query 
        $stmt = $db->prepare($sql);
        // Eseguo la query
        $stmt->execute(array(':password' => $password, ':username' => $user));
        // Eseguo un fetch per contare le righe
        // del risultato della query.
        $rows = $stmt->fetch(PDO::FETCH_NUM);
        // Se esiste almeno una riga vuol dire che le 
        // credenziali sono corrette e che l'utente esiste.
        $result = ($rows > 0) ? TRUE : FALSE;

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      return $result;
    }

    // Metodo che gestisce il nuovo login
    private static function newLogin($user,$password,$table) {
      // Valore che deve tornare come 
      // risultato del metodo
      $result = FALSE;

      try {

          // Mi collego al Database
          $db = Db::getInstance();
          // Compongo la query
          $sql = "SELECT ID, salt, password FROM $table WHERE username = :username";
          // Preparo la query
          $stmt = $db->prepare($sql);
          // Eseguo la query
          $rows = $stmt->execute(array(':username' => $user));

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '. $ex->getMessage());

      }

      // Faccio il fetch dei dati estratti
      // dalla query. Se $row è FALSE vuol dire
      // che non c'è nessun utente con questo username
      $row = $stmt->fetch();
      if($row) {
          // Utilizzando la password inviata dall'utente
          // e il salt che si trova nel database possiamo 
          // ora controllare se entrambi combaciano con l'hash
          // che abbiamo registrato nel campo password del DB
          $check_password = hash('sha256', $password . $row['salt']);
          for($round = 0; $round < 65536; $round++) {
              $check_password = hash('sha256', $check_password . $row['salt']);
          }
          
          if($check_password === $row['password']) {
              //Login RIUSCITO.
              $result = TRUE;
          }
      }

      return $result;
    }

    // Metodo utilizzato per aggiornare la password con
    // il nuovo algoritmo di sha256
    private static function updatePassword($user,$password,$table) {

      // Il 'salt' è generato casualmente per proteggere
      // il login contro gli attacchi brute force e gli attacchi
      // rainbow table. La seguente istruzione genera un hexadecimal
      // value di un salt ad 8 bit.
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
      $pwd = hash('sha256', $password . $salt);

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

        // PASSWORD e SALT
        // Compongo la query
        $sql = "UPDATE $table SET password = :password, salt = :salt WHERE username = :username";
        // Preparo la query 
        $stmt = $db->prepare($sql);
        // Eseguo la query
        $stmt->execute(array(':password' => $pwd, ':salt' => $salt, ':username' => $user));

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

    }

    // Metodo che gestisce l'insert nella tabella
    // last_login dove sono presenti tutti i dati sulle 
    // ultime attività dell'utente
    private static function lastLogin($user,$table) {

      // Se è un'azienda ad aver fatto il login
      // allora setto la variabile 'type'
      // ad 1. Se invece si tratta di uno studente
      // allora la variabile type sarà 0
      $type = ($table == 'aziende')? 1 : 0;

      // Entro nella sezione critica dove 
      // effetuerò la query di
      // insert per segnare l'ultimo login
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query
        $sql = "INSERT INTO last_login (user_id, ip, last_time, type) VALUES (:user_id, :ip, :last_time, :type)";
        // Preparo la query 
        $stmt = $db->prepare($sql);
        // Eseguo la query
        $stmt->execute(array(':user_id' => $user, ':ip' => Login::getUserIP(), ':last_time' => date("Y-m-d H:i:s"), ':type' => $type));

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

    }

    // Metodo che restiuisce l'indirizzo IP
    // del'utente che sta effettuando il login
    private static function getUserIP() {

      if(array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {

          if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0) {
              $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
              return trim($addr[0]);
          } else {
              return $_SERVER['HTTP_X_FORWARDED_FOR'];
          }

      } else {
          return $_SERVER['REMOTE_ADDR'];
      }

    }

}
?>