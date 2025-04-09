<?php
	$title="Accueil";
	$description="page d'acceuil";
	$h1="Accueil";
	$logo = 'images/logoNuit.png';
	require"./include/header.inc.php";
	require"./include/functions.inc.php";
	modifCookie();
?>

<section>
	<h2>Meteo</h2>
	<article>
		<h3>Carte sélection de région</h3>
		<?php 
			echo mapFrance();
					
			echo getDerniereVilleCons();
			
			if(isset($_GET["region"])){
					$region = $_GET["region"];
				echo getFormDepartement($region);
		
				if(isset($_GET["dep"])){
					$codedep = $_GET["dep"];
					
					echo getFormVille($region,$codedep);		
					
					if(isset($_GET["ville"])){
						$ville = $_GET["ville"];
						$latitude = getLatitude($ville);
						$longitude = getLongitude($ville);
						
						putVillesConsultees($ville);
						echo getMeteo($ville,$longitude,$latitude);			
					}	
				}
			}
		?>
		
<?php
	require"./include/footer.inc.php";
?>
		
	</article>
</section>