<?= $renderer->render('header') ?>

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

			<li><a href="#">Contact</a></li>
			<li><a href="#">Catégories</a></li>
			<!--	<li><a href="#">HOMEPAGE</a></li>
				<li><a href="#">HOMEPAGE</a></li>
				<li><a href="#">HOMEPAGE</a></li>
				<li><a href="#">HOMEPAGE</a></li> -->
			<li><a href="#">Accueil</a></li>
		</ul>

	</div>
</div>

<!-- Ici, nous allons récupérer pour afficher la carte depuis une autre page.========================================
================================================================= -->


<!-- 3e range partie recherche ========================================
================================================================= -->
<div class="row">
	<div class="col-lg-9 bar">
		<div class="input-group">
			<div class="input-group-btn">
				<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
			</div>
			<input type="text" class="form-control" placeholder="Mot(s) clé(s)">
		</div>
	</div>

	<div class="col-lg-3 bar2">
		<button type="button" class="btn btn-success btn-lg bouton"><i class="glyphicon glyphicon-search"></i>Recherche</button>
	</div>
</div>


<!-- 4e range article , les categories ========================================
================================================================= -->
<div class="row">
	<div class="col-lg-9">
		<div class="text-center">
			<h1>Les principales catégories : </h1>
			<P>Depuis de nombreux mois nos équipes sont à pied d'oeuvre pour produire chaque catégorie du site mais, pour cela il nous a fallu innover.
				<br> Vous trouverez en dessous les principales catégories.</P>
		</div>

		<!--range trouver a l'interieur du ranger article ========================================
	================================================================= -->
		<div class="row">
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-2">
						<button type="button" class="btn btn-success">
							<span class="glyphicon glyphicon-user"></span>
						</button>
					</div>
					<div class="col-lg-10">
						<h4>Automaitive</h4>
						<p>Il fut le premier membre de l'Internet Society et était le responsable de l'IANA, l'organisation gérant l'allocation des adresses IP sur l'Internet.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-2">
						<button type="button" class="btn btn-success">
							<span class="glyphicon glyphicon-user"></span>
						</button>
					</div>
					<div class="col-lg-10">
						<h4>Automaitive</h4>
						<p>Il fut le premier membre de l'Internet Society et était le responsable de l'IANA, l'organisation gérant l'allocation des adresses IP sur l'Internet.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-2">
						<button type="button" class="btn btn-success">
							<span class="glyphicon glyphicon-user"></span>
						</button>
					</div>
					<div class="col-lg-10">
						<h4>Automaitive</h4>
						<p>Il fut le premier membre de l'Internet Society et était le responsable de l'IANA, l'organisation gérant l'allocation des adresses IP sur l'Internet.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-2">
						<button type="button" class="btn btn-success">
							<span class="glyphicon glyphicon-user"></span>
						</button>
					</div>
					<div class="col-lg-10">
						<h4>Automaitive</h4>
						<p>Il fut le premier membre de l'Internet Society et était le responsable de l'IANA, l'organisation gérant l'allocation des adresses IP sur l'Internet.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-2">
						<button type="button" class="btn btn-success"><i class="glyphicon glyphicon-search"></i></button>
					</div>
					<div class="col-lg-10">
						<h4>Automaitive</h4>
						<p>Il fut le premier membre de l'Internet Society et était le responsable de l'IANA, l'organisation gérant l'allocation des adresses IP sur l'Internet.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-2">
						<button type="button" class="btn btn-success">
							<span class="glyphicon glyphicon-user"></span>
						</button>
					</div>
					<div class="col-lg-10">
						<h4>Automaitive</h4>
						<p>Il fut le premier membre de l'Internet Society et était le responsable de l'IANA, l'organisation gérant l'allocation des adresses IP sur l'Internet.</p>
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- le formulaire et recherche a gauche de l'ecran ========================================
	================================================================= -->
	<div class="col-lg-3 sidebar">
		<div class="input-group" style="padding-top: 40px;">
			<input type="text" class="form-control" placeholder="Rechercher...">
			<div class="input-group-btn">
				<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
			</div>
		</div>

		<!-- ici se trouvera l'espace membre qui est actuellement en production et énovation, il y a un gros travail à faire dessus puisqu'il faut relier de nombreuse chose, je pense qu'il y en a pour 8 mois de production à ce jour -> 6 mai 2018. ========================================
				================================================================= -->

		<div class="row" id="range1">
			<div class="col-lg-1">

			</div>
			<div class="col-lg-4">
				<h4>Espace membre</h4>
			</div>

		</div>
		<div class="row" id="range2">

			<div class="col-lg-12">
				<div class="input-group">
					<div class="input-group-btn">
						<i class="btn btn-default"><span class="glyphicon glyphicon-user"></span></i>
					</div>
					<input type="text" class="form-control" placeholder="Ton pseudo ">
				</div>
				<div class="input-group">
					<div class="input-group-btn">
						<i class="btn btn-default"><span class="glyphicon glyphicon-user"></span></i>
					</div>
					<input type="password" class="form-control" placeholder="Le mot de passe">
				</div>
			</div> <br> <br> <br>

			<div class="row" id="range3">
				<div class="col-lg-4 col-lg-offset-2">
					<button type="submit" class="btn btn-success">Connexion</button>
				</div>
				<div class="col-lg-6">
					<button type="submit" class="btn btn-default">Mot de passe oublié</button>
				</div>

			</div>
		</div>
		<div id="range4">
		</div>
	</div>
</div>
<?= $renderer->render('footer') ?>
