<?php

class StudentiController {

    public function index() {

      // Controllo la sessione
      if (Session::checkSession('studenti')) {
        $username = htmlspecialchars($_SESSION['studente']);
      } else {
        return Routes::redirectTo('login','studenti');
      }

      $students = Studenti::userData($username);

      require_once('views/studenti/index.php');
    }

    public function impostazioni() {

      // Controllo la sessione
      if (Session::checkSession('studenti')) {
        $username = htmlspecialchars($_SESSION['studente']);
      } else {
        return Routes::redirectTo('login','studenti');
      }

      // Nascondo di default gli alert
      $hide_ok_user = 'hide';
      $hide_err_user = 'hide';
      $hide_ok_pwd = 'hide';
      $hide_err_pwd = 'hide';

      // Controllo se arriva una chiamata
      // dal form di update dei dati
      if ($_POST) {
            
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
                  if(Studenti::updatePwd($pwd_attuale,$pwd_nuova,$pwd_username)){
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

          // Se non si tratta della modifica della password
          // sono la modifica dei dati
          } else {

            // Array per il sanitize del $_POST
            $args = array(
              'Data_n'      => FILTER_SANITIZE_SPECIAL_CHARS,
              'Sesso'       => FILTER_SANITIZE_SPECIAL_CHARS,
              'CF'          => FILTER_SANITIZE_SPECIAL_CHARS,
              'Luogo_n'     => FILTER_SANITIZE_SPECIAL_CHARS,
              'Prov_n'      => FILTER_SANITIZE_SPECIAL_CHARS,
              'Luogo_r'     => FILTER_SANITIZE_SPECIAL_CHARS,
              'Prov_r'      => FILTER_SANITIZE_SPECIAL_CHARS,
              'Telefono'    => FILTER_SANITIZE_SPECIAL_CHARS,
              'e_mail'      => FILTER_VALIDATE_EMAIL,
              'Note'        => FILTER_SANITIZE_SPECIAL_CHARS,
              'Visibility'  => FILTER_VALIDATE_INT
            );
            // Tramite la funzione filter_input_array pulisco
            // i dati ricevuti in caso ci fossero stati
            // tentativi di manomissione
            $clean_value = filter_input_array(INPUT_POST, $args);
            // Richiamo la funzione dentro il Model
            // per fare l'update dei dati
            if(Studenti::updateData($clean_value,$username)){
              // Mostro l'alert di conferma 
              $hide_ok_user = '';
            } else {
              // Mostro l'alert di errore
              $hide_err_user = '';
            }

          }

      }

      $students = Studenti::userData($username);

      require_once('views/studenti/impostazioni.php');
    }
    
    // Funzione di logout
    public function logout() {
        unset($_SESSION['studente']);
        return Routes::redirectTo('login','studenti');
    }

}

?>