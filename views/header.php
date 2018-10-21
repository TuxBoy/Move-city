<!doctype html>
<html lang="fr"> <!-- quand j'aurais un meilleur niveau en anglais, il faudrait passer le site en anglais afin qu'on sois meilleur auniveau du référencement. Actuellement, le site est dev en local. -->
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/app.css">

	<!!-- carte -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/0.4.0/MarkerCluster.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/0.4.0/MarkerCluster.Default.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/0.4.0/leaflet.markercluster.js"></script>

	<title>Move tity - trouvé le lieux qui vous intéresse !</title>
</head>
<body>

<div class="container-fluid">
	<!-- 1e range entete ========================================
						================================================================= -->
	<div class="row" id="tete">
		<div class="col-lg-6">
			<p>Pour toute informations, nos équipes restent disponibles via la page contact</p>
		</div>
		<div class="col-lg-4 pull-right">
			<a class="btn btn-default btn-circle" href="#"><i class="fa fa-twitter fa-1x"></i></a>
			<a class="btn btn-default btn-circle" href="#"><i class="fa fa-facebook fa-1x"></i></a>
			<a class="btn btn-default btn-circle" href="#"><i class="fa fa-google-plus fa-1x"></i></a>
			<!--        <a class="btn btn-default btn-circle" href="#"><i class="fa fa-youtube fa-1x"></i></a> -->


			<button type="button" class="btn btn-primary btn-xs buton">Français</button>
			<!-- au besoin
												<div class="btn-group">
													<button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-shopping-cart"></span></button>
													<button type="button" class="btn btn-success btn-xs">0</button>
												</div>

												<div class="btn-group">
													<button type="button" class="btn btn-primary btn-xs">36 resources</button>
													<button type="button" class="btn btn-success btn-xs">ADD</button>
												</div> -->
		</div>
	</div>

	<!-- 2e range 2e navigation ========================================
	================================================================= -->
	<div class="row">
		<div class="col-lg-3">
			<h1>Move City </h1>
		</div>
		<div class="col-lg-9">
			<ul>
				<?php if ($session->has('user')):  ?>
                    <?php if ($session->get('user')->isAdmin()):  ?>
                        <li><a href="/dashboard">Admin</a></li>
                    <?php endif; ?>
                    <li><a href="/user/destroy">Se déconnecter</a></li>
                    <li><a href="#">Connecté en tant que <?= $session->get('user')->username ?></a></li>
                <?php endif; ?>
				<li><a href="#">Contact</a></li>
				<li><a href="#">Catégories</a></li>
				<li><a href="/">Accueil</a></li>
			</ul>

		</div>
	</div>
