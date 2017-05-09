<?php

/**
* AdminController
* Controller dell'area riservata
* al gestore del sistema
*
* @author     Gianluca Bonifazi
* @category   controllers 
* @copyright  STI Uniurb (c) 2017
*/

class AdminController {


    // Action della pagina iniziale 
    // dell'area riservata dove
    // sono visualizzabili le statistiche
    public function index() {

        // Controllo se esiste la sessione
        // che permette la navigazione dell'area riservata
        // altrimenti faccio il redirect alla login
        if (Session::checkSession('admin')) {
          $username = htmlspecialchars($_SESSION['gestore']);
        } else {
          return Routes::redirectTo('login','riservata');
        }
        // Richiedo le informazioni sull'ultimo 
        // login effettauto dall'amministratore
        $info = Admin::lastLogin();
        // Calcolo gli ultimi 7 giorni
        $last_seven = [
          date('Y-m-d', strtotime('-6 days')),
          date('Y-m-d', strtotime('-5 days')),
          date('Y-m-d', strtotime('-4 days')),
          date('Y-m-d', strtotime('-3 days')),
          date('Y-m-d', strtotime('-2 days')),
          date('Y-m-d', strtotime('-1 days')),
          date('Y-m-d')
        ];
        // Login aziende ultimi 7 giorni
        $lastLoginAziende = Admin::lastLoginAziende($last_seven);
        // Login studenti ultimi 7 giorni
        $lastLoginStudenti = Admin::lastLoginStudenti($last_seven);
        // Media voto di laurea
        $votoLaurea = Admin::votoLaurea();
        // Numero di laureati per ogni anno del CdL
        $laureatiAnnuali = Admin::laureatiPerAnno();
        // Media voto di laurea per ogni anno del CdL
        $avgVoto = Admin::mediaVotoAnno();

        // Richiedo la vista collegata alla
        // pagina principale dell'area riservata
        // al gestore del sistema
        require_once('views/admin/index.php');
    }


