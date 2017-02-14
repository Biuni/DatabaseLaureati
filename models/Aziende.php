<?php
class Aziende {

    // Metodo che restiuisce l'intera
    // lista di studenti
    public static function getList() {

      // Inizializzo un array vuoto
      $list = [];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo i campi
        // non visualizzati sulla tabella
        $sql = "SELECT ID, Nome, Cognome, Titolo_tesi, Voto_laurea, Data_Laurea, cum_laude FROM laureati_tb WHERE Visibility = 1";
        // Eseguo la query
        $stmt = $db->query($sql);
        // Per ogni risultato della query
        // vado ad inserire nell'array
        // $list i dati di ogni studente
        foreach($stmt->fetchAll() as $student) {
          $list[] = $student;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Ritorno l'array con tutti
      // i dati degli studenti
      return $list;
    }

    // Metodo che restiuisce la lista dei laureati
    // basata sulla ricerca
    public static function advancedSearch($clean_value) {

      // Inizializzo un array vuoto
      $list = [];
      $params = [];

      $voto_laurea = $clean_value['voto_laurea'];
      $anno_laurea = $clean_value['anno_laurea'];
      $anno_nascita = $clean_value['anno_nascita'];
      $provincia = strtoupper($clean_value['provincia']);
      $curriculum = $clean_value['curriculum'];
      $cognome = $clean_value['cognome'];

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo i campi
        // a seconda dei valori ricevuti in $_POST
        $sql = "SELECT ID, Nome, Cognome, Titolo_tesi, Voto_laurea, Data_Laurea, cum_laude FROM laureati_tb WHERE Visibility = 1";

        if ($voto_laurea != '') {
          $sql .= " AND Voto_laurea >= :voto_laurea";
          $params[':voto_laurea'] = $voto_laurea;
        }
        if ($anno_laurea != '') {
          $sql .= " AND Data_laurea >= :anno_laurea";
          $params[':anno_laurea'] = $anno_laurea;
        }
        if ($anno_nascita != '') {
          $sql .= " AND Data_n >= :anno_nascita";
          $params[':anno_nascita'] = $anno_nascita;
        }
        if ($provincia != '') {
          $sql .= " AND Prov_r = :provincia";
          $params[':provincia'] = $provincia;
        }
        if ($curriculum != '') {
          $sql .= " AND curriculum = :curriculum";
          $params[':curriculum'] = $curriculum;
        }
        if ($cognome != '') {
          $sql .= " AND cognome LIKE :cognome";
          $params[':cognome'] = '%'.$cognome.'%';
        }

        // Preparo la query
        $stmt = $db->prepare($sql);
        // Una volta preparata la query sostituisco
        // :value con il valore corrispondete
        // ricevuto come parametro e la eseguo
        $rows = $stmt->execute($params);
        // Per ogni risultato della query
        // vado ad inserire nell'array
        // $list i suoi dati
        foreach($stmt->fetchAll() as $student) {
          $list[] = $student;
        }

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Ritorno l'array con tutti
      // i dati degli studenti
      return $list;
    }

    // Funzione che restituisce i dettagli di uno studente
    public static function showDetails($id) {

      // Entro nella sezione critica dove 
      // effetuerò la query di selezione
      try {

        // Mi collego al Database
        $db = Db::getInstance();
        // Compongo la query esludendo la password
        // e il campo visibility in quanto non utile
        $sql = "SELECT ID, Nome, Cognome, Matricola, CF, Sesso, Data_n, Luogo_n, Prov_n, Luogo_r, Prov_r, Telefono, e_mail, Titolo_tesi, tipologia, Voto_laurea, cum_laude, Data_Laurea, Note, relatore, curriculum, CV_download, Tesi_download FROM laureati_tb WHERE id = :id";
        // Preparo la query
        $stmt = $db->prepare($sql);
        // Una volta preparata la query sostituisco
        // :id con il valore dell'id
        // ricevuto come parametro e la eseguo
        $rows = $stmt->execute(array(':id' => $id));

      } catch(PDOException $ex) {

        // Errore. Stampo l'eccezzione
        die('Errore: '.$sql.' - '.$ex->getMessage());

      }

      // Prendo il risultato della query
      // e lo ritorno come oggetto
      return $stmt->fetchObject();
    }

}
?>