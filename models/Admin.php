<?php

/**
 * Admin
 * Gestione dell'area riservata
 * al gestore del portale
 *
 * Classe per effettuare richieste al database
 * da parte del controller che gestisce
 * l'area riservata all'amministratore
 *
 * @author     Gianluca Bonifazi
 * @category   models 
 * @copyright  STI Uniurb (c) 2017
 */

class Admin {
        
    // Metodo che restituisce le informazioni
    // sull'ultimo login dell'amministratore
    public static function lastLogin() {

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query
        $sql = "SELECT last_update, ip FROM admin WHERE id = 1";
        // Preparo la query
        $stmt = $db->prepare($sql);
        // Una volta preparata la query la eseguo
        $rows = $stmt->execute();

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Prendo il risultato della query
      // e lo ritorno come oggetto
      return $stmt->fetchObject();
    }
        
    // Metodo che restituisce le informazioni
    // sui login delle aziende negli ultimi 7 giorni
    public static function lastLoginAziende($last) {

      $list = [];
      $date = [];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query
        $sql = "SELECT last_time FROM last_login WHERE DATE(last_time) > (NOW() - INTERVAL 7 DAY) AND type = 1 ORDER BY last_time ASC";
        // Preparo la query
        $stmt = $db->prepare($sql);
        // Una volta preparata la query la eseguo
        $rows = $stmt->execute();

        // Per ogni valore estratto dal database
        // mi leggo la data e lo inserisco un array
        // che mi servirà per fare il confronto
  	    foreach ($stmt->fetchAll() as $value) {
    	    $data = substr($value['last_time'],0,10);
    			$date[] = $data;
  	    }

  	    // Conto quante volte la data si ripete,
  	    // cioè quanti login sono stati effettuati
  	    // nello stesso giorno
        $occurences = array_count_values($date);

        // Ciclo l'array contenente i login
        // degli ultimi sette giorni
    		for ($i=0; $i < count($last); $i++) { 

    			// Se esiste una data con il valore uguale a quello
    			// del giorno inserito nell'array $last scrivo
    			// il numero altrimenti è zero e cioè non ci sono stati login
    			if (array_key_exists($last[$i], $occurences)) {
            $list[] = $occurences[$last[$i]];
    			} else {
            $list[] = 0;
    			}

    		}

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Prendo il risultato della query
      // e lo ritorno come array
      return $list;
    }
        
    // Metodo che restituisce le informazioni
    // sui login delgli studenti negli ultimi 7 giorni
    public static function lastLoginStudenti($last) {

      $list = [];
      $date = [];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query
        $sql = "SELECT last_time FROM last_login WHERE DATE(last_time) > (NOW() - INTERVAL 7 DAY) AND type = 0 ORDER BY last_time ASC";
        // Preparo la query
        $stmt = $db->prepare($sql);
        // Una volta preparata la query la eseguo
        $rows = $stmt->execute();

        // Per ogni valore estratto dal database
        // mi leggo la data e lo inserisco un array
        // che mi servirà per fare il confronto
  	    foreach ($stmt->fetchAll() as $value) {
    	    $data = substr($value['last_time'],0,10);
    			$date[] = $data;
  	    }

  	    // Conto quante volte la data si ripete,
  	    // cioè quanti login sono stati effettuati
  	    // nello stesso giorno
        $occurences = array_count_values($date);

        // Ciclo l'array degli ultimi sette giorni
    		for ($i=0; $i < count($last); $i++) { 

    			// Se esiste una data con il valore uguale a quello
    			// del giorno inserito nell'array $last scrivo
    			// il numero altrimenti è zero e cioè non ci sono stati login
    			if (array_key_exists($last[$i], $occurences)) {
            $list[] = $occurences[$last[$i]];
    			} else {
    				$list[] = 0;
    			}

    		}

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Prendo il risultato della query
      // e lo ritorno come array
      return $list;
    }
        
