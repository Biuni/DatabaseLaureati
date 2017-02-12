<?php

// Classe per la connessione al database
// di tipo Singleton. Essendo privati
// sia il __construct() che il __clone()
// l'unico modo per instanziare l'oggetto Db 
// sarà passando per il metodo getInstance()
// il quale controlla se l'attributo $instance
// è già stato settato una prima volta.

class Db {

  // Attributo statico e privato.
  private static $instance = NULL;

  // Costruttore della classe
  private function __construct() {}

  // Clone della classe
  private function __clone() {}

  // Metodo per l'instanza dell'oggetto Db 
  // con controllo per il pattern Singleton
  public static function getInstance() {

    if (!isset(self::$instance)) {
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      self::$instance = new PDO('mysql:host=localhost;dbname=db_laureati', 'root', '', $pdo_options);
    }
    return self::$instance;

  }

}

?>