<?php
	$title="Tech";
	$description="Appropriation du Json et XML";
	$h1="TECH";
	$logo = 'images/logoNuit.png';
	require"./include/header.inc.php";
	require"./include/functions.inc.php";
?>

<section>
	<h2>Photo ou vidéo de la Nasa</h2>

			<?php
				echo getNasaImage();
			?>


</section>
<section>
	<h2>Votre position géographique </h2>
		
		<article>
			<h3>Récupération des informations en XML</h3>
				<?php
					echo getGeopluginXml();
			?>
		</article>
		<article>
			<h3>Récupération des informations en Json</h3>
				<?php
					echo getGeopluginJson();
			?>
		</article>
		<article>
			<h3>Récupération des informations avec WhatIsMyIp</h3>
				<?php
					echo getGeoWhatIsMyIpXml();
				?>
				
		</article>
		
</section>

<?php
	require"./include/footer.inc.php";
?>