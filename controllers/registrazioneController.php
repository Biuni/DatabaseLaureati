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

          // Controllo il corretto inserimento del 
          // RECAPTCHA di Google
          try {

              $url = 'https://www.google.com/recaptcha/api/siteverify';
              $data = ['secret'   => '6LeV0h4UAAAAAC6fVmPAkDAOinhG9DPj290vS9L9',
                       'response' => $_POST['g-recaptcha-response'],
                       'remoteip' => $_SERVER['REMOTE_ADDR']];

              $options = [
                  'http' => [
                      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                      'method'  => 'POST',
                      'content' => http_build_query($data) 
                  ]
              ];

              $context  = stream_context_create($options);
              $result = file_get_contents($url, false, $context);
              $result_captcha = json_decode($result)->success;

              if ($result_captcha) {
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
              } else {
                // Mostro l'alert di errore
                $hide_err = '';
              }


          } catch (Exception $e) {
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