    // Metodo che restituisce le informazioni
    // sull'andamento generale dei voti di laurea
    public static function votoLaurea() {

      $list = [];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query
        $sql = "SELECT COUNT(ID) AS numero FROM laureati_tb WHERE Voto_laurea > 66 AND Voto_laurea <= 80";
        $count = $db->query($sql)->fetchObject();
        $list[] = $count->numero;
        $sql = "SELECT COUNT(ID) AS numero FROM laureati_tb WHERE Voto_laurea > 80 AND Voto_laurea <= 90";
        $count = $db->query($sql)->fetchObject();
        $list[] = $count->numero;
        $sql = "SELECT COUNT(ID) AS numero FROM laureati_tb WHERE Voto_laurea > 90 AND Voto_laurea <= 100";
        $count = $db->query($sql)->fetchObject();
        $list[] = $count->numero;
        $sql = "SELECT COUNT(ID) AS numero FROM laureati_tb WHERE Voto_laurea > 100 AND Voto_laurea <= 110";
        $count = $db->query($sql)->fetchObject();
        $list[] = $count->numero;
        $sql = "SELECT COUNT(ID) AS numero FROM laureati_tb WHERE cum_laude = 'si'";
        $count = $db->query($sql)->fetchObject();
        $list[] = $count->numero;

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Prendo il risultato della query
      // e lo ritorno come array
      return $list;
    }
        
