<?php

/**
 * Routes
 * Gestione delle rotte
 *
 * Classe per la gestione delle 
 * rotte (routes) dell'applicazione.
 * L'applicazione gira all'interno del
 * metodo call il quale gestisce 
 * l'invocazione di modelli, viste e
 * controllori in base ai $_GET
 *
 * @author     Gianluca Bonifazi
 * @category   config 
 * @copyright  STI Uniurb (c) 2017
 */

class Routes {

  // Metodo call() utilizzato per
  // gestire le chiamate ai controller
  // e ai loro rispettivi metodi
  public static function call($controller, $action) {

    // Richiedo il file che corrisponde
    // al nome del Controller
    require_once('controllers/' . $controller . 'Controller.php');

    // Creo una nuova istanza del
    // controllore richiesto
    switch($controller) {
      case 'pages':
        require_once('models/Pages.php');
        $controller = new PagesController();
      break;
      case 'login':
        require_once('models/Login.php');
        $controller = new LoginController();
      break;
      case 'registrazione':
        require_once('models/Registrazione.php');
        $controller = new RegistrazioneController();
      break;


      case 'aziende':
        require_once('models/Aziende.php');
        $controller = new AziendeController();
      break;
      case 'studenti':
        require_once('models/Studenti.php');
        $controller = new StudentiController();
      break;
    }

    // Chiamo il metodo (action)
    // all'interno del controller
    $controller->{ $action }();

  }


  // Lista dei controller e dei
  // metodi considerati validi
  private function routeList(){

  	return array(
	    'pages'         => ['home', 'error'],
	    'login'         => ['studenti', 'aziende', 'riservata'],
	    'registrazione' => ['index','privacy'],
	    'aziende'       => ['index','impostazioni', 'dettaglio','logout'],
	    'studenti'      => ['index','impostazioni','logout']
	  );

  }


  // Metodo che serve a controllare
  // la validità dell'url tramite i due
  // valori arrivati in $_GET
  public function existsRoute($controller,$action){

  	  // Inizializzo una variabile con l'array
  	  // contenente la lista delle rotte
  	  $controllers = new Routes();
  	  $controllers = $controllers->routeList();

	  // Mi assicuro che il controller e il
	  // metodo passati siano entrambi validi
	  // per poi invocare il metodo call() con
	  // i parametri esatti.
	  // Se qualcuno prova ad accedere in modo
	  // errato sarà chiamata la funzione
	  // call() alla quale sarà passato controller
	  // e metodo per stampare errore
	  if (array_key_exists($controller, $controllers)) {
	    if (in_array($action, $controllers[$controller])) {
	      Routes::call($controller, $action);
	    } else {
	      Routes::call('pages', 'error');
	    }
	  } else {
	    Routes::call('pages', 'error');
	  }
    
  }


  // Metodo utilizzato per il redirect che
  // funziona anche con javascript disabilitato
  public static function redirectTo($controller,$action) {

    // Compongo l'URL
    $url = APP_URL.'/'.$controller.'/'.$action;

      // Controllo se l'header è già stato settato
      if (!headers_sent()) {    
          header('Location: '.$url);
          die();
      // Atrimenti uso Javascript
      } else {  
          echo '<script type="text/javascript">';
          echo 'window.location.href="'.$url.'";';
          echo '</script>';
          echo '<noscript>';
          echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
          echo '</noscript>';
          die();
      }
  }

}
?>