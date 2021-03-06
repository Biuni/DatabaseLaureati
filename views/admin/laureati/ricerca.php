<!-- Corpo centrale del sito -->
	<main id="areariservata">

		<div class="logged-menu">
			<div class="container">
				<div class="float-right">
					<i class="fa fa-user-circle" aria-hidden="true"></i> <a href="<?php echo APP_URL; ?>/admin/"><strong><?php echo $username; ?></strong></a> | <a href="<?php echo APP_URL; ?>/admin/impostazioni">Impostazioni</a> | <a href="<?php echo APP_URL; ?>/admin/logout">Logout</a>
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<div class="container">

			<div class="text-center mt-4 mb-4">
				<a class="btn btn-outline-warning m-1" href="<?php echo APP_URL; ?>/admin/"><i class="fa fa-bar-chart" aria-hidden="true"></i> Statistiche</a>
				<a class="btn btn-outline-warning m-1" href="<?php echo APP_URL; ?>/admin/laureati"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Laureati</a>
				<a class="btn btn-outline-warning m-1" href="<?php echo APP_URL; ?>/admin/laureati/ricerca/"><i class="fa fa-search" aria-hidden="true"></i> Cerca Laureati</a>
				<a class="btn btn-outline-warning m-1" href="<?php echo APP_URL; ?>/admin/laureati/inserimento/"><i class="fa fa-user-plus" aria-hidden="true"></i> Nuovo Laureato</a>
				<a class="btn btn-outline-warning m-1" href="<?php echo APP_URL; ?>/admin/aziende"><i class="fa fa-building-o" aria-hidden="true"></i> Aziende</a>
				<a class="btn btn-outline-warning m-1" href="<?php echo APP_URL; ?>/admin/newsletter"><i class="fa fa-envelope-o" aria-hidden="true"></i> Newsletter</a>
				<a class="btn btn-outline-warning m-1" href="<?php echo APP_URL; ?>/admin/curriculum"><i class="fa fa-file-text" aria-hidden="true"></i> Curriculum</a>
			</div>

			<h3>Ricerca Laureato</h3>
			<p class="lead">Ricerca avanzata di tutti i studenti laureati, anche quelli non visibili alle aziende.</p><br>

			<div class="criteri-ricerca">

				<form action="<?php echo APP_URL; ?>/admin/laureati/ricerca/" method="post" id="ricerca-aziende">
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
							  <label class="form-control-label" for="voto_laurea">Per voto di laurea</label>
							  <div class="row">
								<div class="col-sm-6">
									<select class="form-control" id="voto_laurea1" name="voto_laurea1">
										<option value="">Da...</option>
										  <?php
											  foreach ( range( 110, 66 ) as $i ) {
											    echo '<option value="'.$i.'">'.$i.'</option>';
											  }
										   ?>
									</select>
								</div>
								<div class="col-sm-6">
									<select class="form-control" id="voto_laurea2" name="voto_laurea2">
										<option value="">A...</option>
										  <?php
											  foreach ( range( 110, 66 ) as $i ) {
											    echo '<option value="'.$i.'">'.$i.'</option>';
											  }
										   ?>
									</select>
								</div>
							  </div>
							  <small class="form-text text-muted">Votazione finale della laurea.</small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label class="form-control-label" for="anno_laurea">Anno di laurea</label>
							  <div class="row">
								<div class="col-sm-6">
								  <select class="form-control" id="anno_laurea1" name="anno_laurea1">
								    <option value="">Da...</option>
									  <?php
										  foreach ( range( date('Y'), 2005 ) as $i ) {
										    echo '<option value="'.$i.'-01-01">'.$i.'</option>';
										  }
									   ?>
								  </select>
								</div>
								<div class="col-sm-6">
								  <select class="form-control" id="anno_laurea2" name="anno_laurea2">
								    <option value="">A...</option>
									  <?php
										  foreach ( range( date('Y'), 2005 ) as $i ) {
										    echo '<option value="'.$i.'-12-31">'.$i.'</option>';
										  }
									   ?>
								  </select>
								</div>
							  </div>
							  <small class="form-text text-muted">Anno d'inizio del corso di laurea 2005.</small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label class="form-control-label" for="anno_nascita">A partire dall'anno di nascita</label>
							  <select class="form-control" id="anno_nascita" name="anno_nascita">
							    <option value="">Scegli...</option>
								  <?php
									  foreach ( range( date('Y')-17, 1940 ) as $i ) {
									    echo '<option value="'.$i.'-01-01">'.$i.'</option>';
									  }
								   ?>
							  </select>
							  <small class="form-text text-muted">Anno di nascita minima del laureato.</small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label class="form-control-label" for="provincia">Per provincia di residenza</label>
							  <select class="form-control" id="provincia" name="provincia">
							    <option value="">Scegli...</option>
								<option value="ag">Agrigento</option>
								<option value="al">Alessandria</option>
								<option value="an">Ancona</option>
								<option value="ao">Aosta</option>
								<option value="ar">Arezzo</option>
								<option value="ap">Ascoli Piceno</option>
								<option value="at">Asti</option>
								<option value="av">Avellino</option>
								<option value="ba">Bari</option>
								<option value="bt">Barletta-Andria-Trani</option>
								<option value="bl">Belluno</option>
								<option value="bn">Benevento</option>
								<option value="bg">Bergamo</option>
								<option value="bi">Biella</option>
								<option value="bo">Bologna</option>
								<option value="bz">Bolzano</option>
								<option value="bs">Brescia</option>
								<option value="br">Brindisi</option>
								<option value="ca">Cagliari</option>
								<option value="cl">Caltanissetta</option>
								<option value="cb">Campobasso</option>
								<option value="ci">Carbonia-iglesias</option>
								<option value="ce">Caserta</option>
								<option value="ct">Catania</option>
								<option value="cz">Catanzaro</option>
								<option value="ch">Chieti</option>
								<option value="co">Como</option>
								<option value="cs">Cosenza</option>
								<option value="cr">Cremona</option>
								<option value="kr">Crotone</option>
								<option value="cn">Cuneo</option>
								<option value="en">Enna</option>
								<option value="fm">Fermo</option>
								<option value="fe">Ferrara</option>
								<option value="fi">Firenze</option>
								<option value="fg">Foggia</option>
								<option value="fc">Forl&igrave;-Cesena</option>
								<option value="fr">Frosinone</option>
								<option value="ge">Genova</option>
								<option value="go">Gorizia</option>
								<option value="gr">Grosseto</option>
								<option value="im">Imperia</option>
								<option value="is">Isernia</option>
								<option value="sp">La spezia</option>
								<option value="aq">L'aquila</option>
								<option value="lt">Latina</option>
								<option value="le">Lecce</option>
								<option value="lc">Lecco</option>
								<option value="li">Livorno</option>
								<option value="lo">Lodi</option>
								<option value="lu">Lucca</option>
								<option value="mc">Macerata</option>
								<option value="mn">Mantova</option>
								<option value="ms">Massa-Carrara</option>
								<option value="mt">Matera</option>
								<option value="vs">Medio Campidano</option>
								<option value="me">Messina</option>
								<option value="mi">Milano</option>
								<option value="mo">Modena</option>
								<option value="mb">Monza e della Brianza</option>
								<option value="na">Napoli</option>
								<option value="no">Novara</option>
								<option value="nu">Nuoro</option>
								<option value="og">Ogliastra</option>
								<option value="ot">Olbia-Tempio</option>
								<option value="or">Oristano</option>
								<option value="pd">Padova</option>
								<option value="pa">Palermo</option>
								<option value="pr">Parma</option>
								<option value="pv">Pavia</option>
								<option value="pg">Perugia</option>
								<option value="pu">Pesaro e Urbino</option>
								<option value="pe">Pescara</option>
								<option value="pc">Piacenza</option>
								<option value="pi">Pisa</option>
								<option value="pt">Pistoia</option>
								<option value="pn">Pordenone</option>
								<option value="pz">Potenza</option>
								<option value="po">Prato</option>
								<option value="rg">Ragusa</option>
								<option value="ra">Ravenna</option>
								<option value="rc">Reggio di Calabria</option>
								<option value="re">Reggio nell'Emilia</option>
								<option value="ri">Rieti</option>
								<option value="rn">Rimini</option>
								<option value="rm">Roma</option>
								<option value="ro">Rovigo</option>
								<option value="sa">Salerno</option>
								<option value="ss">Sassari</option>
								<option value="sv">Savona</option>
								<option value="si">Siena</option>
								<option value="sr">Siracusa</option>
								<option value="so">Sondrio</option>
								<option value="ta">Taranto</option>
								<option value="te">Teramo</option>
								<option value="tr">Terni</option>
								<option value="to">Torino</option>
								<option value="tp">Trapani</option>
								<option value="tn">Trento</option>
								<option value="tv">Treviso</option>
								<option value="ts">Trieste</option>
								<option value="ud">Udine</option>
								<option value="va">Varese</option>
								<option value="ve">Venezia</option>
								<option value="vb">Verbano-Cusio-Ossola</option>
								<option value="vc">Vercelli</option>
								<option value="vr">Verona</option>
								<option value="vv">Vibo valentia</option>
								<option value="vi">Vicenza</option>
								<option value="vt">Viterbo</option>
							</select>
							  <small class="form-text text-muted">Provincia dove risiede il laureato.</small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label class="form-control-label" for="curriculum">Per curriculum</label>
							  <select class="form-control" id="curriculum" name="curriculum">
								<option value="">Scegli...</option>
								<?php 
									foreach($curriculum as $cv) {
										echo '<option value="'.$cv['nome'].'">'.$cv['nome'].'</option>';
									}
								?>
							  </select>
							  <small class="form-text text-muted">Indirizzo di studio.</small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label class="form-control-label" for="cognome">Per cognome</label>
							  <input type="text" class="form-control" id="cognome" name="cognome">
							  <small class="form-text text-muted">Basata sul cognome del candidato.</small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label class="form-control-label" for="relatore">Per relatore</label>
							  <input type="text" class="form-control" id="relatore" name="relatore">
							  <small class="form-text text-muted">Basata sul cognome del relatore.</small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label class="form-control-label" for="tipologia">Per tipologia di tesi</label>
							  <select class="form-control" id="tipologia" name="tipologia">
								<option value="">Scegli...</option>
								<option value="compilativa/descrittiva">Compilativa - Descrittiva</option>
								<option value="di ricerca/sperimentale">Ricerca - Sperimentale</option>
							  </select>
							  <small class="form-text text-muted">Basata sulla tipologia della tesi.</small>
							</div>
						</div>

						<div class="col-md-12 text-center">
							<button type="submit" class="btn btn-warning">Cerca</button>
						</div>

					</div>
				</form>

			</div><br>

					<?php
						$first = 0;$second = 0;$third = 0;$fourth = 0;$fifth = 0;

						if(isset($students)){

							echo '<p class="text-warning">'.count($students).' laureati trovati</p>';

							echo '<ul class="list-group">';
							foreach($students as $student) { 

			            		echo '<li class="list-group-item justify-content-between">'.$student['Nome'].' '.$student['Cognome'].'<a href="'.APP_URL.'/admin/laureati/dettaglio/'.$student['ID'].'/" target="blank" class="badge badge-warning badge-pill view-more-student">Visualizza Dati</a></li>';

			            		$voto = $student['Voto_laurea'];
			            		$laude = strtolower($student['cum_laude']);
			            		($voto >= 66 && $voto <= 80) ? $first++ : $first;
			            		($voto >= 81 && $voto <= 90) ? $second++ : $second;
			            		($voto >= 91 && $voto <= 100) ? $third++ : $third;
			            		(($voto >= 101 && $voto <= 110) && $laude == 'no') ? $fourth++ : $fourth;
			            		($voto == 110 && $laude == 'si') ? $fifth++ : $fifth;

					 		}
					 		echo "</ul>";
					 		
					 		if (count($students) > 0) {
								echo "<h3>Media voto di laurea</h3>";
								echo'<p class="lead">Nel grafico sottostante è possibile visualizzare l\'andamento dei voti di laurea basati sulla ricerca.</p>';
						 		echo '<canvas id="vote-chart" class="mt-5 mb-5"></canvas>';
					 		}

					 		$votoLaurea[] = $first;
					 		$votoLaurea[] = $second;
					 		$votoLaurea[] = $third;
					 		$votoLaurea[] = $fourth;
					 		$votoLaurea[] = $fifth;
					 	}
					?>


		</div><br>

	</main>

	<script>
		var data2 = {
	      labels: ["66-80","81-90","91-100","100-110","110 e lode"],
	      datasets: [
		    {
		        backgroundColor: "rgba(73, 105, 124,0.5)",
		        borderColor: "rgba(73, 105, 124,1)",
		        data: <?php echo json_encode($votoLaurea); ?>,
		        label: "Numero di studenti"
		    }
	      ]
		};
	</script>