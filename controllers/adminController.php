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
                  } else {
                    // Pagina Modifica
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
                    'voto_laurea'   => FILTER_SANITIZE_ENCODED,
                    'anno_laurea' => FILTER_SANITIZE_ENCODED,
                    'anno_nascita'  => FILTER_SANITIZE_ENCODED,
                    'provincia'   => FILTER_SANITIZE_ENCODED,
                    'curriculum'  => FILTER_SANITIZE_SPECIAL_CHARS,
                    'cognome'   => FILTER_SANITIZE_ENCODED
                  );
                  // Tramite la funzione filter_input_array pulisco
                  // i dati ricevuti in caso ci fossero stati
                  // tentativi di manomissione
                  $clean_value = filter_input_array(INPUT_POST, $args);
                  // Faccio la chiamata al metodo del Model 
                  // passandogli i parametri appena puliti
                  $students = Admin::advancedSearchStudenti($clean_value);
                }
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
                
                require_once('views/admin/aziende/'.$pagina.'.php');

              } else {

                return Routes::redirectTo('admin','aziende');

              }

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

      require_once('views/admin/impostazioni.php');
    }



    public function newsletter() {

      // Controllo la sessione
      if (Session::checkSession('admin')) {
        $username = htmlspecialchars($_SESSION['gestore']);
      } else {
        return Routes::redirectTo('login','riservata');
      }

      require_once('views/admin/newsletter.php');
    }



    public function logout() {
      Session::destroySession();
      return Routes::redirectTo('login','riservata');
    }


  }
?>