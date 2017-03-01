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

			<h3>Modifica Laureato</h3>
			<p class="lead">Modifica dei dati dello studente laureato.</p>

		<form action="<?php echo APP_URL; ?>/admin/laureati/modifica/<?php echo $query; ?>/" method="post" id="mod-dati-studente">

			<div class="alert alert-success <?php echo $hide_ok_user; ?>" role="alert">
			  <strong>Dati modificati!</strong> I dati del laureato sono stati correttamente modificati.
			</div>
			<div class="alert alert-danger <?php echo $hide_err_user; ?>" role="alert">
			  <strong>Attenzione!</strong> La modifica dei dati non è andata a buon fine. Riprova.
			</div>

			<div class="alert alert-success <?php echo $hide_ok_tesi; ?>" role="alert">
			  <strong>Tesi caricata!</strong> La tesi è stata modificata correttamente.
			</div>
			<div class="alert alert-danger <?php echo $hide_err_tesi; ?>" role="alert">
			  <strong>Errore!</strong> Tesi non caricata. Assicurati che il file rispetti i requisiti.
			</div>


		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Nome</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-danger" id="Nome" name="Nome" value="<?php echo $students->Nome; ?>">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Cognome</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-danger" id="Cognome" name="Cognome" value="<?php echo $students->Cognome; ?>">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Matricola</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-danger" id="Matricola" name="Matricola" value="<?php echo $students->Matricola; ?>">
		    </div>
		  </div>
		  <div class="form-group row input_data-n">
		    <label for="Data_n" class="col-sm-2 col-form-label">Data di Nascita</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-danger" id="Data_n" name="Data_n" <?php echo ($students->Data_n == '0000-00-00')? 'placeholder="YYYY-MM-DD"' : 'value="'.$students->Data_n.'"';?> >
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="Sesso" class="col-sm-2 col-form-label">Sesso</label>
		    <div class="col-sm-10">
				<label class="custom-control custom-radio">
				  <input id="Sesso_M" name="Sesso" type="radio" class="custom-control-input" value="M" <?php echo ($students->Sesso == 'M')? 'checked="true"':''; ?>>
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">M</span>
				</label>
				<label class="custom-control custom-radio">
				  <input id="Sesso_F" name="Sesso" type="radio" class="custom-control-input" value="F" <?php echo ($students->Sesso == 'F')? 'checked="true"':''; ?>>
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">F</span>
				</label>
		    </div>
		  </div>
		  <div class="form-group row input_CF">
		    <label for="CF" class="col-sm-2 col-form-label">Codice Fiscale</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-danger" id="CF" name="CF" value="<?php echo $students->CF; ?>">
		    </div>
		  </div>
		  <div class="form-group row input_Luogo-n">
		    <label for="Luogo_n" class="col-sm-2 col-form-label">Luogo di Nascita</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-danger" id="Luogo_n" name="Luogo_n" value="<?php echo $students->Luogo_n; ?>">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="Prov_n" class="col-sm-2 col-form-label">Provincia di Nascita</label>
		    <div class="col-sm-10">
				<select class="form-control" id="Prov_n" name="Prov_n">
					<option <?php echo (strtolower($students->Prov_n) == '')  ?	'selected' : '' ; ?> value="">Scegli...</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ag')? 'selected' : '' ; ?> value="ag">Agrigento</option>
					<option <?php echo (strtolower($students->Prov_n) == 'al')? 'selected' : '' ; ?> value="al">Alessandria</option>
					<option <?php echo (strtolower($students->Prov_n) == 'an')? 'selected' : '' ; ?> value="an">Ancona</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ao')? 'selected' : '' ; ?> value="ao">Aosta</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ar')? 'selected' : '' ; ?> value="ar">Arezzo</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ap')? 'selected' : '' ; ?> value="ap">Ascoli Piceno</option>
					<option <?php echo (strtolower($students->Prov_n) == 'at')? 'selected' : '' ; ?> value="at">Asti</option>
					<option <?php echo (strtolower($students->Prov_n) == 'av')? 'selected' : '' ; ?> value="av">Avellino</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ba')? 'selected' : '' ; ?> value="ba">Bari</option>
					<option <?php echo (strtolower($students->Prov_n) == 'bt')? 'selected' : '' ; ?> value="bt">Barletta-Andria-Trani</option>
					<option <?php echo (strtolower($students->Prov_n) == 'bl')? 'selected' : '' ; ?> value="bl">Belluno</option>
					<option <?php echo (strtolower($students->Prov_n) == 'bn')? 'selected' : '' ; ?> value="bn">Benevento</option>
					<option <?php echo (strtolower($students->Prov_n) == 'bg')? 'selected' : '' ; ?> value="bg">Bergamo</option>
					<option <?php echo (strtolower($students->Prov_n) == 'bi')? 'selected' : '' ; ?> value="bi">Biella</option>
					<option <?php echo (strtolower($students->Prov_n) == 'bo')? 'selected' : '' ; ?> value="bo">Bologna</option>
					<option <?php echo (strtolower($students->Prov_n) == 'bz')? 'selected' : '' ; ?> value="bz">Bolzano</option>
					<option <?php echo (strtolower($students->Prov_n) == 'bs')? 'selected' : '' ; ?> value="bs">Brescia</option>
					<option <?php echo (strtolower($students->Prov_n) == 'br')? 'selected' : '' ; ?> value="br">Brindisi</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ca')? 'selected' : '' ; ?> value="ca">Cagliari</option>
					<option <?php echo (strtolower($students->Prov_n) == 'cl')? 'selected' : '' ; ?> value="cl">Caltanissetta</option>
					<option <?php echo (strtolower($students->Prov_n) == 'cb')? 'selected' : '' ; ?> value="cb">Campobasso</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ci')? 'selected' : '' ; ?> value="ci">Carbonia-iglesias</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ce')? 'selected' : '' ; ?> value="ce">Caserta</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ct')? 'selected' : '' ; ?> value="ct">Catania</option>
					<option <?php echo (strtolower($students->Prov_n) == 'cz')? 'selected' : '' ; ?> value="cz">Catanzaro</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ch')? 'selected' : '' ; ?> value="ch">Chieti</option>
					<option <?php echo (strtolower($students->Prov_n) == 'co')? 'selected' : '' ; ?> value="co">Como</option>
					<option <?php echo (strtolower($students->Prov_n) == 'cs')? 'selected' : '' ; ?> value="cs">Cosenza</option>
					<option <?php echo (strtolower($students->Prov_n) == 'cr')? 'selected' : '' ; ?> value="cr">Cremona</option>
					<option <?php echo (strtolower($students->Prov_n) == 'kr')? 'selected' : '' ; ?> value="kr">Crotone</option>
					<option <?php echo (strtolower($students->Prov_n) == 'cn')? 'selected' : '' ; ?> value="cn">Cuneo</option>
					<option <?php echo (strtolower($students->Prov_n) == 'en')? 'selected' : '' ; ?> value="en">Enna</option>
					<option <?php echo (strtolower($students->Prov_n) == 'fm')? 'selected' : '' ; ?> value="fm">Fermo</option>
					<option <?php echo (strtolower($students->Prov_n) == 'fe')? 'selected' : '' ; ?> value="fe">Ferrara</option>
					<option <?php echo (strtolower($students->Prov_n) == 'fi')? 'selected' : '' ; ?> value="fi">Firenze</option>
					<option <?php echo (strtolower($students->Prov_n) == 'fg')? 'selected' : '' ; ?> value="fg">Foggia</option>
					<option <?php echo (strtolower($students->Prov_n) == 'fc')? 'selected' : '' ; ?> value="fc">Forl&igrave;-Cesena</option>
					<option <?php echo (strtolower($students->Prov_n) == 'fr')? 'selected' : '' ; ?> value="fr">Frosinone</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ge')? 'selected' : '' ; ?> value="ge">Genova</option>
					<option <?php echo (strtolower($students->Prov_n) == 'go')? 'selected' : '' ; ?> value="go">Gorizia</option>
					<option <?php echo (strtolower($students->Prov_n) == 'gr')? 'selected' : '' ; ?> value="gr">Grosseto</option>
					<option <?php echo (strtolower($students->Prov_n) == 'im')? 'selected' : '' ; ?> value="im">Imperia</option>
					<option <?php echo (strtolower($students->Prov_n) == 'is')? 'selected' : '' ; ?> value="is">Isernia</option>
					<option <?php echo (strtolower($students->Prov_n) == 'sp')? 'selected' : '' ; ?> value="sp">La spezia</option>
					<option <?php echo (strtolower($students->Prov_n) == 'aq')? 'selected' : '' ; ?> value="aq">L'aquila</option>
					<option <?php echo (strtolower($students->Prov_n) == 'lt')? 'selected' : '' ; ?> value="lt">Latina</option>
					<option <?php echo (strtolower($students->Prov_n) == 'le')? 'selected' : '' ; ?> value="le">Lecce</option>
					<option <?php echo (strtolower($students->Prov_n) == 'lc')? 'selected' : '' ; ?> value="lc">Lecco</option>
					<option <?php echo (strtolower($students->Prov_n) == 'li')? 'selected' : '' ; ?> value="li">Livorno</option>
					<option <?php echo (strtolower($students->Prov_n) == 'lo')? 'selected' : '' ; ?> value="lo">Lodi</option>
					<option <?php echo (strtolower($students->Prov_n) == 'lu')? 'selected' : '' ; ?> value="lu">Lucca</option>
					<option <?php echo (strtolower($students->Prov_n) == 'mc')? 'selected' : '' ; ?> value="mc">Macerata</option>
					<option <?php echo (strtolower($students->Prov_n) == 'mn')? 'selected' : '' ; ?> value="mn">Mantova</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ms')? 'selected' : '' ; ?> value="ms">Massa-Carrara</option>
					<option <?php echo (strtolower($students->Prov_n) == 'mt')? 'selected' : '' ; ?> value="mt">Matera</option>
					<option <?php echo (strtolower($students->Prov_n) == 'vs')? 'selected' : '' ; ?> value="vs">Medio Campidano</option>
					<option <?php echo (strtolower($students->Prov_n) == 'me')? 'selected' : '' ; ?> value="me">Messina</option>
					<option <?php echo (strtolower($students->Prov_n) == 'mi')? 'selected' : '' ; ?> value="mi">Milano</option>
					<option <?php echo (strtolower($students->Prov_n) == 'mo')? 'selected' : '' ; ?> value="mo">Modena</option>
					<option <?php echo (strtolower($students->Prov_n) == 'mb')? 'selected' : '' ; ?> value="mb">Monza e della Brianza</option>
					<option <?php echo (strtolower($students->Prov_n) == 'na')? 'selected' : '' ; ?> value="na">Napoli</option>
					<option <?php echo (strtolower($students->Prov_n) == 'no')? 'selected' : '' ; ?> value="no">Novara</option>
					<option <?php echo (strtolower($students->Prov_n) == 'nu')? 'selected' : '' ; ?> value="nu">Nuoro</option>
					<option <?php echo (strtolower($students->Prov_n) == 'og')? 'selected' : '' ; ?> value="og">Ogliastra</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ot')? 'selected' : '' ; ?> value="ot">Olbia-Tempio</option>
					<option <?php echo (strtolower($students->Prov_n) == 'or')? 'selected' : '' ; ?> value="or">Oristano</option>
					<option <?php echo (strtolower($students->Prov_n) == 'pd')? 'selected' : '' ; ?> value="pd">Padova</option>
					<option <?php echo (strtolower($students->Prov_n) == 'pa')? 'selected' : '' ; ?> value="pa">Palermo</option>
					<option <?php echo (strtolower($students->Prov_n) == 'pr')? 'selected' : '' ; ?> value="pr">Parma</option>
					<option <?php echo (strtolower($students->Prov_n) == 'pv')? 'selected' : '' ; ?> value="pv">Pavia</option>
					<option <?php echo (strtolower($students->Prov_n) == 'pg')? 'selected' : '' ; ?> value="pg">Perugia</option>
					<option <?php echo (strtolower($students->Prov_n) == 'pu')? 'selected' : '' ; ?> value="pu">Pesaro e Urbino</option>
					<option <?php echo (strtolower($students->Prov_n) == 'pe')? 'selected' : '' ; ?> value="pe">Pescara</option>
					<option <?php echo (strtolower($students->Prov_n) == 'pc')? 'selected' : '' ; ?> value="pc">Piacenza</option>
					<option <?php echo (strtolower($students->Prov_n) == 'pi')? 'selected' : '' ; ?> value="pi">Pisa</option>
					<option <?php echo (strtolower($students->Prov_n) == 'pt')? 'selected' : '' ; ?> value="pt">Pistoia</option>
					<option <?php echo (strtolower($students->Prov_n) == 'pn')? 'selected' : '' ; ?> value="pn">Pordenone</option>
					<option <?php echo (strtolower($students->Prov_n) == 'pz')? 'selected' : '' ; ?> value="pz">Potenza</option>
					<option <?php echo (strtolower($students->Prov_n) == 'po')? 'selected' : '' ; ?> value="po">Prato</option>
					<option <?php echo (strtolower($students->Prov_n) == 'rg')? 'selected' : '' ; ?> value="rg">Ragusa</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ra')? 'selected' : '' ; ?> value="ra">Ravenna</option>
					<option <?php echo (strtolower($students->Prov_n) == 'rc')? 'selected' : '' ; ?> value="rc">Reggio di Calabria</option>
					<option <?php echo (strtolower($students->Prov_n) == 're')? 'selected' : '' ; ?> value="re">Reggio nell'Emilia</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ri')? 'selected' : '' ; ?> value="ri">Rieti</option>
					<option <?php echo (strtolower($students->Prov_n) == 'rn')? 'selected' : '' ; ?> value="rn">Rimini</option>
					<option <?php echo (strtolower($students->Prov_n) == 'rm')? 'selected' : '' ; ?> value="rm">Roma</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ro')? 'selected' : '' ; ?> value="ro">Rovigo</option>
					<option <?php echo (strtolower($students->Prov_n) == 'sa')? 'selected' : '' ; ?> value="sa">Salerno</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ss')? 'selected' : '' ; ?> value="ss">Sassari</option>
					<option <?php echo (strtolower($students->Prov_n) == 'sv')? 'selected' : '' ; ?> value="sv">Savona</option>
					<option <?php echo (strtolower($students->Prov_n) == 'si')? 'selected' : '' ; ?> value="si">Siena</option>
					<option <?php echo (strtolower($students->Prov_n) == 'sr')? 'selected' : '' ; ?> value="sr">Siracusa</option>
					<option <?php echo (strtolower($students->Prov_n) == 'so')? 'selected' : '' ; ?> value="so">Sondrio</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ta')? 'selected' : '' ; ?> value="ta">Taranto</option>
					<option <?php echo (strtolower($students->Prov_n) == 'te')? 'selected' : '' ; ?> value="te">Teramo</option>
					<option <?php echo (strtolower($students->Prov_n) == 'tr')? 'selected' : '' ; ?> value="tr">Terni</option>
					<option <?php echo (strtolower($students->Prov_n) == 'to')? 'selected' : '' ; ?> value="to">Torino</option>
					<option <?php echo (strtolower($students->Prov_n) == 'tp')? 'selected' : '' ; ?> value="tp">Trapani</option>
					<option <?php echo (strtolower($students->Prov_n) == 'tn')? 'selected' : '' ; ?> value="tn">Trento</option>
					<option <?php echo (strtolower($students->Prov_n) == 'tv')? 'selected' : '' ; ?> value="tv">Treviso</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ts')? 'selected' : '' ; ?> value="ts">Trieste</option>
					<option <?php echo (strtolower($students->Prov_n) == 'ud')? 'selected' : '' ; ?> value="ud">Udine</option>
					<option <?php echo (strtolower($students->Prov_n) == 'va')? 'selected' : '' ; ?> value="va">Varese</option>
					<option <?php echo (strtolower($students->Prov_n) == 've')? 'selected' : '' ; ?> value="ve">Venezia</option>
					<option <?php echo (strtolower($students->Prov_n) == 'vb')? 'selected' : '' ; ?> value="vb">Verbano-Cusio-Ossola</option>
					<option <?php echo (strtolower($students->Prov_n) == 'vc')? 'selected' : '' ; ?> value="vc">Vercelli</option>
					<option <?php echo (strtolower($students->Prov_n) == 'vr')? 'selected' : '' ; ?> value="vr">Verona</option>
					<option <?php echo (strtolower($students->Prov_n) == 'vv')? 'selected' : '' ; ?> value="vv">Vibo valentia</option>
					<option <?php echo (strtolower($students->Prov_n) == 'vi')? 'selected' : '' ; ?> value="vi">Vicenza</option>
					<option <?php echo (strtolower($students->Prov_n) == 'vt')? 'selected' : '' ; ?> value="vt">Viterbo</option>
		    	</select>
		    </div>
		  </div>
		  <div class="form-group row input_Luogo-r">
		    <label for="Luogo_r" class="col-sm-2 col-form-label">Comune di Residenza</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-danger" id="Luogo_r" name="Luogo_r" value="<?php echo $students->Luogo_r; ?>">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="Prov_r" class="col-sm-2 col-form-label">Provincia di Residenza</label>
		    <div class="col-sm-10">
		      <select class="form-control" id="Prov_r" name="Prov_r">
					<option <?php echo (strtolower($students->Prov_r) == '')  ?	'selected' : '' ; ?> value="">Scegli...</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ag')? 'selected' : '' ; ?> value="ag">Agrigento</option>
					<option <?php echo (strtolower($students->Prov_r) == 'al')? 'selected' : '' ; ?> value="al">Alessandria</option>
					<option <?php echo (strtolower($students->Prov_r) == 'an')? 'selected' : '' ; ?> value="an">Ancona</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ao')? 'selected' : '' ; ?> value="ao">Aosta</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ar')? 'selected' : '' ; ?> value="ar">Arezzo</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ap')? 'selected' : '' ; ?> value="ap">Ascoli Piceno</option>
					<option <?php echo (strtolower($students->Prov_r) == 'at')? 'selected' : '' ; ?> value="at">Asti</option>
					<option <?php echo (strtolower($students->Prov_r) == 'av')? 'selected' : '' ; ?> value="av">Avellino</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ba')? 'selected' : '' ; ?> value="ba">Bari</option>
					<option <?php echo (strtolower($students->Prov_r) == 'bt')? 'selected' : '' ; ?> value="bt">Barletta-Andria-Trani</option>
					<option <?php echo (strtolower($students->Prov_r) == 'bl')? 'selected' : '' ; ?> value="bl">Belluno</option>
					<option <?php echo (strtolower($students->Prov_r) == 'bn')? 'selected' : '' ; ?> value="bn">Benevento</option>
					<option <?php echo (strtolower($students->Prov_r) == 'bg')? 'selected' : '' ; ?> value="bg">Bergamo</option>
					<option <?php echo (strtolower($students->Prov_r) == 'bi')? 'selected' : '' ; ?> value="bi">Biella</option>
					<option <?php echo (strtolower($students->Prov_r) == 'bo')? 'selected' : '' ; ?> value="bo">Bologna</option>
					<option <?php echo (strtolower($students->Prov_r) == 'bz')? 'selected' : '' ; ?> value="bz">Bolzano</option>
					<option <?php echo (strtolower($students->Prov_r) == 'bs')? 'selected' : '' ; ?> value="bs">Brescia</option>
					<option <?php echo (strtolower($students->Prov_r) == 'br')? 'selected' : '' ; ?> value="br">Brindisi</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ca')? 'selected' : '' ; ?> value="ca">Cagliari</option>
					<option <?php echo (strtolower($students->Prov_r) == 'cl')? 'selected' : '' ; ?> value="cl">Caltanissetta</option>
					<option <?php echo (strtolower($students->Prov_r) == 'cb')? 'selected' : '' ; ?> value="cb">Campobasso</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ci')? 'selected' : '' ; ?> value="ci">Carbonia-iglesias</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ce')? 'selected' : '' ; ?> value="ce">Caserta</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ct')? 'selected' : '' ; ?> value="ct">Catania</option>
					<option <?php echo (strtolower($students->Prov_r) == 'cz')? 'selected' : '' ; ?> value="cz">Catanzaro</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ch')? 'selected' : '' ; ?> value="ch">Chieti</option>
					<option <?php echo (strtolower($students->Prov_r) == 'co')? 'selected' : '' ; ?> value="co">Como</option>
					<option <?php echo (strtolower($students->Prov_r) == 'cs')? 'selected' : '' ; ?> value="cs">Cosenza</option>
					<option <?php echo (strtolower($students->Prov_r) == 'cr')? 'selected' : '' ; ?> value="cr">Cremona</option>
					<option <?php echo (strtolower($students->Prov_r) == 'kr')? 'selected' : '' ; ?> value="kr">Crotone</option>
					<option <?php echo (strtolower($students->Prov_r) == 'cn')? 'selected' : '' ; ?> value="cn">Cuneo</option>
					<option <?php echo (strtolower($students->Prov_r) == 'en')? 'selected' : '' ; ?> value="en">Enna</option>
					<option <?php echo (strtolower($students->Prov_r) == 'fm')? 'selected' : '' ; ?> value="fm">Fermo</option>
					<option <?php echo (strtolower($students->Prov_r) == 'fe')? 'selected' : '' ; ?> value="fe">Ferrara</option>
					<option <?php echo (strtolower($students->Prov_r) == 'fi')? 'selected' : '' ; ?> value="fi">Firenze</option>
					<option <?php echo (strtolower($students->Prov_r) == 'fg')? 'selected' : '' ; ?> value="fg">Foggia</option>
					<option <?php echo (strtolower($students->Prov_r) == 'fc')? 'selected' : '' ; ?> value="fc">Forl&igrave;-Cesena</option>
					<option <?php echo (strtolower($students->Prov_r) == 'fr')? 'selected' : '' ; ?> value="fr">Frosinone</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ge')? 'selected' : '' ; ?> value="ge">Genova</option>
					<option <?php echo (strtolower($students->Prov_r) == 'go')? 'selected' : '' ; ?> value="go">Gorizia</option>
					<option <?php echo (strtolower($students->Prov_r) == 'gr')? 'selected' : '' ; ?> value="gr">Grosseto</option>
					<option <?php echo (strtolower($students->Prov_r) == 'im')? 'selected' : '' ; ?> value="im">Imperia</option>
					<option <?php echo (strtolower($students->Prov_r) == 'is')? 'selected' : '' ; ?> value="is">Isernia</option>
					<option <?php echo (strtolower($students->Prov_r) == 'sp')? 'selected' : '' ; ?> value="sp">La spezia</option>
					<option <?php echo (strtolower($students->Prov_r) == 'aq')? 'selected' : '' ; ?> value="aq">L'aquila</option>
					<option <?php echo (strtolower($students->Prov_r) == 'lt')? 'selected' : '' ; ?> value="lt">Latina</option>
					<option <?php echo (strtolower($students->Prov_r) == 'le')? 'selected' : '' ; ?> value="le">Lecce</option>
					<option <?php echo (strtolower($students->Prov_r) == 'lc')? 'selected' : '' ; ?> value="lc">Lecco</option>
					<option <?php echo (strtolower($students->Prov_r) == 'li')? 'selected' : '' ; ?> value="li">Livorno</option>
					<option <?php echo (strtolower($students->Prov_r) == 'lo')? 'selected' : '' ; ?> value="lo">Lodi</option>
					<option <?php echo (strtolower($students->Prov_r) == 'lu')? 'selected' : '' ; ?> value="lu">Lucca</option>
					<option <?php echo (strtolower($students->Prov_r) == 'mc')? 'selected' : '' ; ?> value="mc">Macerata</option>
					<option <?php echo (strtolower($students->Prov_r) == 'mn')? 'selected' : '' ; ?> value="mn">Mantova</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ms')? 'selected' : '' ; ?> value="ms">Massa-Carrara</option>
					<option <?php echo (strtolower($students->Prov_r) == 'mt')? 'selected' : '' ; ?> value="mt">Matera</option>
					<option <?php echo (strtolower($students->Prov_r) == 'vs')? 'selected' : '' ; ?> value="vs">Medio Campidano</option>
					<option <?php echo (strtolower($students->Prov_r) == 'me')? 'selected' : '' ; ?> value="me">Messina</option>
					<option <?php echo (strtolower($students->Prov_r) == 'mi')? 'selected' : '' ; ?> value="mi">Milano</option>
					<option <?php echo (strtolower($students->Prov_r) == 'mo')? 'selected' : '' ; ?> value="mo">Modena</option>
					<option <?php echo (strtolower($students->Prov_r) == 'mb')? 'selected' : '' ; ?> value="mb">Monza e della Brianza</option>
					<option <?php echo (strtolower($students->Prov_r) == 'na')? 'selected' : '' ; ?> value="na">Napoli</option>
					<option <?php echo (strtolower($students->Prov_r) == 'no')? 'selected' : '' ; ?> value="no">Novara</option>
					<option <?php echo (strtolower($students->Prov_r) == 'nu')? 'selected' : '' ; ?> value="nu">Nuoro</option>
					<option <?php echo (strtolower($students->Prov_r) == 'og')? 'selected' : '' ; ?> value="og">Ogliastra</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ot')? 'selected' : '' ; ?> value="ot">Olbia-Tempio</option>
					<option <?php echo (strtolower($students->Prov_r) == 'or')? 'selected' : '' ; ?> value="or">Oristano</option>
					<option <?php echo (strtolower($students->Prov_r) == 'pd')? 'selected' : '' ; ?> value="pd">Padova</option>
					<option <?php echo (strtolower($students->Prov_r) == 'pa')? 'selected' : '' ; ?> value="pa">Palermo</option>
					<option <?php echo (strtolower($students->Prov_r) == 'pr')? 'selected' : '' ; ?> value="pr">Parma</option>
					<option <?php echo (strtolower($students->Prov_r) == 'pv')? 'selected' : '' ; ?> value="pv">Pavia</option>
					<option <?php echo (strtolower($students->Prov_r) == 'pg')? 'selected' : '' ; ?> value="pg">Perugia</option>
					<option <?php echo (strtolower($students->Prov_r) == 'pu')? 'selected' : '' ; ?> value="pu">Pesaro e Urbino</option>
					<option <?php echo (strtolower($students->Prov_r) == 'pe')? 'selected' : '' ; ?> value="pe">Pescara</option>
					<option <?php echo (strtolower($students->Prov_r) == 'pc')? 'selected' : '' ; ?> value="pc">Piacenza</option>
					<option <?php echo (strtolower($students->Prov_r) == 'pi')? 'selected' : '' ; ?> value="pi">Pisa</option>
					<option <?php echo (strtolower($students->Prov_r) == 'pt')? 'selected' : '' ; ?> value="pt">Pistoia</option>
					<option <?php echo (strtolower($students->Prov_r) == 'pn')? 'selected' : '' ; ?> value="pn">Pordenone</option>
					<option <?php echo (strtolower($students->Prov_r) == 'pz')? 'selected' : '' ; ?> value="pz">Potenza</option>
					<option <?php echo (strtolower($students->Prov_r) == 'po')? 'selected' : '' ; ?> value="po">Prato</option>
					<option <?php echo (strtolower($students->Prov_r) == 'rg')? 'selected' : '' ; ?> value="rg">Ragusa</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ra')? 'selected' : '' ; ?> value="ra">Ravenna</option>
					<option <?php echo (strtolower($students->Prov_r) == 'rc')? 'selected' : '' ; ?> value="rc">Reggio di Calabria</option>
					<option <?php echo (strtolower($students->Prov_r) == 're')? 'selected' : '' ; ?> value="re">Reggio nell'Emilia</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ri')? 'selected' : '' ; ?> value="ri">Rieti</option>
					<option <?php echo (strtolower($students->Prov_r) == 'rn')? 'selected' : '' ; ?> value="rn">Rimini</option>
					<option <?php echo (strtolower($students->Prov_r) == 'rm')? 'selected' : '' ; ?> value="rm">Roma</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ro')? 'selected' : '' ; ?> value="ro">Rovigo</option>
					<option <?php echo (strtolower($students->Prov_r) == 'sa')? 'selected' : '' ; ?> value="sa">Salerno</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ss')? 'selected' : '' ; ?> value="ss">Sassari</option>
					<option <?php echo (strtolower($students->Prov_r) == 'sv')? 'selected' : '' ; ?> value="sv">Savona</option>
					<option <?php echo (strtolower($students->Prov_r) == 'si')? 'selected' : '' ; ?> value="si">Siena</option>
					<option <?php echo (strtolower($students->Prov_r) == 'sr')? 'selected' : '' ; ?> value="sr">Siracusa</option>
					<option <?php echo (strtolower($students->Prov_r) == 'so')? 'selected' : '' ; ?> value="so">Sondrio</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ta')? 'selected' : '' ; ?> value="ta">Taranto</option>
					<option <?php echo (strtolower($students->Prov_r) == 'te')? 'selected' : '' ; ?> value="te">Teramo</option>
					<option <?php echo (strtolower($students->Prov_r) == 'tr')? 'selected' : '' ; ?> value="tr">Terni</option>
					<option <?php echo (strtolower($students->Prov_r) == 'to')? 'selected' : '' ; ?> value="to">Torino</option>
					<option <?php echo (strtolower($students->Prov_r) == 'tp')? 'selected' : '' ; ?> value="tp">Trapani</option>
					<option <?php echo (strtolower($students->Prov_r) == 'tn')? 'selected' : '' ; ?> value="tn">Trento</option>
					<option <?php echo (strtolower($students->Prov_r) == 'tv')? 'selected' : '' ; ?> value="tv">Treviso</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ts')? 'selected' : '' ; ?> value="ts">Trieste</option>
					<option <?php echo (strtolower($students->Prov_r) == 'ud')? 'selected' : '' ; ?> value="ud">Udine</option>
					<option <?php echo (strtolower($students->Prov_r) == 'va')? 'selected' : '' ; ?> value="va">Varese</option>
					<option <?php echo (strtolower($students->Prov_r) == 've')? 'selected' : '' ; ?> value="ve">Venezia</option>
					<option <?php echo (strtolower($students->Prov_r) == 'vb')? 'selected' : '' ; ?> value="vb">Verbano-Cusio-Ossola</option>
					<option <?php echo (strtolower($students->Prov_r) == 'vc')? 'selected' : '' ; ?> value="vc">Vercelli</option>
					<option <?php echo (strtolower($students->Prov_r) == 'vr')? 'selected' : '' ; ?> value="vr">Verona</option>
					<option <?php echo (strtolower($students->Prov_r) == 'vv')? 'selected' : '' ; ?> value="vv">Vibo valentia</option>
					<option <?php echo (strtolower($students->Prov_r) == 'vi')? 'selected' : '' ; ?> value="vi">Vicenza</option>
					<option <?php echo (strtolower($students->Prov_r) == 'vt')? 'selected' : '' ; ?> value="vt">Viterbo</option>
		      </select>
		    </div>
		  </div>
		  <div class="form-group row input_Telefono">
		    <label for="Telefono" class="col-sm-2 col-form-label">Telefono</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-danger" id="Telefono" name="Telefono" value="<?php echo $students->Telefono; ?>">
		    </div>
		  </div>
		  <div class="form-group row input_e_mail">
		    <label for="e_mail" class="col-sm-2 col-form-label">Email</label>
		    <div class="col-sm-10">
		      <input type="email" class="form-control form-control-danger" id="e_mail" name="e_mail" value="<?php echo $students->e_mail; ?>">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Curriculum</label>
		    <div class="col-sm-10">
		    	<select class="form-control" id="curriculum" name="curriculum">
					<option value="">Scegli...</option>
					<?php 
						foreach($curriculum as $cv) {
							$selected_ok = (strtolower($students->curriculum) == strtolower($cv['nome']))? 'selected' : '';
							echo '<option value="'.$cv['nome'].'" '.$selected_ok.'>'.$cv['nome'].'</option>';
						}
					?>
		    	</select>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Titolo tesi</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-danger" id="Titolo_tesi" name="Titolo_tesi" value="<?php echo $students->Titolo_tesi; ?>">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Tipologia</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-danger" id="tipologia" name="tipologia" value="<?php echo $students->tipologia; ?>">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Relatore</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-danger" id="relatore" name="relatore" value="<?php echo $students->relatore; ?>">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Voto Laurea</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-danger" id="Voto_laurea" name="Voto_laurea" value="<?php echo $students->Voto_laurea; ?>">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="cum_laude" class="col-sm-2 col-form-label">Cum Laude</label>
		    <div class="col-sm-10">
				<label class="custom-control custom-radio">
				  <input id="cum_laude" name="cum_laude" type="radio" class="custom-control-input" value="si" <?php echo ($students->cum_laude == 'si')? 'checked="true"':''; ?>>
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">Si <i class="fa fa-check" aria-hidden="true"></i></span>
				</label>
				<label class="custom-control custom-radio">
				  <input id="cum_laude2" name="cum_laude" type="radio" class="custom-control-input" value="no" <?php echo ($students->cum_laude == 'no')? 'checked="true"':''; ?>>
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">No <i class="fa fa-times" aria-hidden="true"></i></span>
				</label>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Data di Laurea</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-danger" id="Data_Laurea" name="Data_Laurea" value="<?php echo $students->Data_Laurea; ?>">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="Note" class="col-sm-2 col-form-label">Note</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control form-control-danger" id="Note" name="Note" value="<?php echo $students->Note; ?>">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="Visibility" class="col-sm-2 col-form-label">Visibilità</label>
		    <div class="col-sm-10">
				<label class="custom-control custom-radio">
				  <input id="Visibility" name="Visibility" type="radio" class="custom-control-input" value="1" <?php echo ($students->Visibility == 1)? 'checked="true"':''; ?>>
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">Visibile <i class="fa fa-check" aria-hidden="true"></i></span>
				</label>
				<label class="custom-control custom-radio">
				  <input id="Visibility2" name="Visibility" type="radio" class="custom-control-input" value="0" <?php echo ($students->Visibility == 0)? 'checked="true"':''; ?>>
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">Nascosto <i class="fa fa-times" aria-hidden="true"></i></span>
				</label>
		    </div>
		  </div>

			<div class="form-group button-log">
				<button type="submit" class="btn btn-warning">Aggiorna Dati</button>
			</div>
		</form>

		<hr>

		  <div class="form-group row">
		    <label for="Tesi" class="col-sm-2 col-form-label">Tesi</label>
		    <div class="col-sm-10">
                <?php if($students->Tesi_download != '') : ?>
					<?php echo '<a href="'.APP_URL.'/assets/files/tesi/'.$students->Tesi_download.'" class="view-more-student btn btn-warning" target="blank">Visualizza Tesi</a>'; ?>
				<?php endif; ?>	
				&nbsp;<button type="button" class="btn btn-warning" id="openInviaTesi">Modifica Tesi</button>
		    </div>
		  </div>

		</div><br>

			<div class="modal fade" id="inviaTesi">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Modifica la tesi del laureato</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			      <!-- start form -->
			      <form method="post" enctype="multipart/form-data" action="">
					  <input type="file" id="Tesi_upload" name="Tesi_upload">
					  <small class="form-text text-muted">Dimensione massima: <strong>6MB</strong>.<br>File permessi: <strong>PDF, PNG, JPG</strong>.</small>
			      </div>
			      <div class="modal-footer">
			        <button type="submit" class="btn btn-warning">Carica</button>
			      </div>
				  </form>
				  <!-- /end form -->
			    </div>
			  </div>
			</div>
	</main>