    // Action delle pagine riguardanti
    // la gestione dei laureati
    public function laureati() {

        // Controllo se esiste la sessione
        // che permette la navigazione dell'area riservata
        // altrimenti faccio il redirect alla login
        if (Session::checkSession('admin')) {
          $username = htmlspecialchars($_SESSION['gestore']);
        } else {
          return Routes::redirectTo('login','riservata');
        }
        
        // Ricevo in GET la pagina alla quale
        // correlare il controllore
        // Pagine accettate:
        // - modifica
        // - inserimento
        // - ricerca
        // - dettaglio
        $pagina = isset($_GET['pagina']);
        // Se non è stata passata nessuna pagina
        // allora stampo la index
        if ($pagina){

          // Leggo il valore
          $pagina = $_GET['pagina'];
          // Array con le pagine accettate
          $allow_page = ['modifica','inserimento','ricerca','dettaglio'];
          // Controllo se la pagina è una di quelle
          // accettate. Se esite entro
          if(in_array($pagina, $allow_page)){

            // Se la pagina è:
            // - modifica
            // - dettaglio
            // ho un altro GET da ricevere che fa
            // riferimento all'id dello studente
            if ($pagina == 'dettaglio' || $pagina == 'modifica') {

              // Controllo se l'id dello studente laureato
              // è correttamente passato in GET
              $query = isset($_GET['query']);

              if ($query) {
                // Leggo il valore
                $query = $_GET['query'];
                  
                  // Se la pagina è 'detaglio'
                  if ($pagina == 'dettaglio') {

                    // Richiedo i dettagli dello
                    // studente passando come parametro
                    // il valore ricevuto in GET
                    $students = Admin::userData($query);

                  // Se la pagina è 'modifica'
                  } else if ($pagina == 'modifica'){

                    // Nascondo gli alert di default
                    $hide_ok_user = 'hide';
                    $hide_err_user = 'hide';
                    $hide_ok_tesi = 'hide';
                    $hide_err_tesi = 'hide';

                    // Entro se si stanno modificando i dati dal form
                    if ($_POST) {
                      // Array per il sanitize del $_POST
                      $args = array(
                        'Nome'        => FILTER_SANITIZE_SPECIAL_CHARS,
                        'Cognome'     => FILTER_SANITIZE_SPECIAL_CHARS,
                        'Matricola'   => FILTER_SANITIZE_SPECIAL_CHARS,
                        'Data_n'      => FILTER_SANITIZE_SPECIAL_CHARS,
                        'Sesso'       => FILTER_SANITIZE_SPECIAL_CHARS,
                        'CF'          => FILTER_SANITIZE_SPECIAL_CHARS,
                        'Luogo_n'     => FILTER_SANITIZE_SPECIAL_CHARS,
                        'Prov_n'      => FILTER_SANITIZE_SPECIAL_CHARS,
                        'Luogo_r'     => FILTER_SANITIZE_SPECIAL_CHARS,
                        'Prov_r'      => FILTER_SANITIZE_SPECIAL_CHARS,
                        'Telefono'    => FILTER_SANITIZE_SPECIAL_CHARS,
                        'e_mail'      => FILTER_VALIDATE_EMAIL,
                        'curriculum'  => FILTER_SANITIZE_SPECIAL_CHARS,
                        'Titolo_tesi' => FILTER_SANITIZE_SPECIAL_CHARS,
                        'tipologia'   => FILTER_SANITIZE_SPECIAL_CHARS,
                        'relatore'    => FILTER_SANITIZE_SPECIAL_CHARS,
                        'Voto_laurea' => FILTER_VALIDATE_INT,
                        'cum_laude'   => FILTER_SANITIZE_SPECIAL_CHARS,
                        'Data_Laurea' => FILTER_SANITIZE_SPECIAL_CHARS,
                        'Note'        => FILTER_SANITIZE_SPECIAL_CHARS,
                        'Visibility'  => FILTER_VALIDATE_INT
                      );
                      // Tramite la funzione filter_input_array pulisco
                      // i dati ricevuti in caso ci fossero stati
                      // tentativi di manomissione
                      $clean_value = filter_input_array(INPUT_POST, $args);
                      // Richiamo la funzione dentro il Model
                      // per fare l'update dei dati dello studente
                      if(Admin::updateDataStudente($clean_value,$query)){
                        // Mostro l'alert di conferma 
                        $hide_ok_user = '';
                      } else {
                        // Mostro l'alert di errore
                        $hide_err_user = '';
                      }
                    }

                    // Entro qui se sto effettuando il caricamento della tesi
                    if ($_FILES) {
                    
                        // Richiedo i dettagli dello
                        // studente passando come parametro
                        // il valore ricevuto in GET
                        $students = Admin::userData($query);

                        // Richiedo il file con la classe Upload
                        require('config/upload.php');
                        // Inizializzo un oggetto di tipo Upload
                        // passandogli il file ricevuto come parametro
                        $handle = new Upload($_FILES['Tesi_upload']);
                        // Array contenente i MIME type permessi
                        $file_allowed = array('application/pdf', 'image/jpeg', 'image/png');

                        // Controllo se il file è di tipo PDF, JPG o PNG
                        if (in_array($_FILES['Tesi_upload']['type'], $file_allowed)) {

                          if ($handle->uploaded) {

                            // Dimensione massima del file: 10MB
                            $handle->file_max_size = '82331648';
                            // Scrivo il nome del file con Matricola.Nome.Cognome
                            $handle->file_new_name_body = $students->Matricola.$students->Nome.$students->Cognome;
                            // Cartella dove caricare le tesi
                            $handle->process('assets/files/tesi/');

                            if ($handle->processed) {

                              // Richiamo il meotodo all'interno del Model
                              // per aggiornare il database con il nuovo file
                              if (Admin::uploadTesi($handle->file_dst_name,$query)) {
                                // Upload del file e update della
                                // tabella andato a buon fine
                                $hide_ok_tesi = '';
                              } else {
                                // Stampo l'errore
                                $hide_err_tesi = '';
                              }
                            } else {
                              // Stampo l'errore
                              $hide_err_tesi = '';
                            }
                          } else {
                            // Stampo l'errore
                            $hide_err_tesi = '';
                          }
                          // Pulisco l'handle
                          // della classe upload
                          $handle->Clean();
                        } else {
                          // Stampo l'errore
                          $hide_err_tesi = '';
                        }

                    }

                    // Leggo dal database tutti i curriculum
                    $curriculum = Admin::getCv();
                    // Richiedo i dettagli dello
                    // studente passando come parametro
                    // il valore ricevuto in GET
                    $students = Admin::userData($query);
                  }

                // Richiedo la vista collegata alla
                // pagina arrivata in GET
                require_once('views/admin/laureati/'.$pagina.'.php');

              } else {
                // Se la pagina non è tra quelle 
                // ammesse faccio il redirect alla index
                // dei laureati
                return Routes::redirectTo('admin','laureati');

              }

            } else {

              // Se la pagina è ricerca
              if ($pagina == 'ricerca') {
                if ($_POST) {
                  // Array per il sanitize del $_POST
                  $args = array(
                    'voto_laurea1'   => FILTER_SANITIZE_ENCODED,
                    'voto_laurea2'   => FILTER_SANITIZE_ENCODED,
                    'anno_laurea1' => FILTER_SANITIZE_ENCODED,
                    'anno_laurea2' => FILTER_SANITIZE_ENCODED,
                    'anno_nascita'  => FILTER_SANITIZE_ENCODED,
                    'provincia'   => FILTER_SANITIZE_ENCODED,
                    'curriculum'  => FILTER_SANITIZE_SPECIAL_CHARS,
                    'cognome'   => FILTER_SANITIZE_ENCODED,
                    'relatore'   => FILTER_SANITIZE_ENCODED,
                    'tipologia'   => FILTER_SANITIZE_SPECIAL_CHARS
                  );
                  // Tramite la funzione filter_input_array pulisco
                  // i dati ricevuti in caso ci fossero stati
                  // tentativi di manomissione
                  $clean_value = filter_input_array(INPUT_POST, $args);
                  // Faccio la chiamata al metodo del Model 
                  // passandogli i parametri appena puliti
                  $students = Admin::advancedSearchStudenti($clean_value);
                }
                // Leggo dal database tutti i curriculum
                $curriculum = Admin::getCv();
              }

              // Se la pagina è 'inserimento'
              if ($pagina == 'inserimento') {

                // Nascondo di default gli alert
                $hide_ok_insert = 'hide';
                $hide_err_insert = 'hide';

                if ($_POST) {
                  // Array per il sanitize del $_POST
                  $args = array(
                    'Nome'        => FILTER_SANITIZE_SPECIAL_CHARS,
                    'Cognome'     => FILTER_SANITIZE_SPECIAL_CHARS,
                    'Matricola'   => FILTER_SANITIZE_SPECIAL_CHARS,
                    'Sesso'       => FILTER_SANITIZE_SPECIAL_CHARS,
                    'e_mail'      => FILTER_VALIDATE_EMAIL,
                    'curriculum'  => FILTER_SANITIZE_SPECIAL_CHARS,
                    'Titolo_tesi' => FILTER_SANITIZE_SPECIAL_CHARS,
                    'tipologia'   => FILTER_SANITIZE_SPECIAL_CHARS,
                    'relatore'    => FILTER_SANITIZE_SPECIAL_CHARS,
                    'Voto_laurea' => FILTER_VALIDATE_INT,
                    'cum_laude'   => FILTER_SANITIZE_SPECIAL_CHARS,
                    'Data_Laurea' => FILTER_SANITIZE_SPECIAL_CHARS,
                    'Visibility'  => FILTER_VALIDATE_INT,
                    'Password'    => FILTER_SANITIZE_SPECIAL_CHARS,
                    'Password2'    => FILTER_SANITIZE_SPECIAL_CHARS
                  );
                  // Tramite la funzione filter_input_array pulisco
                  // i dati ricevuti in caso ci fossero stati
                  // tentativi di manomissione
                  $clean_value = filter_input_array(INPUT_POST, $args);

                  // Se le password corrispondono continuo
                  // nell'esecuzione altrimenti stampo errore
                  if ($clean_value['Password'] === $clean_value['Password2']) {


                    if ($_FILES) {

                        // Richiedo il file con la classe Upload
                        require('config/upload.php');
                        // Inizializzo un oggetto di tipo Upload
                        // passandogli il file ricevuto come parametro
                        $handle = new Upload($_FILES['Tesi_upload']);
                        // Array contenente i MIME type permessi
                        $file_allowed = array('application/pdf', 'image/jpeg', 'image/png');

                        // Controllo se il file è di tipo PDF, JPG o PNG
                        if (in_array($_FILES['Tesi_upload']['type'], $file_allowed)) {

                          if ($handle->uploaded) {

                            // Dimensione massima del file: 10MB
                            $handle->file_max_size = '82331648';
                            // Scrivo il nome del file
                            $handle->file_new_name_body = $clean_value['Matricola'].$clean_value['Nome'].$clean_value['Cognome'];
                            // Cartella dove caricare le tesi
                            $handle->process('assets/files/tesi/');

                            if ($handle->processed) {

                                $clean_value['Tesi_download'] = $handle->file_dst_name;

                                // Faccio la chiamata al metodo del Model 
                                // passandogli i parametri appena puliti
                                if(Admin::insertNewLaureato($clean_value)){
                                  // Upload del file e update della
                                  // tabella andato a buon fine
                                  $hide_ok_insert = '';
                                } else {
                                  // Stampa l'errore
                                  $hide_err_insert = '';
                                }
                            } else {
                              // Stampa l'errore
                              $hide_err_insert = '';
                            }
                          } else {
                            // Stampa l'errore
                            $hide_err_insert = '';
                          }
                          // Pulisco l'handle
                          // della classe upload
                          $handle->Clean();
                        } else {
                          // Stampa l'errore
                          $hide_err_insert = '';
                        }
                    }
                  } else {
                    // Stampa l'errore
                    $hide_err_insert = '';
                  }
                }
                // Leggo dal database tutti i curriculum
                $curriculum = Admin::getCv();
              }

              // Richiedo la vista collegata alla
              // pagina arrivata in GET
              require_once('views/admin/laureati/'.$pagina.'.php');
            }

          } else {

            // Se la pagina non è tra quelle 
            // ammesse faccio il redirect alla index
            // dei laureati
            return Routes::redirectTo('admin','laureati');

          }

        // Se la pagina non arriva in GET
        // allora stampo la index
        } else {

          // Lista di tutti i studenti
          $students = Admin::getListStudenti();

          // Richiedo la vista collegata alla
          // pagina principale dei laureati
          require_once('views/admin/laureati.php');

        }
    }


