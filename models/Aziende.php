<?php
class Aziende {

    // Metodo che restiuisce l'intera
    // lista di studenti
    public static function getList() {
      // Inizializzo un array vuoto
      $list = [];
      // Mi collego al Database
      $db = Db::getInstance();
      // Eseguo la query
      $sql = $db->query('SELECT ID, Nome, Cognome, Titolo_tesi, Voto_laurea, Data_Laurea, cum_laude FROM laureati_tb WHERE Visibility = 1');
      // Per ogni risultato della query
      // vado ad inserire nell'array
      // $list i suoi dati
      foreach($sql->fetchAll() as $student) {
        $list[] = $student;
      }
      // Ritorno l'array con tutti
      // i dati degli studenti
      return $list;
    }

    // Metodo che restiuisce la lista dei laureati
    // basata sulla ricerca
    public static function advancedSearch($clean_value) {

      $voto_laurea = $clean_value['voto_laurea'];
      $anno_laurea = $clean_value['anno_laurea'];
      $anno_nascita = $clean_value['anno_nascita'];
      $provincia = strtoupper($clean_value['provincia']);
      $curriculum = $clean_value['curriculum'];
      $cognome = $clean_value['cognome'];

      $query = "SELECT ID, Nome, Cognome, Titolo_tesi, Voto_laurea, Data_Laurea, cum_laude FROM laureati_tb WHERE Visibility = 1";

      if ($voto_laurea != '') {
        $query .= " AND Voto_laurea >= $voto_laurea";
      }
      if ($anno_laurea != '') {
        $query .= " AND Data_laurea >= '$anno_laurea'";
      }
      if ($anno_nascita != '') {
        $query .= " AND Data_n >= '$anno_nascita'";
      }
      if ($provincia != '') {
        $query .= " AND Prov_r = '$provincia'";
      }
      if ($curriculum != '') {
        $query .= " AND curriculum = '$curriculum'";
      }
      if ($cognome != '') {
        $query .= " AND cognome LIKE '%$cognome%'";
      }

      // Inizializzo un array vuoto
      $list = [];
      // Mi collego al Database
      $db = Db::getInstance();
      // Eseguo la query
      $sql = $db->query($query);
      // Per ogni risultato della query
      // vado ad inserire nell'array
      // $list i suoi dati
      foreach($sql->fetchAll() as $student) {
        $list[] = $student;
      }
      // Ritorno l'array con tutti
      // i dati degli studenti
      return $list;
    }

    // Funzione che restituisce i dettagli di uno studente
    public static function showDetails($id) {
      // Mi collego al Database
      $db = Db::getInstance();
      // Preparo al query
      $sql = $db->prepare('SELECT ID, Nome, Cognome, Matricola, CF, Sesso, Data_n, Luogo_n, Prov_n, Luogo_r, Prov_r, Telefono, e_mail, Titolo_tesi, tipologia, Voto_laurea, cum_laude, Data_Laurea, Note, relatore, curriculum, CV_download FROM laureati_tb WHERE id = :id');
      // Una volta preparata la query sostituisco
      // :id con il valore dell'id ricevuto come parametro
      // e la eseguo
      $sql->execute(array('id' => $id));
      // Ritorno il risultato della query come oggetto
      return $sql->fetchObject();
    }

}
?>