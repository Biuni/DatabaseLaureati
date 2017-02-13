<?php 
class Session {

    public static function startSession() {
		
		session_start();

    }

    public static function checkSession($controller) {

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

		return $checkedSession;

    }

}
?>