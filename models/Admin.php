<?php
class Admin {
        
    // Funzione che restituisce le informazioni
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
        
    // Funzione che restituisce le informazioni
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
      // e lo ritorno come oggetto
      return $list;
    }
        
    // Funzione che restituisce le informazioni
    // sull'ultimo login dell'amministratore
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
      // e lo ritorno come oggetto
      return $list;
    }
        
    // Funzione che restituisce le informazioni
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
    // basata sulla ricerca
    public static function advancedSearchStudenti($clean_value) {

      // Inizializzo un array vuoto
      $list = [];
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
        $sql = "SELECT ID, Nome, Cognome, Titolo_tesi, Voto_laurea, Data_Laurea, cum_laude FROM laureati_tb WHERE Username <> 'admin'";

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

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Ritorno l'array con tutti
      // i dati degli studenti
      return $list;
    }

    // Funzione che restituisce i dettagli di uno studente
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
        // :username con il valore dell'username
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
        // Compongo la query esludendo i campi
        // non visualizzati sulla tabella
        $sql = "SELECT id, nome FROM curriculum";
        // Eseguo la query
        $stmt = $db->query($sql);
        // Per ogni risultato della query
        // vado ad inserire nell'array
        // $list i dati di ogni studente
        foreach($stmt->fetchAll() as $cv) {
          $list[] = $cv;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Ritorno l'array con tutti
      // i dati degli studenti
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
        // del curriculum
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

}
?>