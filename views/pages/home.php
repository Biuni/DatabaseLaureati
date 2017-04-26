<!-- Corpo centrale del sito -->
<main id="homepage">
	<!-- Presentazione CDL -->
	<section class="urbino-top">
		<h1>Database Laureati</h1>
		<h6 class="lead">Informatica Applicata</h6>
	</section>

	<!-- Funzionamento DB Laureati -->
	<section class="about-db-cdl">
		<div class="container">
			<h3>Come funziona il database laureati?</h3>
			<div class="row">
				<div class="col-sm-6">
					<blockquote class="blockquote blockquote-reverse">
						<h4><i class="fa fa-building" aria-hidden="true"></i> Sei un'azienda?</h4>
						<p class="mb-0">Questo portale consente alle aziende di richiedere un account per consultare il database dei laureati del Corso di Laurea in Informatica Applicata. Le interrogazioni al database possono avvenire in base a diversi criteri di ricerca e consentono di scaricare, se presente, il curriculum vitae dei laureati in formato PDF.</p>
					</blockquote>
				</div>
				<div class="col-sm-6">
					<blockquote class="blockquote">
						<h4><i class="fa fa-graduation-cap" aria-hidden="true"></i> Sei uno studente?</h4>
						<p class="mb-0">Questo portale consente ai laureati del Corso di Laurea in Informatica Applicata di visualizzare, modificare, e rendere visibili alle aziende i propri dati, compresa una versione in PDF del curriculum vitae.</p>
					</blockquote>
				</div>
				<div class="col-sm-6">
					<blockquote class="blockquote blockquote-reverse">
						<h4><i class="fa fa-sign-in" aria-hidden="true"></i> Registrazione account azienda</h4>
						<p class="mb-0">Sei il responsabile addetto alle risorse umane della tua azienda e vuoi trovare un profilo adatto alla tua ricerca? Ti basterà andare nella sezione di Registrazione nel menù del sito e compilare i campi per poi ricevere username e password utilizzabili per accedere al database. </p>
					</blockquote>
				</div>
				<div class="col-sm-6">
					<blockquote class="blockquote">
						<h4><i class="fa fa-sign-in" aria-hidden="true"></i> Gestione account studente</h4>
						<p class="mb-0">I laureandi del Corso Di Laurea in Informatica Applicata ricevono i dati di registrazione del proprio account il giorno della discussione della tesi.</p>
					</blockquote>
				</div>
			</div>
		</div>
	</section>

	<!-- Numeri del CDL -->
	<section class="uni-number">
		<div class="container">
			<h3>I numeri dei nostri laureati</h3>

			<div class="incremental">
				<div class="numbers-grow">
					<i class="fa fa-user" aria-hidden="true"></i>
					<h4 class="counter"><?php echo $info->num_laureati; ?></h4>
					<h5>Laureati</h5>
				</div>
				<div class="numbers-grow">
					<i class="fa fa-trophy" aria-hidden="true"></i>
					<h4 class="counter"><?php echo $info->media_laurea; ?></h4>
					<h5>Media Voto di Laurea</h5>
				</div>
			</div>
			<div class="clear"></div>

		</div>
	</section>
</main>