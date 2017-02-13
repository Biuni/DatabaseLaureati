<?php
/*
|* **********************************************************
|*
|* Controller:  login
|* Info:        Gestisce i login degli studenti, delle aziende
|*              e dell'area riservata ai gestori
|*
|* **********************************************************
*/
class LoginController {

    /*
    |* **********************************************************
    |*
    |* Action:      studenti
    |* Url:         http://laureati.sti.uniurb.it/login/studenti
    |* Info:        Gestisce il login degli studenti
    |*
    |* **********************************************************
    */

    public function studenti() {

        // Di default nascondo l'alert di errore
        $hide = 'hide';

        // Controllo se sono arrivati valori
        // in post compilati dal form
        if ($_POST) {
          // Creo un array per il sanitize dei valori
          // ricevuti in $_POST
          $args = array(
            'user_studente'   => FILTER_VALIDATE_INT,
            'pwd_studente'    => FILTER_SANITIZE_SPECIAL_CHARS
          );
          // Tramite la funzione filter_input_array pulisco
          // i dati ricevuti in caso ci fossero stati
          // tentativi di manomissione
          $clean_value = filter_input_array(INPUT_POST, $args);
          // Faccio la chiamata al metodo del Model 
          // passandogli i parametri appena puliti
          if (Login::loginStudenti($clean_value)) {
            // Login RIUSCITO 
            // Redirect all'area riservata degli studenti
            return call('studenti','index');

          } else {
            // Login FALLITO 
            // C'è stato un errore. Tolgo la calsse hide
            // dall'alert cosi che viene mostrato
            $hide = '';
          }
        }

      require_once('views/login/studenti.php');
    }


    /*
    |* **********************************************************
    |*
    |* Action:      aziende
    |* Url:         http://laureati.sti.uniurb.it/login/aziende
    |* Info:        Gestisce il login delle aziende
    |*
    |* **********************************************************
    */

    public function aziende() {

        // Di default nascondo l'alert di errore
        $hide = 'hide';

        // Controllo se sono arrivati valori
        // in post compilati dal form
        if ($_POST) {
          // Creo un array per il sanitize dei valori
          // ricevuti in $_POST
          $args = array(
            'user_aziende'   => FILTER_SANITIZE_SPECIAL_CHARS,
            'pwd_aziende'    => FILTER_SANITIZE_SPECIAL_CHARS
          );
          // Tramite la funzione filter_input_array pulisco
          // i dati ricevuti in caso ci fossero stati
          // tentativi di manomissione
          $clean_value = filter_input_array(INPUT_POST, $args);
          // Faccio la chiamata al metodo del Model 
          // passandogli i parametri appena puliti
          if (Login::loginAziende($clean_value)) {
            // Login RIUSCITO 
            // Redirect all'area riservata degli studenti
            return call('aziende','index');

          } else {
            // Login FALLITO 
            // C'è stato un errore. Tolgo la calsse hide
            // dall'alert cosi che viene mostrato
            $hide = '';
          }
        }

      require_once('views/login/aziende.php');
    }


    /*
    |* **********************************************************
    |*
    |* Action:      riservata
    |* Url:         http://laureati.sti.uniurb.it/login/riservata
    |* Info:        Gestisce il login all'area riservata
    |*
    |* **********************************************************
    */

    public function riservata() {
      require_once('views/login/riservata.php');
    }

  }
?>