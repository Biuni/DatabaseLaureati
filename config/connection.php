<?php

/**
 * Db
 * Connessione al Database
 *
 * Classe per la connessione al database
 * di tipo Singleton. Essendo privati
 * sia il __construct() che il __clone()
 * l'unico modo per instanziare l'oggetto Db 
 * sarà passando per il metodo getInstance()
 * il quale controlla se l'attributo $instance
 * è già stato settato una prima volta.
 *
 * @author     Gianluca Bonifazi
 * @category   config 
 * @copyright  STI Uniurb (c) 2017
 */

class Db {

  // Attributo statico e privato che gestisce
  // il design pattern Singleton
  private static $instance  = NULL;
  // Attributi per la connessione al DB
  private static $host      = DB_HOST;
  private static $db_name   = DB_NAME;
  private static $user      = DB_USER;
  private static $password  = DB_PWD;
  
  // Costruttore della classe
  private function __construct() {}

  // Clone della classe
  private function __clone() {}

  // Metodo per l'instanza dell'oggetto Db 
  // con controllo per il pattern Singleton
  public static function getInstance() {

    // Controllo sell'istanza è già
    // stata inizializzata una volta
    if (!isset(self::$instance)) {
      // Opzioni per la connessione
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      // Inizializzo la variabile $instance
      // con un oggetto di tipo PDO per la 
      // connessione al database
      self::$instance = new PDO('mysql:host='.self::$host.';dbname='.self::$db_name, self::$user, self::$password, $pdo_options);
    }
    // Ritorno l'oggetto al quale
    // fare interrogazioni
    return self::$instance;

  }

}

?>