    // Metodo che restituisce le informazioni
    // sul numero dei laureati per ogni anno del CdL
    public static function laureatiPerAnno() {

      $list = [];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo le query
        $years = range(2005, date('Y'));
        foreach($years as $year){
          $sql = "SELECT COUNT(ID) AS numero FROM laureati_tb WHERE YEAR(Data_laurea) = $year";
          $count = $db->query($sql)->fetchObject();
          $list[] = $count->numero;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Prendo il risultato della query
      // e lo ritorno come oggetto
      return $list;
    }
        
    // Metodo che restituisce le informazioni
    // sulla media del voto di laurea per ogni anno del CdL
    public static function mediaVotoAnno() {

      $list = [];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query
        $years = range(2005, date('Y'));
        foreach($years as $year){
          $sql = "SELECT AVG(Voto_laurea) AS numero FROM laureati_tb WHERE Voto_laurea <> 0 AND YEAR(Data_laurea) = $year";
          $count = $db->query($sql)->fetchObject();
          $list[] = $count->numero;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Prendo il risultato della query
      // e lo ritorno come oggetto
      return $list;
    }


    // Metodo che restiuisce l'intera
    // lista di studenti
    public static function getListStudenti() {

      // Inizializzo un array vuoto
      $list = [];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo i campi
        // non visualizzati sulla tabella
        $sql = "SELECT ID, Nome, Cognome, Voto_laurea, Data_Laurea, cum_laude FROM laureati_tb";
        // Eseguo la query
        $stmt = $db->query($sql);
        // Per ogni risultato della query
        // vado ad inserire nell'array
        // $list i dati di ogni studente
        foreach($stmt->fetchAll() as $student) {
          $list[] = $student;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Ritorno l'array con tutti
      // i dati degli studenti
      return $list;
    }

    // Metodo che restiuisce la lista dei laureati
    // basata sulla ricerca avanzata
    public static function advancedSearchStudenti($clean_value) {

      // Inizializzo un array vuoto
      $list = [];
      $params = [];

      $voto_laurea1 = $clean_value['voto_laurea1'];
      $voto_laurea2 = $clean_value['voto_laurea2'];
      $anno_laurea1 = $clean_value['anno_laurea1'];
      $anno_laurea2 = $clean_value['anno_laurea2'];

      $anno_nascita = $clean_value['anno_nascita'];
      $provincia = strtoupper($clean_value['provincia']);
      $curriculum = $clean_value['curriculum'];
      $cognome = $clean_value['cognome'];
      $relatore = $clean_value['relatore'];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo i campi
        // a seconda dei valori ricevuti in $_POST
        $sql = "SELECT ID, Nome, Cognome, Voto_laurea, cum_laude FROM laureati_tb WHERE Username <> 'admin'";

        if ($voto_laurea1 != '') {
          $sql .= " AND Voto_laurea >= :voto_laurea1";
          $params[':voto_laurea1'] = $voto_laurea1;
        }
        if ($voto_laurea2 != '') {
          $sql .= " AND Voto_laurea <= :voto_laurea2";
          $params[':voto_laurea2'] = $voto_laurea2;
        }
        if ($anno_laurea1 != '') {
          $sql .= " AND Data_laurea >= :anno_laurea1";
          $params[':anno_laurea1'] = $anno_laurea1;
        }
        if ($anno_laurea2 != '') {
          $sql .= " AND Data_laurea <= :anno_laurea2";
          $params[':anno_laurea2'] = $anno_laurea2;
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
        if ($relatore != '') {
          $sql .= " AND relatore LIKE :relatore";
          $params[':relatore'] = '%'.$relatore.'%';
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

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Ritorno l'array con tutti
      // i dati degli studenti
      return $list;
    }

    // Metodo che restituisce i dettagli di uno studente
    public static function userData($id) {

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo la password
        // in quanto non utile
        $sql = "SELECT ID, Nome, Cognome, Matricola, CF, Sesso, Data_n, Luogo_n, Prov_n, Luogo_r, Prov_r, Telefono, e_mail, Titolo_tesi, tipologia, Voto_laurea, cum_laude, Data_Laurea, Visibility, Note, relatore, curriculum, CV_download, Tesi_download FROM laureati_tb WHERE ID = :id";
        // Preparo la query
        $stmt = $db->prepare($sql);
        // Una volta preparata la query sostituisco
        // :id con il valore dell'id
        // ricevuto come parametro e la eseguo
        $rows = $stmt->execute(array(':id' => $id));

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Prendo il risultato della query
      // e lo ritorno come oggetto
      return $stmt->fetchObject();
    }


    // Metodo che restiuisce l'intera
    // lista di aziende
    public static function getListAziende() {

      // Inizializzo un array vuoto
      $list = [];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo i campi
        // non visualizzati sulla tabella
        $sql = "SELECT ID, r_sociale, nome, cognome, email, newsletter FROM aziende";
        // Eseguo la query
        $stmt = $db->query($sql);
        // Per ogni risultato della query
        // vado ad inserire nell'array
        // $list i dati di ogni studente
        foreach($stmt->fetchAll() as $company) {
          $list[] = $company;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Ritorno l'array con tutti
      // i dati delle aziende
      return $list;
    }

    // Metodo che restituisce i dettagli di un'azienda
    public static function getAzienda($id) {

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo la password
        // in quanto non utile
        $sql = "SELECT r_sociale, nome, cognome, email, newsletter, username FROM aziende WHERE ID = :id";
        // Preparo la query
        $stmt = $db->prepare($sql);
        // Una volta preparata la query sostituisco
        // :id con il valore dell'id
        // ricevuto come parametro e la eseguo
        $rows = $stmt->execute(array(':id' => $id));

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Prendo il risultato della query
      // e lo ritorno come oggetto
      return $stmt->fetchObject();
    }

    // Metodo che elimina l'azienda
    public static function deleteAzienda($id) {

      $result = FALSE;

      // Entro nella sezione critica dove 
      // effetuerò la query di delete
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query
        $sql = "DELETE FROM aziende WHERE ID = :id";
        // Preparo la query
        $stmt = $db->prepare($sql);
        // Una volta preparata la query sostituisco
        // :id con il valore dell'id
        // ricevuto come parametro e la eseguo
        $rows = $stmt->execute(array(':id' => $id));

        $result = TRUE;

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Risultato della query
      return $result;
    }

    // Metodo che fa l'upload della password di un'azienda
    public static function updatePwdAzienda($password, $id) {

        $result = FALSE;

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
        // effetuerò la query di update
        // della password
        try {

          // Mi collego al Database
          $db = Db::getInstance();
          // Compongo la query
          $sql = "UPDATE aziende SET password = :new_pwd, salt = :salt WHERE ID = :id";
          // Preparo la query 
          $stmt = $db->prepare($sql);
          // Eseguo la query
          $stmt->execute(array(':new_pwd' => $pwd, ':salt' => $salt, ':id' => $id));

          $result = TRUE;

        } catch(PDOException $ex) {

          // Errore. Stampo l'eccezzione
          die('Errore: '.$sql.' - '.$ex->getMessage());

        }

      return $result;
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
        // $list i dati di ogni curriculum
        foreach($stmt->fetchAll() as $cv) {
          $list[] = $cv;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Ritorno l'array con tutti
      // i dati di ogni curriculum
      return $list;
    }

    // Metodo che gestisce l'insert nella tabella
    // curriculum per l'aggiunta di nuovi cv
    public static function addCv($cv) {

      $result = FALSE;

      // Entro nella sezione critica dove 
      // effetuerò la query di
      // insert per aggiungere un nuovo cv
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query
        $sql = "INSERT INTO curriculum (nome) VALUES (:cv)";
        // Preparo la query 
        $stmt = $db->prepare($sql);
        // Eseguo la query
        $stmt->execute(array(':cv' => $cv));

        $result = TRUE;

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      return $result;

    }

    // Metodo utilizzato per la modifica dei dati dello studente
    public static function updateDataStudente($value, $id) {

      $result = FALSE;

      // Mi assicuro che il campo visibility
      // non sia stato manomesso o che sia 
      // stato inserito unvalore diverso da 0 o 1
      $visibility = ($value['Visibility'] != 0 && $value['Visibility'] != 1) ? 0 : $value['Visibility'];
      $Prov_n = strtoupper($value['Prov_n']);
      $Prov_r = strtoupper($value['Prov_r']);

        // Entro nella sezione critica dove 
        // effetuerò la query di update
        // dei dati
        try {

          // Mi collego al Database
          $db = Db::getInstance();
          // Compongo la query
          $sql = "UPDATE laureati_tb SET Nome = :Nome, Cognome = :Cognome, Matricola = :Matricola, Data_n = :Data_n, Sesso = :Sesso, CF = :CF, Luogo_n = :Luogo_n, Prov_n = :Prov_n, Luogo_r = :Luogo_r, Prov_r = :Prov_r, Telefono = :Telefono, e_mail = :e_mail, curriculum = :curriculum, Titolo_tesi = :Titolo_tesi, tipologia = :tipologia, relatore = :relatore, Voto_laurea = :Voto_laurea, cum_laude = :cum_laude, Data_Laurea = :Data_Laurea, Note = :Note, Visibility = :Visibility WHERE ID = :id";
          // Preparo la query 
          $stmt = $db->prepare($sql);
          // Eseguo la query
          $stmt->execute(array(':Nome' => $value['Nome'], ':Cognome' => $value['Cognome'], ':Matricola' => $value['Matricola'], ':Data_n' => $value['Data_n'], ':Sesso' => $value['Sesso'], ':CF' => $value['CF'], ':Luogo_n' => $value['Luogo_n'], ':Prov_n' => $Prov_n, ':Luogo_r' => $value['Luogo_r'], ':Prov_r' => $Prov_r, ':Telefono' => $value['Telefono'], ':e_mail' => $value['e_mail'], ':curriculum' => $value['curriculum'], ':Titolo_tesi' => $value['Titolo_tesi'], ':tipologia' => $value['tipologia'], ':relatore' => $value['relatore'], ':Voto_laurea' => $value['Voto_laurea'], ':cum_laude' => $value['cum_laude'], ':Data_Laurea' => $value['Data_Laurea'], ':Note' => $value['Note'], ':Visibility' => $visibility, ':id' => $id));

          $result = TRUE;

        } catch(PDOException $ex) {

          // Errore. Stampo l'eccezzione
          die('Errore: '.$sql.' - '.$ex->getMessage());

        }

      return $result;
    }

    // Metodo utilizzato per l'upload della tesi
    public static function uploadTesi($filename, $id) {

      $result = FALSE;

        // Entro nella sezione critica dove 
        // effetuerò la query di update
        // della tesi
        try {

          // Mi collego al Database
          $db = Db::getInstance();
          // Compongo la query
          $sql = "UPDATE laureati_tb SET Tesi_download = :tesi_download WHERE ID = :id";
          // Preparo la query 
          $stmt = $db->prepare($sql);
          // Eseguo la query
          $stmt->execute(array(':tesi_download' => $filename, ':id' => $id));

          $result = TRUE;

        } catch(PDOException $ex) {

          // Errore. Stampo l'eccezzione
          die('Errore: '.$sql.' - '.$ex->getMessage());

        }

      return $result;
    }

    // Metodo utilizzato per l'inserimento
    // dei dati di un nuovo laureato
    public static function insertNewLaureato($value) {

      $result = FALSE;

      // Genero il salt
      $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));

      // Creo ora una stringa di hash utilizzando la password concatenata al salt
      // la quale verrà inserita all'interno del database.
      $pwd = hash('sha256', $value['Password'] . $salt);

      // Successivamente facciamo un ulteriore funzione di hash sull'hash stesso
      // per 65536 volte.
      for($round = 0; $round < 65536; $round++) {
          $pwd = hash('sha256', $pwd . $salt);
      }

      // Mi assicuro che il campo visibility
      // non sia stato manomesso o che non sia 
      // stato inserito unvalore diverso da 0 o 1
      $visibility = ($value['Visibility'] != 0 && $value['Visibility'] != 1) ? 0 : $value['Visibility'];      

        // Entro nella sezione critica dove 
        // effetuerò la query di insert
        // dei dati
        try {

          // Mi collego al Database
          $db = Db::getInstance();
          // Compongo la query
          $sql = "INSERT INTO laureati_tb (Nome, Cognome, Matricola, Sesso, Username, Password, e_mail, curriculum, Titolo_tesi, tipologia, relatore, Voto_laurea, cum_laude, Data_Laurea, Visibility, Tesi_download, salt) VALUES (:Nome, :Cognome, :Matricola, :Sesso, :Username, :Password, :e_mail, :curriculum, :Titolo_tesi, :tipologia, :relatore, :Voto_laurea, :cum_laude, :Data_Laurea, :Visibility, :Tesi_download, :salt)";
          // Preparo la query 
          $stmt = $db->prepare($sql);
          // Eseguo la query
          $stmt->execute(array(':Nome' => $value['Nome'], ':Cognome' => $value['Cognome'], ':Matricola' => $value['Matricola'], ':Sesso' => $value['Sesso'], ':Username' => $value['Matricola'], ':Password' => $pwd, ':e_mail' => $value['e_mail'], ':curriculum' => $value['curriculum'], ':Titolo_tesi' => $value['Titolo_tesi'], ':tipologia' => $value['tipologia'], ':relatore' => $value['relatore'], ':Voto_laurea' => $value['Voto_laurea'], ':cum_laude' => $value['cum_laude'], ':Data_Laurea' => $value['Data_Laurea'], ':Visibility' => $visibility, ':Tesi_download' => $value['Tesi_download'], ':salt' => $salt));

          $result = TRUE;

        } catch(PDOException $ex) {

          // Errore. Stampo l'eccezzione
          die('Errore: '.$sql.' - '.$ex->getMessage());

        }

      return $result;
    }

    // Metodo utilizzato per la modifica dei dati dell'azienda
    public static function updateDataAzienda($value, $id) {

      $result = FALSE;
      $old = Admin::getAzienda($id);

      // Se l'username non è cambiato procedo
      if ($old->username === $value['username'] ) {

        $used = FALSE;

      // Se l'username è cambiato faccio il controllo
      } else {

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
          $stmt->execute(array(':username' => $value['username']));
          // Eseguo un fetch per contare le righe
          // del risultato della query.
          $rows = $stmt->fetch(PDO::FETCH_NUM);
          // Se esiste almeno una riga vuol dire che le 
          // username è già utilizzato
          $used = ($rows > 0) ? TRUE : FALSE;

        } catch(PDOException $ex) {

          // Errore. Stampo l'eccezzione
          die('Errore: '.$sql.' - '.$ex->getMessage());

        }
      }

        // Se l'username è cambiato ed è già utilizzato
        // esco senza fare l'update
        if (!$used) {

          // Entro nella sezione critica dove 
          // effetuerò la query di update
          // dei dati
          try {

            // Mi collego al Database
            $db = Db::getInstance();
            // Compongo la query
            $sql = "UPDATE aziende SET r_sociale = :r_sociale, nome = :nome, cognome = :cognome, email = :email, newsletter = :newsletter, username = :username WHERE ID = :id";
            // Preparo la query 
            $stmt = $db->prepare($sql);
            // Eseguo la query
            $stmt->execute(array(':r_sociale' => $value['r_sociale'], ':nome' => $value['nome'], ':cognome' => $value['cognome'], ':email' => $value['email'], ':newsletter' => $value['newsletter'], ':username' => $value['username'], ':id' => $id));

            $result = TRUE;

          } catch(PDOException $ex) {

            // Errore. Stampo l'eccezzione
            die('Errore: '.$sql.' - '.$ex->getMessage());

          }

        }

      return $result;
    }


    // Metodo che fa l'update della password dell'admin
    public static function updatePwdAdmin($new_value) {

      $pwd_attuale = $new_value['pwd_attuale'];
      $pwd_nuova = $new_value['pwd_nuova'];

      $result = FALSE;
      $value = array('username' => 'admin', 'password' => $pwd_attuale);

      // Richiedo il modello per il login
      require_once('models/Login.php');

      // Se il login va a buon fine la password
      // è corretta quindi posso modificarla
      if(Login::adminLogin($value)){

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
          $sql = "UPDATE admin SET password = :new_pwd, salt = :salt WHERE username = :username";
          // Preparo la query 
          $stmt = $db->prepare($sql);
          // Eseguo la query
          $stmt->execute(array(':new_pwd' => $pwd, ':salt' => $salt, ':username' => 'admin'));

          $result = TRUE;

        } catch(PDOException $ex) {

          // Errore. Stampo l'eccezzione
          die('Errore: '.$sql.' - '.$ex->getMessage());

        }

      }

      return $result;

    }

    // Metodo utilizzato per l'estrazione della newsletter
    public static function extractEmail($type) {

      // Inizializzo un array vuoto
      $list = [];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query
        // A seconda del tipo faccio la query
        // di selezione dalla giusta tabella
        if ($type == '0') {
          $sql = "SELECT e_mail FROM laureati_tb WHERE e_mail <> ''";
        } else {
          $sql = "SELECT email FROM aziende WHERE email <> '' AND newsletter = 'Si'";
        }
        // Eseguo la query
        $stmt = $db->query($sql);
        // Per ogni risultato della query
        // vado ad inserire nell'array
        // $list l'email di ogni studente/azienda
        foreach($stmt->fetchAll() as $user) {
          $list[] = $user;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Ritorno l'array con tutte le
      // email degli studenti o delle aziende
      return $list;
    }

    // Metodo utilizzato per l'estrazione dei dati degli studenti
    // per poi creare il file CSV
    public static function extractLaureati($dataToExtract) {

      // Inizializzo un array vuoto
      $list = [];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo i campi
        // a seconda dei valori ricevuti in $_POST
        $sql = "SELECT ";

        if ($dataToExtract['Nome'] == 'Si'){
          $sql .= "Nome,";
        }
        if ($dataToExtract['Cognome'] == 'Si'){
          $sql .= "Cognome,";
        }
        if ($dataToExtract['Matricola'] == 'Si'){
          $sql .= "Matricola,";
        }
        if ($dataToExtract['CF'] == 'Si'){
          $sql .= "CF,";
        }
        if ($dataToExtract['Sesso'] == 'Si'){
          $sql .= "Sesso,";
        }
        if ($dataToExtract['Data_n'] == 'Si'){
          $sql .= "Data_n,";
        }
        if ($dataToExtract['Luogo_n'] == 'Si'){
          $sql .= "Luogo_n,";
        }
        if ($dataToExtract['Prov_n'] == 'Si'){
          $sql .= "Prov_n,";
        }
        if ($dataToExtract['Luogo_r'] == 'Si'){
          $sql .= "Luogo_r,";
        }
        if ($dataToExtract['Prov_r'] == 'Si'){
          $sql .= "Prov_r,";
        }
        if ($dataToExtract['Telefono'] == 'Si'){
          $sql .= "Telefono,";
        }
        if ($dataToExtract['e_mail'] == 'Si'){
          $sql .= "e_mail,";
        }
        if ($dataToExtract['Titolo_tesi'] == 'Si'){
          $sql .= "Titolo_tesi,";
        }
        if ($dataToExtract['tipologia'] == 'Si'){
          $sql .= "tipologia,";
        }
        if ($dataToExtract['Voto_laurea'] == 'Si'){
          $sql .= "Voto_laurea,";
        }
        if ($dataToExtract['cum_laude'] == 'Si'){
          $sql .= "cum_laude,";
        }
        if ($dataToExtract['Data_Laurea'] == 'Si'){
          $sql .= "Data_Laurea,";
        }
        if ($dataToExtract['Visibility'] == 'Si'){
          $sql .= "Visibility,";
        }
        if ($dataToExtract['Note'] == 'Si'){
          $sql .= "Note,";
        }
        if ($dataToExtract['relatore'] == 'Si'){
          $sql .= "relatore,";
        }
        if ($dataToExtract['curriculum'] == 'Si'){
          $sql .= "curriculum,";
        }
        if ($dataToExtract['CV_download'] == 'Si'){
          $sql .= "CV_download,";
        }
        if ($dataToExtract['Tesi_download'] == 'Si'){
          $sql .= "Tesi_download,";
        }

        $sql = substr($sql, 0, -1);
        $sql .= " FROM laureati_tb WHERE ID <> 1";

        // Eseguo la query
        $stmt = $db->query($sql);
        // Per ogni risultato della query
        // vado ad inserire nell'array
        // $list i dati di ogni studente
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $user) {
          $list[] = $user;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Ritorno l'array con tutti
      // i dati degli studenti
      return $list;
    }

    // Metodo utilizzato per l'estrazione dei dati delle aziende
    // per poi creare il file CSV
    public static function extractAziende($dataToExtract) {

      // Inizializzo un array vuoto
      $list = [];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo i campi
        // a seconda dei valori ricevuti in $_POST
        $sql = "SELECT ";

        if ($dataToExtract['r_sociale'] == 'Si'){
          $sql .= "r_sociale,";
        }
        if ($dataToExtract['nome'] == 'Si'){
          $sql .= "nome,";
        }
        if ($dataToExtract['cognome'] == 'Si'){
          $sql .= "cognome,";
        }
        if ($dataToExtract['email'] == 'Si'){
          $sql .= "email,";
        }

        $sql = substr($sql, 0, -1);
        $sql .= " FROM aziende WHERE newsletter = 'Si'";

        // Eseguo la query
        $stmt = $db->query($sql);
        // Per ogni risultato della query
        // vado ad inserire nell'array
        // $list i dati di ogni azienda
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $user) {
          $list[] = $user;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Ritorno l'array con tutti
      // i dati delle aziende
      return $list;
    }

}
?>