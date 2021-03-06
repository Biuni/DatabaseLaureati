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

			<h3>Lista Aziende</h3>
			<p class="lead">Lista di tutte le aziende registrate.</p><br>

			<div class="table-lauerati table-responsive">

				<a name="ricerca"></a>
				<table id="aziende-list-admin" class="table table-striped table-bordered responsive wrap" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th>Ragione Sociale</th>
			                <th>Nome</th>
			                <th>Cognome</th>
			                <th>Email</th>
			                <th>Newsletter</th>
			                <th>Modifica Dati</th>
			            </tr>
			        </thead>
			        <tbody>

					<?php foreach($companies as $company) { ?>

			            <tr>
			            <td><?php echo $company['r_sociale']; ?></td>
			            <td><?php echo $company['nome']; ?></td>
			            <td><?php echo $company['cognome']; ?></td>
			            <td><?php echo $company['email']; ?></td>
			            <td><?php echo ($company['newsletter'] == 'Si')? '<i class="fa fa-check" aria-hidden="true"></i> (Si)' : '<i class="fa fa-times" aria-hidden="true"></i> (No)'; ?></td>
			            <td><a href="<?php echo APP_URL; ?>/admin/aziende/modifica/<?php echo $company['ID'] ?>/" class="btn btn-warning view-more-student" target="blank">Modifica</a></td>
			            </tr>

					<?php } ?>

			        </tbody>
			    </table>
			</div><br>
		</div>

	</main>