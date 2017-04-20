<?php

/**
* LoginController
* Controller delle pagine di 
* login degli studenti, delle
* aziende e del gestore
*
* @author     Gianluca Bonifazi
* @category   controllers 
* @copyright  STI Uniurb (c) 2017
*/

class LoginController {


    // Action della pagina di login
    // degli studenti laureati
    public function studenti() {

        // Controllo se esiste la sessione
        // e se risulta vero faccio il redirect
        // all'area riservata
        if (Session::checkSession('studenti')) {
          return Routes::redirectTo('studenti','index');
        }

        // Di default nascondo l'alert di errore
        $hide = 'hide';

        // Controllo se sono arrivati valori
        // in post compilati dal form
        if ($_POST) {
          // Creo un array per il sanitize dei valori
          // ricevuti in $_POST
          $args = array(
            'username'   => FILTER_VALIDATE_INT,
            'password'    => FILTER_SANITIZE_SPECIAL_CHARS
          );
          // Tramite la funzione filter_input_array pulisco
          // i dati ricevuti in caso ci fossero stati
          // tentativi di manomissione
          $clean_value = filter_input_array(INPUT_POST, $args);
          // Faccio la chiamata al metodo del Model 
          // passandogli i parametri appena puliti
          // e la tabella al quale fare interrogazioni
          if (Login::loginResult($clean_value,'laureati_tb')) {
            // Login RIUSCITO 
            // Creo la sessione con la matricola
            // dello studente
            $_SESSION['studente'] = $clean_value['username'];

            // Redirect all'area riservata dello studente
            return Routes::redirectTo('studenti','index');

          } else {
            // Login FALLITO 
            // C'è stato un errore. Tolgo la calsse hide
            // dall'alert cosi che viene mostrato
            $hide = '';
          }
        }

      // Richiedo la vista collegata alla
      // pagina di login degli studenti
      require_once('views/login/studenti.php');
    }


    // Action della pagina di login
    // delle aziende registrate
    public function aziende() {

        // Controllo se esiste la sessione
        // e se risulta vero faccio il redirect
        // all'area riservata
        if (Session::checkSession('aziende')) {
          return Routes::redirectTo('aziende','index');
        }

        // Di default nascondo l'alert di errore
        $hide = 'hide';

        // Controllo se sono arrivati valori
        // in post compilati dal form
        if ($_POST) {
          // Creo un array per il sanitize dei valori
          // ricevuti in $_POST
          $args = array(
            'username'   => FILTER_SANITIZE_SPECIAL_CHARS,
            'password'    => FILTER_SANITIZE_SPECIAL_CHARS
          );
          // Tramite la funzione filter_input_array pulisco
          // i dati ricevuti in caso ci fossero stati
          // tentativi di manomissione
          $clean_value = filter_input_array(INPUT_POST, $args);
          // Faccio la chiamata al metodo del Model 
          // passandogli i parametri appena puliti
          if (Login::loginResult($clean_value,'aziende')) {
            // Login RIUSCITO 
            // Creo la sessione con l'username
            // dell'azienda
            $_SESSION['azienda'] = $clean_value['username'];

            // Redirect all'area riservata delle aziende
            return Routes::redirectTo('aziende','index');

          } else {
            // Login FALLITO 
            // C'è stato un errore. Tolgo la calsse hide
            // dall'alert cosi che viene mostrato
            $hide = '';
          }
        }

      // Richiedo la vista collegata alla
      // pagina di login delle aziende
      require_once('views/login/aziende.php');
    }


    // Action della pagina di login
    // all'area riservata al gestore
    public function riservata() {

        // Controllo se esiste la sessione
        // e se risulta vero faccio il redirect
        // all'area riservata
        if (Session::checkSession('admin')) {
          return Routes::redirectTo('admin','index');
        }

        // Di default nascondo l'alert di errore
        $hide = 'hide';

        // Controllo se sono arrivati valori
        // in post compilati dal form
        if ($_POST) {

          // Creo un array per il sanitize dei valori
          // ricevuti in $_POST
          $args = array(
            'username'   => FILTER_SANITIZE_SPECIAL_CHARS,
            'password'   => FILTER_SANITIZE_SPECIAL_CHARS
          );
          // Tramite la funzione filter_input_array pulisco
          // i dati ricevuti in caso ci fossero stati
          // tentativi di manomissione
          $clean_value = filter_input_array(INPUT_POST, $args);

          if (Login::adminLogin($clean_value)) {
            // Login RIUSCITO 
            // Creo la sessione con l'username
            // dell'admin
            $_SESSION['gestore'] = $clean_value['username'];

            // Redirect all'area riservata 
            return Routes::redirectTo('admin','index');

          } else {
            // Login FALLITO 
            // C'è stato un errore. Tolgo la calsse hide
            // dall'alert cosi che viene mostrato
            $hide = '';
          }
          
        }

      // Richiedo la vista collegata alla
      // pagina di login del gestore
      require_once('views/login/riservata.php');
    }

}
?>