    // Action delle pagine riguardanti
    // la gestione delle aziende
    public function aziende() {

        // Controllo se esiste la sessione
        // che permette la navigazione dell'area riservata
        // altrimenti faccio il redirect alla login
        if (Session::checkSession('admin')) {
          $username = htmlspecialchars($_SESSION['gestore']);
        } else {
          return Routes::redirectTo('login','riservata');
        }
        
        // Pagine accettate:
        // - modifica
        $pagina = isset($_GET['pagina']);
        // Se non è stata passata nessuna pagina stampo la index
        if ($pagina){
          // Leggo il valore
          $pagina = $_GET['pagina'];
          // Controllo se la pagina è
          // 'modifica'. Se essite entro
          if($pagina == 'modifica'){

              // Controllo se è settato l'id
              $query = isset($_GET['query']);
              if ($query) { 
                // Leggo l'id
                $query = $_GET['query'];
                    // Nascondo di default gli alert
                    $hide_ok_azienda = 'hide';
                    $hide_err_azienda = 'hide';

                    // Entro se sto modificando i dati dal form
                    if ($_POST) {

                      // Modifica dei dati dell'azienda
                      if ($_POST['type_query'] == '0') {
                        // Array per il sanitize del $_POST
                        $args = array(
                          'r_sociale'   => FILTER_SANITIZE_SPECIAL_CHARS,
                          'nome'        => FILTER_SANITIZE_SPECIAL_CHARS,
                          'cognome'     => FILTER_SANITIZE_SPECIAL_CHARS,
                          'email'      => FILTER_VALIDATE_EMAIL,
                          'newsletter'  => FILTER_SANITIZE_SPECIAL_CHARS,
                          'username'    => FILTER_SANITIZE_SPECIAL_CHARS,
                        );
                        // Tramite la funzione filter_input_array pulisco
                        // i dati ricevuti in caso ci fossero stati
                        // tentativi di manomissione
                        $clean_value = filter_input_array(INPUT_POST, $args);
                        // Richiamo la funzione dentro il Model
                        // per fare l'update dei dati dell'azienda
                        if(Admin::updateDataAzienda($clean_value,$query)){
                          // Mostro l'alert di conferma 
                          $hide_ok_azienda = '';
                        } else {
                          // Mostro l'alert di errore
                          $hide_err_azienda = '';
                        }
                      }

                      // Modifica della password dell'azienda
                      if ($_POST['type_query'] == '1') {
                        // Controllo se le due password corrispondono
                        if ($_POST['password'] === $_POST['password2']) {
                          // Richiamo la funzione dentro il Model
                          // per fare l'update dei dati
                          if(Admin::updatePwdAzienda($_POST['password'],$query)){
                            // Mostro l'alert di conferma 
                            $hide_ok_azienda = '';
                          } else {
                            // Mostro l'alert di errore
                            $hide_err_azienda = '';
                          }
                        } else {
                          // Mostro l'alert di errore
                          $hide_err_azienda = '';
                        }

                      }

                      // Cancellazione dell'azienda
                      if ($_POST['type_query'] == '2') {
                          // Richiamo il model passandogli
                          // come parametro l'id dell'azienda
                          // la quale andrà cancellata
                          if(Admin::deleteAzienda($query)){
                            // Faccio il redirect alla home delle aziende
                            return Routes::redirectTo('admin','aziende');
                          } else {
                            // Mostro l'alert di errore
                            $hide_err_azienda = '';
                          }
                      }
                    }


                  }
                  // Leggo dal database i dettagli
                  // dell'azienda passando come 
                  // parametro l'id dell'azienda
                  $azienda = Admin::getAzienda($query);
                
                  // Richiedo la vista collegata alla
                  // pagina arrivata in GET
                  require_once('views/admin/aziende/'.$pagina.'.php');

              } else {
                // Faccio il redirect alla home delle aziende
                return Routes::redirectTo('admin','aziende');
              }

          } else {

            // Leggo dal database la lista
            // delle azienda
            $companies = Admin::getListAziende();

            // Richiedo la vista collegata alla
            // pagina di homepage delle aziende
            require_once('views/admin/aziende.php');
          }
    }


