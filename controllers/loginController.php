<?php
  class LoginController {

    public function studenti() {

        // Nascondo l'alert di errore
        $hide = 'hide';

        if ($_POST) {
          // Array per il sanitize del $_POST
          $args = array(
            'user_studente'   => FILTER_SANITIZE_SPECIAL_CHARS,
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
            // Instauro la sessione e faccio il redirect
            // all'area riservata
            $username = $clean_value['user_studente'];

            // Creo la sessione
            /*if (!isset($_SESSION))
              $_SESSION['id'] = $username;*/

            // Redirect all'area riservata degli studenti
            return call('studenti','index');

          } else {
            // Mostro l'alert di errore
            $hide = '';
          }
        }

      require_once('views/login/studenti.php');
    }

    public function aziende() {
      require_once('views/login/aziende.php');
    }

    public function riservata() {
      //echo $_POST['pass'];
      require_once('views/login/riservata.php');
    }

  }
?>