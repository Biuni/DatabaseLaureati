<?php
  class AdminController {

    public function index() {

        // Controllo la sessione
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

        require_once('views/admin/index.php');
    }



    public function laureati() {

        // Controllo la sessione
        if (Session::checkSession('admin')) {
          $username = htmlspecialchars($_SESSION['gestore']);
        } else {
          return Routes::redirectTo('login','riservata');
        }
        
        // Pagine accettate:
        // - modifica
        // - inserimento
        // - ricerca
        // - dettaglio
        $pagina = isset($_GET['pagina']);
        // Se non è stata passata nessuna pagina stampo l'index
        if ($pagina){

          $pagina = $_GET['pagina'];

          $allow_page = ['modifica','inserimento','ricerca','dettaglio'];
          // Controllo se la pagina è una di quelle
          // accettate. Se essite entro
          if(in_array($pagina, $allow_page)){

            if ($pagina == 'dettaglio' || $pagina == 'modifica') {
              // Leggo l'id di riferimento
              $query = isset($_GET['query']);
              if ($query) {

                $query = $_GET['query'];
                
                  if ($pagina == 'dettaglio') {

                    $students = Admin::userData($query);

                  } else if ($pagina == 'modifica'){

                    $hide_ok_user = 'hide';
                    $hide_err_user = 'hide';
                    $hide_ok_tesi = 'hide';
                    $hide_err_tesi = 'hide';

                    // Entro se sto modificando i dati dal form
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
                      // per fare l'update dei dati
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
                    
                        $students = Admin::userData($query);

                        require('config/upload.php');
                        $handle = new Upload($_FILES['Tesi_upload']);
                        $file_allowed = array('application/pdf', 'image/jpeg', 'image/png');

                        // Controllo se il file è di tipo PDF, JPG o PNG
                        if (in_array($_FILES['Tesi_upload']['type'], $file_allowed)) {

                          if ($handle->uploaded) {

                            // Dimensione massima del file: 6MB
                            $handle->file_max_size = '50331648';
                            // Scrivo il nome del file
                            $handle->file_new_name_body = $students->Matricola.$students->Nome.$students->Cognome;
                            // Cartella dove caricare i curriculum
                            $handle->process('assets/files/tesi/');

                            if ($handle->processed) {

                              if (Admin::uploadTesi($handle->file_dst_name,$query)) {
                                // Upload del file e update della
                                // tabella andato a buon fine
                                $hide_ok_tesi = '';
                                
                              } else {
                                $hide_err_tesi = '';
                              }

                            } else {
                              $hide_err_tesi = '';
                            }

                          } else {
                            $hide_err_tesi = '';
                          }
                          
                          $handle->Clean();

                        } else {
                          $hide_err_tesi = '';
                        }

                    }

                    $curriculum = Admin::getCv();
                    $students = Admin::userData($query);
                  }

                require_once('views/admin/laureati/'.$pagina.'.php');

              } else {

                return Routes::redirectTo('admin','laureati');

              }

            } else {

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
                    'relatore'   => FILTER_SANITIZE_ENCODED
                  );
                  // Tramite la funzione filter_input_array pulisco
                  // i dati ricevuti in caso ci fossero stati
                  // tentativi di manomissione
                  $clean_value = filter_input_array(INPUT_POST, $args);
                  // Faccio la chiamata al metodo del Model 
                  // passandogli i parametri appena puliti
                  $students = Admin::advancedSearchStudenti($clean_value);
                }
                $curriculum = Admin::getCv();
              }

              if ($pagina == 'inserimento') {

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

                  // Se le password corrispondono
                  if ($clean_value['Password'] === $clean_value['Password2']) {
                    // Faccio la chiamata al metodo del Model 
                    // passandogli i parametri appena puliti
                    if(Admin::insertNewLaureato($clean_value)){
                      $hide_ok_insert = '';
                    } else {
                      $hide_err_insert = '';
                    }
                  } else {
                    $hide_err_insert = '';
                  }
                }
                
                $curriculum = Admin::getCv();
              }

              require_once('views/admin/laureati/'.$pagina.'.php');

            }

          } else {

            return Routes::redirectTo('admin','laureati');

          }

        } else {

          // Li sta di tutti i studenti
          $students = Admin::getListStudenti();

          require_once('views/admin/laureati.php');

        }
    }



    public function aziende() {

        // Controllo la sessione
        if (Session::checkSession('admin')) {
          $username = htmlspecialchars($_SESSION['gestore']);
        } else {
          return Routes::redirectTo('login','riservata');
        }
        
        // Pagine accettate:
        // - modifica
        $pagina = isset($_GET['pagina']);
        // Se non è stata passata nessuna pagina stampo l'index
        if ($pagina){

          $pagina = $_GET['pagina'];
          // Controllo se la pagina è una di quelle
          // accettate. Se essite entro
          if($pagina == 'modifica'){

              // Leggo l'id di riferimento
              $query = isset($_GET['query']);
              if ($query) {

                $query = $_GET['query'];

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
                        // per fare l'update dei dati
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
                          if(Admin::deleteAzienda($query)){
                            return Routes::redirectTo('admin','aziende');
                          } else {
                            // Mostro l'alert di errore
                            $hide_err_azienda = '';
                          }
                      }

                    }


                  }
                  $azienda = Admin::getAzienda($query);
                
                require_once('views/admin/aziende/'.$pagina.'.php');

              } else {

                return Routes::redirectTo('admin','aziende');

              }

          } else {

            $companies = Admin::getListAziende();

            require_once('views/admin/aziende.php');

          }
    }



    public function curriculum() {

      $hide = 'hide';

      // Controllo la sessione
      if (Session::checkSession('admin')) {
        $username = htmlspecialchars($_SESSION['gestore']);
      } else {
        return Routes::redirectTo('login','riservata');
      }

      if ($_POST) {
        if(isset($_POST['cv_nome']) && $_POST['cv_nome'] != ''){
          if(Admin::addCv($_POST['cv_nome'])){
            $hide = '';
          }
        }
      }

      $curriculum = Admin::getCv();

      require_once('views/admin/curriculum.php');
    }



    public function impostazioni() {

      // Controllo la sessione
      if (Session::checkSession('admin')) {
        $username = htmlspecialchars($_SESSION['gestore']);
      } else {
        return Routes::redirectTo('login','riservata');
      }

      $hide_ok_pwd = 'hide';
      $hide_err_pwd = 'hide';

      if ($_POST) {
        if ($_POST['pwd_nuova'] === $_POST['pwd_nuova2']) {
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

      require_once('views/admin/impostazioni.php');
    }



    public function newsletter() {

      // Controllo la sessione
      if (Session::checkSession('admin')) {
        $username = htmlspecialchars($_SESSION['gestore']);
      } else {
        return Routes::redirectTo('login','riservata');
      }

      $hide_ok_view = 'hide';
      $hide_ok_dw = 'hide';
      
      if ($_POST) {

        // Estraggo solo le mail di tutti i laureati
        if ($_POST['tipo_query'] == '0') {
          $hide_ok_view = '';
          $email_data = Admin::extractEmail($_POST['tipo_query']);

        // Query con scelta dei laureati
        } else if ($_POST['tipo_query'] == '1') {
          $hide_ok_dw = '';
          $student_data = Admin::extractLaureati($_POST);

          $path_csv = __DIR__ . '/../assets/files/newsletter.csv';

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
          $hide_ok_view = ''; 
          $email_data = Admin::extractEmail($_POST['tipo_query']);

        // Query con scelta delle aziende
        } else if ($_POST['tipo_query'] == '3') {
          $hide_ok_dw = '';
          $company_data = Admin::extractAziende($_POST);

          $path_csv = __DIR__ . '/../assets/files/newsletter.csv';

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

      require_once('views/admin/newsletter.php');
    }



    public function logout() {
      Session::destroySession();
      return Routes::redirectTo('login','riservata');
    }


  }
?>