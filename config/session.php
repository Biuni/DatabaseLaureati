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

	// Metodo utilizzato per richiamare 
	// la funzione session_start() all'inizio
	// della pagina
    public static function startSession() {
		session_start();
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
			if(isset($_SESSION['azienda'])) {
				// OK. La sessione esiste
				$checkedSession = true;
			} else {
				// ERRORE. La sessione non esiste
				$checkedSession = false;
			}
		}
		
		// Controllo sessione studente
		if ($controller == 'studenti') {
			if(isset($_SESSION['studente'])) {
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

}
?>