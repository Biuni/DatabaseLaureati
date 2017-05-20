<?php

/**
 * Aziende
 * Gestione dell'area riservata
 * alle aziende
 *
 * Classe per effettuare richieste al database
 * da parte del controller che gestisce
 * l'area riservata alle aziende registrate
 *
 * @author     Gianluca Bonifazi
 * @category   models 
 * @copyright  STI Uniurb (c) 2017
 */

class Aziende {

    // Metodo che restiuisce l'intera
    // lista di studenti
    public static function getList() {

      // Inizializzo un array vuoto
      $list = [];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo i campi
        // non visualizzati sulla tabella
        $sql = "SELECT ID, Nome, Cognome, Titolo_tesi, Voto_laurea, Data_Laurea, cum_laude FROM laureati_tb WHERE Visibility = 1";
        // Eseguo la query
        $stmt = $db->query($sql);
        // Per ogni risultato della query
        // vado ad inserire nell'array
        // $list i dati di ogni studente
        foreach($stmt->fetchAll() as $student) {
          $list[] = $student;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Ritorno l'array con tutti
      // i dati degli studenti
      return $list;
    }


    // Metodo che restiuisce la lista
    // di Curriculum del CdL
    public static function getCv() {

      // Inizializzo un array vuoto
      $list = [];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query
        $sql = "SELECT id, nome FROM curriculum";
        // Eseguo la query
        $stmt = $db->query($sql);
        // Per ogni risultato della query
        // vado ad inserire nell'array
        // $list il nome e l'id del curriculum
        foreach($stmt->fetchAll() as $cv) {
          $list[] = $cv;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Ritorno l'array con tutti
      // i curriculum del CdL
      return $list;
    }

    // Metodo che restiuisce la lista dei laureati
    // basata sulla ricerca avanzata
    public static function advancedSearch($clean_value) {

      // Inizializzo un array vuoto
      // per stampare i risultati
      $list = [];
      // Inizializzo un array vuoto 
      // per gestire i parametri richiesti
      $params = [];

      $voto_laurea = $clean_value['voto_laurea'];
      $anno_laurea = $clean_value['anno_laurea'];
      $anno_nascita = $clean_value['anno_nascita'];
      $provincia = strtoupper($clean_value['provincia']);
      $curriculum = $clean_value['curriculum'];
      $cognome = $clean_value['cognome'];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo i campi
        // a seconda dei valori ricevuti in $_POST
        $sql = "SELECT ID, Nome, Cognome, Titolo_tesi, Voto_laurea, Data_Laurea, cum_laude FROM laureati_tb WHERE Visibility = 1";

        if ($voto_laurea != '') {
          $sql .= " AND Voto_laurea >= :voto_laurea";
          $params[':voto_laurea'] = $voto_laurea;
        }
        if ($anno_laurea != '') {
          $sql .= " AND Data_laurea >= :anno_laurea";
          $params[':anno_laurea'] = $anno_laurea;
        }
        if ($anno_nascita != '') {
          $sql .= " AND Data_n >= :anno_nascita";
          $params[':anno_nascita'] = $anno_nascita;
        }
        if ($provincia != '') {
          $sql .= " AND Prov_r = :provincia";
          $params[':provincia'] = $provincia;
        }
        if ($curriculum != '') {
          $sql .= " AND curriculum = :curriculum";
          $params[':curriculum'] = $curriculum;
        }
        if ($cognome != '') {
          $sql .= " AND cognome LIKE :cognome";
          $params[':cognome'] = '%'.$cognome.'%';
        }

        // Preparo la query
        $stmt = $db->prepare($sql);
        // Una volta preparata la query sostituisco
        // :value con il valore corrispondete
        // ricevuto come parametro e la eseguo
        $rows = $stmt->execute($params);
        // Per ogni risultato della query
        // vado ad inserire nell'array
        // $list i suoi dati
        foreach($stmt->fetchAll() as $student) {
          $list[] = $student;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Ritorno l'array con tutti
      // i dati degli studenti
      return $list;
    }

    // Metodo che restituisce i dettagli di uno studente
    public static function showDetails($id) {

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo la password
        // e il campo visibility in quanto non utile
        $sql = "SELECT ID, Nome, Cognome, Matricola, CF, Sesso, Data_n, Luogo_n, Prov_n, Luogo_r, Prov_r, Telefono, e_mail, Titolo_tesi, tipologia, Voto_laurea, cum_laude, Data_Laurea, Note, relatore, curriculum, CV_download, Tesi_download FROM laureati_tb WHERE id = :id";
        // Preparo la query
        $stmt = $db->prepare($sql);
        // Una volta preparata la query sostituisco
        // :id con il valore dell'id
        // ricevuto come parametro e la eseguo
        $rows = $stmt->execute(array(':id' => $id));

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Prendo il risultato della query
      // e lo ritorno come oggetto
      return $stmt->fetchObject();
    }

    // Metodo che fa l'update dell'username
    public static function updateUser($new,$old) {

      $result = FALSE;

      // Entro nella sezione critica dove 
      // effetuerò la query di update
      // dell'username dell'azienda
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query
        $sql = "UPDATE aziende SET username = :new_user WHERE username = :old_user";
        // Preparo la query 
        $stmt = $db->prepare($sql);
        // Eseguo la query
        $stmt->execute(array(':new_user' => $new,':old_user' => $old));

        $result = TRUE;

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      return $result;

    }

    // Metodo che controlla se l'username esiste già
    public static function checkIfExist($new){

      $result = FALSE;

      // Entro nella sezione critica dove 
      // effetuerò la query per controllare
      // che l'username non è già in uso
      try {

          // Mi collego al Database
          $db = Db::getInstance();
          // Compongo la query
          $sql = "SELECT ID FROM aziende WHERE username = :username";
          // Preparo la query 
          $stmt = $db->prepare($sql);
          // Eseguo la query
          $stmt->execute(array(':username' => $new));
          // Eseguo un fetch per contare le righe
          // del risultato della query.
          $rows = $stmt->fetch(PDO::FETCH_NUM);
          // Se esiste almeno una riga vuol dire che le 
          // username è già utilizzato
          $used = ($rows > 0) ? TRUE : FALSE;

          // Se esiste l'username il risultato e FALSE
          // altrimenti setto il risultato a TRUE
          if (!$used) {
            $result = TRUE;
          }

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
      // e la password attuale dell'azienda
      $value = array('username' => $username, 'password' => $pwd_attuale);

      // Richiedo il modello per il login
      require_once('models/Login.php');

      // Se il login va a buon fine la password
      // è corretta e quindi posso modificarla
      if(Login::loginResult($value,'aziende')){

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
          $sql = "UPDATE aziende SET password = :new_pwd, salt = :salt WHERE username = :username";
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