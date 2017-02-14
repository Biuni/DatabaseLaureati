<?php
class AziendeController {

	// Pagina principale
    public function index() {

        // Controllo la sessione
        if (Session::checkSession('aziende')) {
          $username = htmlspecialchars($_SESSION['azienda']);
        } else {
          return Routes::call('login','aziende');
        }

    	// Faccio la chiamata al metodo del Model
    	// e stampo la lista di tutti i laureati
        $students = Aziende::getList();

        // Controllo se arriva una chiamata
        // dal form di ricerca
        if ($_POST) {
        	// Array per il sanitize del $_POST
			$args = array(
				'voto_laurea' 	=> FILTER_SANITIZE_ENCODED,
				'anno_laurea'	=> FILTER_SANITIZE_ENCODED,
				'anno_nascita'	=> FILTER_SANITIZE_ENCODED,
				'provincia'		=> FILTER_SANITIZE_ENCODED,
				'curriculum'	=> FILTER_SANITIZE_SPECIAL_CHARS,
				'cognome'		=> FILTER_SANITIZE_ENCODED
			);
			// Tramite la funzione filter_input_array pulisco
			// i dati ricevuti in caso ci fossero stati
			// tentativi di manomissione
			$clean_value = filter_input_array(INPUT_POST, $args);
			// Faccio la chiamata al metodo del Model 
			// passandogli i parametri appena puliti
        	$students = Aziende::advancedSearch($clean_value);
        }

 		// Layout dell'area riservata all'azienda
        require_once('views/aziende/index.php');
    }
    
    // Pagina impostazioni dell'account
    public function impostazioni() {

        // Controllo la sessione
        if (Session::checkSession('aziende')) {
          $username = htmlspecialchars($_SESSION['azienda']);
        } else {
          return Routes::call('login','aziende');
        }

        // Layout delle impostazioni
        require_once('views/aziende/impostazioni.php');
    }
    
    // Pagina dettaglio laureato
    public function dettaglio() {

        // Controllo la sessione
        if (Session::checkSession('aziende')) {
          $username = htmlspecialchars($_SESSION['azienda']);
        } else {
          return Routes::call('login','aziende');
        }
        
        // Se non viene passato l'id come GET
        // o se non è un valore intero
        // faccio il redirect alla pagina di errore
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        // Controllo e in caso stampo errore
        if (!$id)
            return Routes::call('pages', 'error');
        // Passo come parametri del metodo
        // l'id ricevuto trasformandolo
        // in intero
        $details = Aziende::showDetails(intval($_GET['id']));

        // Layout del dettaglio del laureato
        require_once('views/aziende/dettaglio.php');
    }
    
    // Funzione di logout
    public function logout() {
        unset($_SESSION['azienda']);
        return Routes::call('pages','home');
    }
    
}
?>