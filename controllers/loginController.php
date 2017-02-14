<?php

class LoginController {

    public function studenti() {

        // Se sono già loggato vado all'area riservata
        if (Session::checkSession('studenti')) {
          return Routes::call('studenti','index');
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
            // Redirect all'area riservata degli studenti
            $_SESSION['studente'] = $clean_value['username'];
            return Routes::call('studenti','index');

          } else {
            // Login FALLITO 
            // C'è stato un errore. Tolgo la calsse hide
            // dall'alert cosi che viene mostrato
            $hide = '';
          }
        }

      require_once('views/login/studenti.php');
    }


    public function aziende() {

        // Se sono già loggato vado all'area riservata
        if (Session::checkSession('aziende')) {
          return Routes::call('aziende','index');
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
            // Redirect all'area riservata delle aziende
            $_SESSION['azienda'] = $clean_value['username'];
            return Routes::call('aziende','index');

          } else {
            // Login FALLITO 
            // C'è stato un errore. Tolgo la calsse hide
            // dall'alert cosi che viene mostrato
            $hide = '';
          }
        }

      require_once('views/login/aziende.php');
    }

    public function riservata() {
      require_once('views/login/riservata.php');
    }

  }
?>