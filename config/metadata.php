<?php 

/**
 * Metadata
 * Informazioni per i meta tag HTML
 *
 * Classe per la gestione delle 
 * informazioni inserite all'interno
 * dei metatag dell'intera applicazione.
 * Utile per facilitarne la modifica
 * e l'implementazione.
 *
 * @author     Gianluca Bonifazi
 * @copyright  STI Uniurb (c) 2017
 */

class Metadata {

	// Attributi pubblici inizializzati
	// con i valori passati al costruttore
	public $title;
	public $share_title;
	public $description;
	public $share_desc;
	public $share_img;
	public $share_url;

    // Costruttore della classe
    public function __construct($title, $share_title, $description, $share_desc, $share_img, $share_url) {
		$this->title = $title;
		$this->share_title = $share_title;
		$this->description = $description;
		$this->share_desc = $share_desc;
		$this->share_img = $share_img;
		$this->share_url = $share_url;
    }

    // Metodo che gestisce l'inizializzazione
    // dell'oggetto in base ai controller e 
    // alle action
    public static function getMetadata($controller,$action) {

    	// Ricevo dal metodo listMetadata() l'oggetto
    	// contenente tutti i metadata
		$meta_list = Metadata::listMetadata();

		// Se il controller
		// e l'action hanno un corrispondente
		// metatag nell'array continuo altrimenti
		// setto i valori della pagina d'errore
		if (array_key_exists($controller, $meta_list)) {
    		if (!array_key_exists($action, $meta_list[$controller])) {
      			$controller = 'pages'; $action = 'error';
      		}
  		} else {
      		$controller = 'pages'; $action = 'error';
  		}

  		// Inizializzo un nuovo oggetto 
  		// con i valori estratti dall'oggetto
  		// corrispondenti a controller e action
		$meta = new Metadata(
			$meta_list[$controller][$action]['title'],
			$meta_list[$controller][$action]['share_title'],
			$meta_list[$controller][$action]['description'],
			$meta_list[$controller][$action]['share_desc'],
			$meta_list[$controller][$action]['share_img'],
			$meta_list[$controller][$action]['share_url']
		);

		// Ritorno l'oggetto
    	return $meta;
    }

    // Metodo che ritorna l'oggetto contente 
    // tutti i metadata
    private static function listMetadata(){

    	return array(

    		// Pagine principali
			'pages' => [
				'home' => [
					'title' 		=> 'Database Laureati - Informatica Urbino',
					'share_title' 	=> 'Database Laureati - Informatica Urbino',
					'description'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_desc'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_img'		=> 'assets/img/urbino.jpg',
					'share_url'		=> 'http://laureati.sti.uniurb.it'
				],
				'error' => [
					'title' 		=> '404 Not Found - Informatica Urbino',
					'share_title' 	=> 'Database Laureati - Informatica Urbino',
					'description'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_desc'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_img'		=> 'assets/img/urbino.jpg',
					'share_url'		=> 'http://laureati.sti.uniurb.it'
				]
			],

			// Pagine di Login
			'login' => [
				'studenti' => [
					'title' 		=> 'Login Studenti - Database Laureati Informatica Urbino',
					'share_title' 	=> 'Database Laureati - Informatica Urbino',
					'description'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_desc'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_img'		=> 'assets/img/urbino.jpg',
					'share_url'		=> 'http://laureati.sti.uniurb.it'
				],
				'aziende' => [
					'title' 		=> 'Login Aziende - Database Laureati Informatica Urbino',
					'share_title' 	=> 'Database Laureati - Informatica Urbino',
					'description'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_desc'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_img'		=> 'assets/img/urbino.jpg',
					'share_url'		=> 'http://laureati.sti.uniurb.it'
				],
				'riservata' => [
					'title' 		=> 'Area Riservata - Database Laureati Informatica Urbino',
					'share_title' 	=> 'Database Laureati - Informatica Urbino',
					'description'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_desc'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_img'		=> 'assets/img/urbino.jpg',
					'share_url'		=> 'http://laureati.sti.uniurb.it'
				]
			],

			// Pagina di registrazione
			'registrazione' => [
				'index' => [
					'title' 		=> 'Registrazione Aziende - Database Laureati Informatica Urbino',
					'share_title' 	=> 'Database Laureati - Informatica Urbino',
					'description'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_desc'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_img'		=> 'assets/img/urbino.jpg',
					'share_url'		=> 'http://laureati.sti.uniurb.it'
				],
				'privacy' => [
					'title' 		=> 'Informativa sulla Privacy - Informatica Applicata Urbino',
					'share_title' 	=> 'Database Laureati - Informatica Urbino',
					'description'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_desc'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_img'		=> 'assets/img/urbino.jpg',
					'share_url'		=> 'http://laureati.sti.uniurb.it'
				]
			],

			// Aree riservate Aziende
			'aziende' => [
				'index' => [
					'title' 		=> 'Ricerca Laureati - Database Laureati Informatica Urbino',
					'share_title' 	=> 'Database Laureati - Informatica Urbino',
					'description'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_desc'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_img'		=> 'assets/img/urbino.jpg',
					'share_url'		=> 'http://laureati.sti.uniurb.it'
				],
				'impostazioni' => [
					'title' 		=> 'Impostazioni Azienda - Database Laureati Informatica Urbino',
					'share_title' 	=> 'Database Laureati - Informatica Urbino',
					'description'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_desc'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_img'		=> 'assets/img/urbino.jpg',
					'share_url'		=> 'http://laureati.sti.uniurb.it'
				],
				'dettaglio' => [
					'title' 		=> 'Dettaglio Studente - Database Laureati Informatica Urbino',
					'share_title' 	=> 'Database Laureati - Informatica Urbino',
					'description'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_desc'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_img'		=> 'assets/img/urbino.jpg',
					'share_url'		=> 'http://laureati.sti.uniurb.it'
				]
			],

			// Aree riservate Studenti
			'studenti' => [
				'index' => [
					'title' 		=> 'Area Studenti - Database Laureati Informatica Urbino',
					'share_title' 	=> 'Database Laureati - Informatica Urbino',
					'description'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_desc'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_img'		=> 'assets/img/urbino.jpg',
					'share_url'		=> 'http://laureati.sti.uniurb.it'
				],
				'impostazioni' => [
					'title' 		=> 'Modifica Dati Studente - Database Laureati Informatica Urbino',
					'share_title' 	=> 'Database Laureati - Informatica Urbino',
					'description'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_desc'	=> 'Database consultabile dei laureati in informatica applicata dell\'universit&agrave; di Urbino.',
					'share_img'		=> 'assets/img/urbino.jpg',
					'share_url'		=> 'http://laureati.sti.uniurb.it'
				]
			]
			
		);
    }

}
?>