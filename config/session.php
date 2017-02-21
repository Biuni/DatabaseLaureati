<?php 

/**
 * Session
 * Gestione delle sessioni
 *
 * Classe per la gestione delle 
 * sessioni nelle aree riservate.
 *
 * @author     Gianluca Bonifazi
 * @category   config 
 * @copyright  STI Uniurb (c) 2017
 */

class Session {

	// Metodo utilizzato per iniziare 
	// la sessione
    public static function startSession() {
        $session_name = 'DatabaseLaureati'; // Imposta un nome di sessione
        session_name($session_name); // Imposta il nome di sessione con quello scelto.
        session_start(); // Avvia la sessione php.
        session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
    }

    // Metodo utilizzato per controllare
    // se la sessione è settata e quindi
    // l'utente è loggato all'interno 
    // dell'area riservata
    public static function checkSession($controller) {

    	// Attributo inizialmente 
    	// settato a false.
		$checkedSession = false;

		// Controllo sessione azienda
		if ($controller == 'aziende') {
			if(isset($_SESSION['azienda']) && $_SESSION['azienda'] != '') {
				// OK. La sessione esiste
				$checkedSession = true;
			} else {
				// ERRORE. La sessione non esiste
				$checkedSession = false;
			}
		}
		
		// Controllo sessione studente
		if ($controller == 'studenti') {
			if(isset($_SESSION['studente']) && $_SESSION['studente'] != '') {
				// OK. La sessione esiste
				$checkedSession = true;
			} else {
				// ERRORE. La sessione non esiste
				$checkedSession = false;
			}
		}
		
		// Controllo sessione studente
		if ($controller == 'admin') {
			if(isset($_SESSION['gestore']) && $_SESSION['gestore'] != '') {
				// OK. La sessione esiste
				$checkedSession = true;
			} else {
				// ERRORE. La sessione non esiste
				$checkedSession = false;
			}
		}

		// Ritorno il valore booleano
		return $checkedSession;
    }

    // Metodo che pulisce e poi distrugge
    // la sessione
    public static function destroySession(){
		// Elimina tutti i valori della sessione.
		$_SESSION = array();
		// Cancella la sessione.
		session_destroy();
    }

}
?>