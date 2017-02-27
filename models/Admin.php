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

}
?>