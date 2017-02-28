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

			<h3>Curriculum</h3>
			<p class="lead">Gestione dei curriculum relativi al corso di laurea.</p><br>


			<div class="alert alert-success <?php echo $hide; ?>" role="alert">
			  <strong>Curriculum Aggiunto!</strong> Il nuovo curriculum è stato aggiunto correttamente.
			</div>

			<div class="row">
				<div class="col-md-6">
				<p class="text-center"><strong>Curriculum presenti</strong></p>
				<?php
					echo "<ul class=\"list-group\">";
					foreach($curriculum as $cv) { 
				        echo '<li class="list-group-item">'.$cv['nome'].'</li>';
					}
					echo "</ul>";

				?>
				</div>
				<div class="col-md-6">
				<p class="text-center"><strong>Aggiungi Curriculum</strong></p>
					<form method="post" action="<?php echo APP_URL; ?>/admin/curriculum">
						<div class="form-group">
						<input type="text" name="cv_nome" class="form-control">
						</div>
						<button type="submit" class="btn btn-warning">Aggiungi</button>
					</form>
				</div>
			</div>

		</div><br>

	</main>