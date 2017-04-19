<?php

/**
 * Pages
 * Model delle pagine principali
 *
 * Classe per effettuare richieste al database
 * da parte del controller che gestisce
 * le pagine di homepage e di errore 404
 *
 * @author     Gianluca Bonifazi
 * @category   models 
 * @copyright  STI Uniurb (c) 2017
 */

class Pages {
    
    // Definisco 2 attributi di tipo pubblico
    // per renderli accessibili direttamente
    // dall'esterno senza passare per metodi
    public $num_laureati;
    public $media_laurea;
    
    // Costruttore della classe
    public function __construct($num_laureati, $media_laurea) {
        $this->num_laureati = $num_laureati;
        $this->media_laurea = $media_laurea;
    }
    
    // Metodo utilizzato per fare le query di 
    // conteggio dei laureati e della media 
    // arimetica del voto di laurea da stampare
    // in homepage
    public static function getInfoLaurea() {
        // Mi collego al database
        $db = Db::getInstance();
        // Faccio la query per contare i laureati
        $sql = $db->query('SELECT count(*) AS counter FROM laureati_tb');
        $count = $sql->fetchObject();
        // Faccio la query per calcolare la media voto
        $sql2 = $db->query('SELECT AVG(Voto_laurea) AS voto FROM laureati_tb WHERE Voto_laurea <> 0');
        $media = $sql2->fetchObject();
        // Ritorno un ogetti di tipo Pages
        // con i valori delle query
        return new Pages($count->counter, round($media->voto, 2));
    }
    
}
?>