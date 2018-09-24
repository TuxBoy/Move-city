<!doctype html>
<html lang="fr"> <!-- quand j'aurais un meilleur niveau en anglais, il faudrait passer le site en anglais afin qu'on sois meilleur auniveau du référencement. Actuellement, le site est dev en local. -->  
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/css/style.css">

        <title>Move tity - trouvé le lieux qui vous intéresse !</title>
    </head>

    <style>

    	/* les boutons des reseaux */
    	.btn-circle {
    		width: 30px;
    		height: 30px;
    		text-align: center;
    		padding: 6px 0;
    		font-size: 12px;
    		line-height: 1.42;
    		border-radius: 15px;
    		background-color: rgb(220, 220, 220);
		}

		/* header */
		#tete{
			background-color: rgb(241, 241, 241);
			padding:4px 5px;
		}

		.pull-right{
			background-color: rgb(241, 241, 241);
		}

		.btn-group, .buton{
			padding-left: 10px;
		}

		/* nnavigation */

		ul{

			list-style-type: none;
			overflow: hidden;
		
		}

		li{
			float: right;
		}

		

		li a{
			display: block;
			color: black;
			text-align: center;
			padding:14px 16px;
			text-decoration: none;
			padding-top: 35px;
			
		}


		li a:hover {
			background-color: white;
			text-decoration: none;
		}

		/* main gategories */
		.text-center{
			padding-top: 40px;
			padding-bottom: 25px;
		}
		

    </style>
  

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

<?php
include('./carte.php');
?>


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
                    <h1>Les principales catégories :</h1>
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
            </div>
          </div>

          <footer><center>
          	Tous droits réservés à Enzo Métayer - ©2018
          </center></footer>
          <!-- Optional JavaScript -->
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  </body>
</html>