<?php

/**
* StudentiController
* Controller dell'area riservata
* agli studenti laureati
*
* @author     Gianluca Bonifazi
* @category   controllers 
* @copyright  STI Uniurb (c) 2017
*/

class StudentiController {


    // Action della pagina con le info
    // collegate allo studente che ha 
    // fatto il login
    public function index() {

      // Di default nascondo gli alert
      // dove sarà stampato il risultato
      // dell'avvenuto (o meno) upload del cv
      $hide_ok_cv = 'hide';
      $hide_err_cv = 'hide';

      // Controllo se esiste la sessione
      // che permette la navigazione dell'area riservata
      // altrimenti faccio il redirect alla login
      if (Session::checkSession('studenti')) {
        $username = htmlspecialchars($_SESSION['studente']);
      } else {
        return Routes::redirectTo('login','studenti');
      }

      // Controllo se è stato inviato un file
      // alla variabile globale default del PHP
      if ($_FILES) {

        // Richiedo la classe per fare l'upload
        require('config/upload.php');
        // Inizializzo un oggetto di tipo Upload
        // passandogli il file ricevuto come parametro
        $handle = new Upload($_FILES['CV_upload']);
        // Array contenente i MIME type permessi
        $file_allowed = array('application/pdf', 'image/jpeg', 'image/png');

        // Controllo se il file è di tipo PDF, JPG o PNG
        if (in_array($_FILES['CV_upload']['type'], $file_allowed)) {

          if ($handle->uploaded) {

            // Dimensione massima del file: 3MB
            $handle->file_max_size = '25165824';
            // Aggiungo al file il numero di matricola
            $handle->file_name_body_add = '_'.$username;
            // Cartella dove caricare i curriculum
            $handle->process('assets/files/cv/');

            if ($handle->processed) {

              // Richiamo il meotodo all'interno del Model
              // per aggiornare il database con il nuovo file
              if (Studenti::uploadCV($handle->file_dst_name,$username)) {
                // Upload del file e update della
                // tabella andato a buon fine
                $hide_ok_cv = '';
              } else {
                // Stampo l'errore
                $hide_err_cv = '';
              }
            } else {
              // Stampo l'errore
              $hide_err_cv = '';
            }
          } else {
            // Stampo l'errore
            $hide_err_cv = '';
          }
          // Pulisco l'handle
          // della classe upload
          $handle->Clean();
        } else {
          // Stampo l'errore
          $hide_err_cv = '';
        }

    }
      // Richiamo il metodo all'interno del Model
      // che mi estrae dal database tutti i valori
      // correlati all'utente
      $students = Studenti::userData($username);

      // Richiedo la vista collegata alla
      // pagina principale dell'area riservata
      // agli studenti laureati
      require_once('views/studenti/index.php');
    }


    // Action della pagina per la modifica
    // dei dati dello studente laureato
    public function impostazioni() {

      // Controllo se esiste la sessione
      // che permette la navigazione dell'area riservata
      // altrimenti faccio il redirect alla login
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
            // Richiamo il metodo dentro il Model
            // per fare l'update dei dati nel database
            if(Studenti::updateData($clean_value,$username)){
              // Mostro l'alert di conferma 
              $hide_ok_user = '';
            } else {
              // Mostro l'alert di errore
              $hide_err_user = '';
            }
          }

      }

      // Richiamo il metodo all'interno del Model
      // che mi estrae dal database tutti i valori
      // correlati all'utente
      $students = Studenti::userData($username);

      // Richiedo la vista collegata alla
      // pagina di modifica dei dati
      // dello studenti laureato loggato
      require_once('views/studenti/impostazioni.php');
    }
    

    // Action per il logout dall'area riservata
    public function logout() {
        Session::destroySession();
        return Routes::redirectTo('login','studenti');
    }

}

?>