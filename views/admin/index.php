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

			<h3>Login negli ultimi 7 giorni</h3>
			<p class="lead">Nel grafico sottostante è possibile visualizzare la statistica degli utenti (aziende o studenti) che hanno eseguito il login alla loro area riservata negli ultimi 7 giorni.</p>
			<canvas id="login-chart" class="mt-5 mb-5"></canvas>

			<h3>Media voto di laurea</h3>
			<p class="lead">Nel grafico sottostante è possibile visualizzare l'andamento dei voti di laurea.</p>
			<canvas id="vote-chart" class="mt-5 mb-5"></canvas>

			<div class="text-right pb-2"><small>Ultimo accesso effettuato il <strong><?php echo substr($info->last_update,0,10); ?></strong> alle <strong><?php echo substr($info->last_update,11); ?></strong> con l'indirizzo ip <strong><?php echo $info->ip; ?></strong></small></div>
		</div>

	</main>
	<script>
		var data = {
	      labels: <?php echo json_encode($last_seven); ?>,
	      datasets: [
		    {
		        backgroundColor: "rgba(0, 68, 0,0.5)",
		        borderColor: "rgba(0, 68, 0,1)",
		        data: <?php echo json_encode($lastLoginStudenti); ?>,
		        label: "Studenti"
		    },
		    {
		        backgroundColor: "rgba(136, 204, 136,0.5)",
		        borderColor: "rgba(136, 204, 136,1)",
		        data: <?php echo json_encode($lastLoginAziende); ?>,
		        label: "Aziende"
		    }
	      ]
		};
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