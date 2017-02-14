<?php

class Registrazione {

    // Metodo che gestisce la 
    // registrazione dell'azienda
    public static function joinAzienda($value) {

      $result           = FALSE;

      $ragionesociale   = $value['ragionesociale'];
      $nomereferente    = $value['nomereferente'];
      $cognomereferente = $value['cognomereferente'];
      $emailreferente   = $value['emailreferente'];
      $newsletter       = ($value['newsletter'] == 'on') ? 'Si': 'No';

      // Creo una stringa alfanumerica da usare come
      // password con una lunghezza di 8 caratteri.
      $password = substr(md5(uniqid(rand(), true)), 0, 8);
      // Creo un username dalla ragione sociale
      // Rendo tutto minuscolo e tolgo caratteri
      // non utilizzabili come username
      $username = str_replace(' ', '-', $ragionesociale);
      $username = str_replace('.', '', $username);
      $username = strtolower($username);

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
      $pwd = hash('sha256', $password . $salt);

      // Successivamente facciamo un ulteriore funzione di hash sull'hash stesso
      // per 65536 volte. Lo scopo di questo passaggio è quello di offrire un'ulteriore
      // protezione contro gli attacchi bruteforce. Infatti ora un'eventuale attacco
      // deve calcolare l'hash 65536 volte per ogni hash.
      for($round = 0; $round < 65536; $round++) {
          $pwd = hash('sha256', $pwd . $salt);
      }


      // Entro nella sezione critica dove 
      // effetuerò la query di insert
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query
        $sql = "INSERT INTO aziende (r_sociale, nome, cognome, email, newsletter, username, password, salt) VALUES (:r_sociale, :nome, :cognome, :email, :newsletter, :username, :password, :salt)";
        // Preparo la query 
        $stmt = $db->prepare($sql);
        // Eseguo la query
        $stmt->execute(array(
          ':r_sociale' => $ragionesociale,
          ':nome' => $nomereferente,
          ':cognome' => $cognomereferente,
          ':email' => $emailreferente,
          ':newsletter' => $newsletter,
          ':username' => $username,
          ':password' => $pwd,
          ':salt' => $salt
        ));

        // Richiedo al classe PHPMailer
        // per l'invio di email tramite PHP
        require_once('config/phpmailer.php');
        // Invio la mail con i dati dell'azienda
        // e se l'invio va a buon fine allora ritorno
        // TRUE nel risultato del metodo
        if (PHPMailer::sendMail($value,$username,$password)) {
          $result = TRUE;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      return $result;
    }

}
?>