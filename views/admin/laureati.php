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

			<h3>Lista Laureati</h3>
			<p class="lead">Lista di tutti i laureati, compresi quelli che non sono visibili alle aziende.</p><br>

			<div class="table-lauerati table-responsive">

				<a name="ricerca"></a>
				<table id="student-list-admin" class="table table-striped table-bordered responsive wrap" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th>Nome</th>
			                <th>Cognome</th>
			                <th>Voto di Laurea</th>
			                <th>Data di Laurea</th>
			                <th>Dati Completi</th>
			                <th>Modifica Dati</th>
			            </tr>
			        </thead>
			        <tbody>

					<?php foreach($students as $student) { ?>

			            <tr>
			            <td><?php echo $student['Nome']; ?></td>
			            <td><?php echo $student['Cognome']; ?></td>
			            <td><?php echo $student['Voto_laurea'];  echo ($student['cum_laude'] == 'si')? " e lode" : ""; ?></td>
			            <td><?php echo $student['Data_Laurea']; ?></td>
			            <td><a href="<?php echo APP_URL; ?>/admin/laureati/dettaglio/<?php echo $student['ID'] ?>/" class="btn btn-warning view-more-student">Visualizza</a></td>
			            <td><a href="<?php echo APP_URL; ?>/admin/laureati/modifica/<?php echo $student['ID'] ?>/" class="btn btn-warning view-more-student">Modifica</a></td>
			            </tr>

					<?php } ?>

			        </tbody>
			    </table>
			</div><br>

		</div>

	</main>