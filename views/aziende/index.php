<!-- Corpo centrale del sito -->
	<main id="areaaziende">

		<div class="logged-menu">
			<div class="container">
				<div class=" float-right">
					<i class="fa fa-building-o" aria-hidden="true"></i> <a href="<?php echo APP_URL; ?>/aziende/"><strong><?php echo $username; ?></strong></a> | <a href="<?php echo APP_URL; ?>/aziende/impostazioni">Impostazioni</a> | <a href="<?php echo APP_URL; ?>/aziende/logout">Logout</a>
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<div class="container">

			<h3>Ricerca laureati</h3>
			<p class="lead">In questa pagina potrai consultare il database dei laureati del corso di laurea in Informatica Applicata. Per effettuare la ricerca ti basterà completare almeno uno dei campi messi a disposizione oppure consultare direttamente la tabella sottostante.</p>

			<div class="row criteri-ricerca">

				<form action="<?php echo APP_URL; ?>/aziende/index#ricerca" method="post" id="ricerca-aziende">
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
							  <label class="form-control-label" for="voto_laurea">Per voto di laurea</label>
							  <select class="form-control" id="voto_laurea" name="voto_laurea">
							    <option value="">Scegli...</option>
								  <?php
									  foreach ( range( 110, 66 ) as $i ) {
									    echo '<option value="'.$i.'">'.$i.'</option>';
									  }
								   ?>
							  </select>
							  <small class="form-text text-muted">Su 110.</small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label class="form-control-label" for="anno_laurea">A partire dall'anno di laurea</label>
							  <select class="form-control" id="anno_laurea" name="anno_laurea">
							    <option value="">Scegli...</option>
								  <?php
									  foreach ( range( date('Y'), 2005 ) as $i ) {
									    echo '<option value="'.$i.'-01-01">'.$i.'</option>';
									  }
								   ?>
							  </select>
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
								<option value="indefinito">Indefinito</option>
								<option value="Sistemi integrati hardware/software">Sistemi integrati hardware/software</option>
								<option value="Sistemi multimediali integrati">Sistemi multimediali integrati</option>
								<option value="Domotica e informatica aziendale">Domotica e informatica aziendale</option>
								<option value="Indirizzo comune">Indirizzo comune</option>
								<option value="Elaborazione delle informazioni">Elaborazione delle informazioni</option>
								<option value="Gestione digitale del territorio">Gestione digitale del territorio</option>
								<option value="Logico-cognitivo">Logico-cognitivo</option>
								<option value="Impresa">Impresa</option>
								<option value="Nuovi media">Nuovi media</option>
								<option value="Politiche sociali">Politiche sociali</option>
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

						<div class="col-md-12 text-center">
							<button type="submit" class="btn btn-warning">Cerca</button>
							<button type="submit" class="btn btn-warning">Azzera Ricerca</button>
						</div>

					</div>
				</form>

			</div>


			<div class="table-lauerati table-responsive">

				<a name="ricerca"></a>
				<table id="student-list" class="table table-striped table-bordered responsive wrap" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th>Nome</th>
			                <th>Cognome</th>
			                <th>Titolo tesi</th>
			                <th>Voto di Laurea</th>
			                <th>Data di Laurea</th>
			                <th>Dati Completi</th>
			            </tr>
			        </thead>
			        <tbody>

					<?php foreach($students as $student) { ?>

			            <tr>
			            <td><?php echo $student['Nome']; ?></td>
			            <td><?php echo $student['Cognome']; ?></td>
			            <td><?php echo $student['Titolo_tesi']; ?></td>
			            <td><?php echo $student['Voto_laurea'];  echo ($student['cum_laude'] == 'si')? " e lode" : ""; ?></td>
			            <td><?php echo $student['Data_Laurea']; ?></td>
			            <td><a href="<?php echo APP_URL; ?>/aziende/dettaglio/<?php echo $student['ID'] ?>" class="btn btn-warning view-more-student">Visualizza</a></td>
			            </tr>

					<?php } ?>

			        </tbody>
			    </table>
			</div>
		</div><br>
	</main>