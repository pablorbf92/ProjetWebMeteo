<?php
	$title="Statistiques";
	$description="page de stats";
	$h1="Statistiques";
	$logo = 'images/logoNuit.png';
	require"./include/header.inc.php";
	require"./include/functions.inc.php";
?>

<section>
	<h2>Statistiques</h2>
	<article>
		<h3>Histogramme des villes les plus consultées </h3>
			<?php


				$tab = getNombreVillesConsultees();
				
				foreach($tab as $ville=>$nb){
					echo "<span> $ville - $nb </span>";				
				}
				echo histogrammeAffichage();
			?>	
	</article>
</section>

<?php
	require"./include/footer.inc.php";
?>
	