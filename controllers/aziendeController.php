<?php

/**
* AziendeController
* Controller dell'area riservata
* alle aziende registrate
*
* @author     Gianluca Bonifazi
* @category   controllers 
* @copyright  STI Uniurb (c) 2017
*/

class AziendeController {


    // Action della pagina con le info
    // collegate agli studenti che hanno
    // scelto di essere visibili
    public function index() {

        // Controllo se esiste la sessione
        // che permette la navigazione dell'area riservata
        // altrimenti faccio il redirect alla login
        if (Session::checkSession('aziende')) {
          $username = htmlspecialchars($_SESSION['azienda']);
        } else {
          return Routes::redirectTo('login','aziende');
        }

    	// Faccio la chiamata al metodo del Model
    	// e stampo la lista di tutti i laureati
        $students = Aziende::getList();

        // Faccio la chiamata al metodo del Model
        // e stampo la lista di tutti i curriculum
        $curriculum = Aziende::getCv();

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

        // Richiedo la vista collegata alla
        // pagina principale dell'area riservata
        // alle aziende registrate
        require_once('views/aziende/index.php');
    }
    

    // Action della pagina per la modifica
    // delle impostazioni dell'azienda loggata
    public function impostazioni() {

        // Nascondo di default gli alert
        $hide_ok_user = 'hide';
        $hide_err_user = 'hide';
        $hide_ok_pwd = 'hide';
        $hide_err_pwd = 'hide';

        // Controllo se esiste la sessione
        // che permette la navigazione dell'area riservata
        // altrimenti faccio il redirect alla login
        if (Session::checkSession('aziende')) {
          $username = htmlspecialchars($_SESSION['azienda']);
        } else {
          return Routes::redirectTo('login','aziende');
        }

        // Controllo se arriva una chiamata
        // dal form di update dei dati
        if ($_POST) {
            
            // Controllo se si tratta della modifica
            // dell'username
            if (isset($_POST['new_user_azienda']) && $_POST['new_user_azienda'] != '') {

                $new_user = $_POST['new_user_azienda'];
                $old_user = $_POST['old_user_azienda'];
                $new_user = str_replace(' ', '-', $new_user);
                $new_user = str_replace('.', '', $new_user);
                $new_user = strtolower($new_user);

                // Faccio la chiamata al metodo del Model
                // e controllo se l'username esiste già
                if(Aziende::checkIfExist($new_user)){
                    // Faccio la chiamata al metodo del Model 
                    // passandogli i parametri per aggiornare
                    // l'username
                    if(Aziende::updateUser($new_user,$old_user)){
                        // Setto il nuovo username nella sessione
                        $_SESSION['azienda'] = $new_user;
                        $username = htmlspecialchars($_SESSION['azienda']);
                        // Mostro l'alert di modifica riuscita
                        $hide_ok_user = '';
                    } else {
                        // Errore nella query
                        // Mostro l'alert di errore
                        $hide_err_user = '';
                    }
                } else {
                    // username già utilizzato
                    // Mostro l'alert di errore
                    $hide_err_user = '';
                }
            }
            
            // Controllo se si tratta della modifica
            // della password
            if (isset($_POST['pwd_nuova']) && $_POST['pwd_nuova'] != '') {

                $pwd_attuale = $_POST['pwd_attuale'];
                $pwd_nuova = $_POST['pwd_nuova'];
                $pwd_nuova2 = $_POST['pwd_nuova2'];
                $pwd_username = $_POST['pwd_username'];

                // Se le password nuove combaciano continuo
                // con l'esecuzione
                if ($pwd_nuova === $pwd_nuova2) {
                    // Faccio la chiamata al metodo del Model 
                    // passandogli i parametri per aggiornare
                    // la password
                    if(Aziende::updatePwd($pwd_attuale,$pwd_nuova,$pwd_username)){
                        // Mostro l'alert di conferma 
                        $hide_ok_pwd = '';
                    } else {
                        // Mostro l'alert di errore
                        $hide_err_pwd = '';
                    }
                } else {
                    // Non è stata inserita la stessa
                    // password mostro l'alert di errore
                    $hide_err_pwd = '';
                }

            }

        }

        // Richiedo la vista collegata alla
        // pagina di impostazioni
        // dell'azienda loggata
        require_once('views/aziende/impostazioni.php');
    }

    
    // Action della pagina per la visualizzazione
    // dei dettagli di uno studente laureato
    public function dettaglio() {

        // Controllo se esiste la sessione
        // che permette la navigazione dell'area riservata
        // altrimenti faccio il redirect alla login
        if (Session::checkSession('aziende')) {
          $username = htmlspecialchars($_SESSION['azienda']);
        } else {
          return Routes::redirectTo('login','aziende');
        }
        
        // Se non viene passato l'id dello studente come GET
        // o se non è un valore intero
        // faccio il redirect alla pagina di errore
        $id = isset($_GET['pagina']) ? (int) $_GET['pagina'] : null;
        // Controllo e in caso stampo errore
        if (!$id)
            return Routes::redirectTo('pages', 'error');
        // Passo come parametri del metodo
        // l'id ricevuto trasformandolo
        // in intero
        $details = Aziende::showDetails(intval($_GET['pagina']));

        // Layout del dettaglio del laureato
        require_once('views/aziende/dettaglio.php');
    }
    
    
    // Action per il logout dall'area riservata
    public function logout() {
        Session::destroySession();
        return Routes::redirectTo('login','aziende');
    }
    
}
?>