<?php

/**
* RegistrazioneController
* Controller della pagina di
* registrazione delle aziende
*
* @author     Gianluca Bonifazi
* @category   controllers 
* @copyright  STI Uniurb (c) 2017
*/

class RegistrazioneController {


    // Action della pagina registrazione
    public function index() {

        // Di default nascondo gli alert
        // dove sarà stampato il risultato
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
            'privacy'    		    => 'on',
            'newsletter' 		    => FILTER_SANITIZE_SPECIAL_CHARS
          );
          // Tramite la funzione filter_input_array pulisco
          // i dati ricevuti in caso ci fossero stati
          // tentativi di manomissione
          $clean_value = filter_input_array(INPUT_POST, $args);

          // Richiamo il Model collegato alla pagina di 
          // registrazione e passo al suo metodo joinAzienda
          // utile alla registrazione nel database dell'azienda
          // i valori riecvuti dal form e puliti con il sanitize
          if(Registrazione::joinAzienda($clean_value)) {
          	// Mostro l'alert di successo
          	$hide_ok = '';
          } else {
          	// Mostro l'alert di errore
          	$hide_err = '';
          }

        }

      // Richiedo la vista collegata alla
      // pagina di registrazione
      require_once('views/registrazione/index.php');
    }


    // Action della pagina privacy policy
    public function privacy() {
      // Richiedo la vista collegata alla
      // pagina della privacy policy
      require_once('views/registrazione/privacy.php');
    }
  
}
?>