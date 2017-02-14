<?php
  class RegistrazioneController {

    public function index() {

        // Di default nascondo gli alert
        $hide_err = 'hide';
        $hide_ok = 'hide';

        // Controllo se sono arrivati valori
        // in post compilati dal form
        if ($_POST) {
          // Creo un array per il sanitize dei valori
          // ricevuti in $_POST
          $args = array(
            'ragionesociale'   	=> FILTER_SANITIZE_SPECIAL_CHARS,
            'nomereferente'    	=> FILTER_SANITIZE_SPECIAL_CHARS,
            'cognomereferente'  => FILTER_SANITIZE_SPECIAL_CHARS,
            'emailreferente'    => FILTER_VALIDATE_EMAIL,
            'privacy'    		=> 'on',
            'newsletter' 		=> FILTER_SANITIZE_SPECIAL_CHARS
          );
          // Tramite la funzione filter_input_array pulisco
          // i dati ricevuti in caso ci fossero stati
          // tentativi di manomissione
          $clean_value = filter_input_array(INPUT_POST, $args);

          if(Registrazione::joinAzienda($clean_value)) {
          	// Mostro l'alert di successo
          	$hide_ok = '';
          } else {
          	// Mostro l'alert di errore
          	$hide_err = '';
          }

        }

      require_once('views/registrazione/index.php');
    }

    public function privacy() {
      require_once('views/registrazione/privacy.php');
    }
    
  }
?>