    // Action della pagina riguardante
    // la gestione dei curriculum del CdL
    public function curriculum() {

      // Nascondo di default l'alert
      $hide = 'hide';

      // Controllo se esiste la sessione
      // che permette la navigazione dell'area riservata
      // altrimenti faccio il redirect alla login
      if (Session::checkSession('admin')) {
        $username = htmlspecialchars($_SESSION['gestore']);
      } else {
        return Routes::redirectTo('login','riservata');
      }

      if ($_POST) {
        // Se il nome del Curriculum è correttamente
        // settato richiamo il Model che fa l'update
        // della tabella dei curriculum
        if(isset($_POST['cv_nome']) && $_POST['cv_nome'] != ''){
          if(Admin::addCv($_POST['cv_nome'])){
            // Mostro l'alert di conferma
            $hide = '';
          }
        }
      }
      // Leggo dal database tutti i curriculum
      $curriculum = Admin::getCv();

      // Richiedo la vista collegata alla
      // pagina di gestione dei curriculum
      require_once('views/admin/curriculum.php');
    }


    // Action della pagina riguardante
    // la modifica della pwd dell'admin
    public function impostazioni() {

      // Controllo se esiste la sessione
      // che permette la navigazione dell'area riservata
      // altrimenti faccio il redirect alla login
      if (Session::checkSession('admin')) {
        $username = htmlspecialchars($_SESSION['gestore']);
      } else {
        return Routes::redirectTo('login','riservata');
      }

      // Nascondo gli alert di default
      $hide_ok_pwd = 'hide';
      $hide_err_pwd = 'hide';

      if ($_POST) {
        // Se le password corrispondono proseguo
        if ($_POST['pwd_nuova'] === $_POST['pwd_nuova2']) {
          // Faccio l'update tramite il Model
          if (Admin::updatePwdAdmin($_POST)) {
            $hide_ok_pwd = '';
            $info_pwd = 'hide';
          } else {
            $hide_err_pwd = '';
            $info_pwd = 'hide';
          }
        } else {
          $hide_err_pwd = '';
          $info_pwd = 'hide';
        }
      }

      // Richiedo la vista collegata alla
      // pagina di impostazione dell'admin
      require_once('views/admin/impostazioni.php');
    }


    // Action della pagina riguardante
    // la gestione della newsletter
    public function newsletter() {

      // Controllo se esiste la sessione
      // che permette la navigazione dell'area riservata
      // altrimenti faccio il redirect alla login
      if (Session::checkSession('admin')) {
        $username = htmlspecialchars($_SESSION['gestore']);
      } else {
        return Routes::redirectTo('login','riservata');
      }

      // Nascondo gli alert di default
      $hide_ok_view = 'hide';
      $hide_ok_dw = 'hide';
      
      if ($_POST) {

        // Estraggo solo le mail di tutti i laureati
        if ($_POST['tipo_query'] == '0') {
          // Mostro il risultato
          $hide_ok_view = '';
          // Estraggo tutte le email dei laureati
          $email_data = Admin::extractEmail($_POST['tipo_query']);

        // Creazione del CSV con scelta dei campi
        // per i laureati
        } else if ($_POST['tipo_query'] == '1') {
          // Mostro il risultato
          $hide_ok_dw = '';
          // Estraggo tutti i valori scelti dei laureati
          $student_data = Admin::extractLaureati($_POST);
          // Path del file da sovrascrivere
          $path_csv = __DIR__ . '/../assets/files/newsletter.csv';
          // Controllo se sono su server Windows o Unix
          if (DIRECTORY_SEPARATOR == '\\') {
              $path_csv = str_replace('/', '\\', $path_csv);
          }
          // Scrivo il file CSV
          $fp = fopen($path_csv, 'w');
          foreach ($student_data as $fields => $value) {
              fputcsv($fp, $value);
          }
          fclose($fp);

        // Estraggo solo le mail di tutte le aziende
        } else if ($_POST['tipo_query'] == '2') {
          // Mostro il risultato
          $hide_ok_view = ''; 
          // Estraggo tutte le email delle aziende
          $email_data = Admin::extractEmail($_POST['tipo_query']);

        // Query con scelta delle aziende
        } else if ($_POST['tipo_query'] == '3') {
          // Mostro il risultato
          $hide_ok_dw = '';
          // Estraggo tutti i valori scelti delle aziende
          $company_data = Admin::extractAziende($_POST);
          // Path del file da sovrascrivere
          $path_csv = __DIR__ . '/../assets/files/newsletter.csv';
          // Controllo se sono su server Windows o Unix
          if (DIRECTORY_SEPARATOR == '\\') {
              $path_csv = str_replace('/', '\\', $path_csv);
          }
          // Scrivo il file CSV
          $fp = fopen($path_csv, 'w');
          foreach ($company_data as $fields => $value) {
              fputcsv($fp, $value);
          }
          fclose($fp);
        }

      }

      // Richiedo la vista collegata alla
      // pagina della gestione della newsletter
      require_once('views/admin/newsletter.php');
    }


    // Action per il logout dall'area riservata
    public function logout() {
      Session::destroySession();
      return Routes::redirectTo('login','riservata');
    }


  }
?>