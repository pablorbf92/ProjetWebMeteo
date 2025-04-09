<?php
	function getNasaImage():string{
		
		$date=date("Y-m-d");
		$apiKey="godmVm3v8yxvFBQuxPtupQoRZuZmE60QDbmhCT4b";		
		$url="https://api.nasa.gov/planetary/apod?api_key=".$apiKey."&date=".$date;
		$json=file_get_contents($url);
		$data=json_decode($json, true);
		$mediaType=$data["media_type"];
		$mediaDescription=$data["title"];
		$src=$data["url"];
		$caption="<figcaption>".$mediaDescription."</figcaption>";
		
		if($mediaType == "image"){		
			$img="<img src='$src' alt ='Image de la Nasa' width='600' height='600'/>";
			return "<figure> \n\t".$img."\n\t".$caption."\n</figure>";
		}
		elseif($mediaType == "video") {
    	$video = "<video width='600' height='600' controls>\n\t<source src='$src' type='video/mp4'>Votre navigateur ne supporte pas la lecture de vidéos.</video>";
		return "<figure>\n\t".$video."\n\t".$caption."</figure>";		
		}
		else{
			return "<span>Il n'y a pas de vidéo n'y de photo</span>";				
		}	
	}
	
	function getGeopluginXml():string{
		$ip=$_SERVER['REMOTE_ADDR'];
		$url= "http://www.geoplugin.net/xml.gp?ip=".$ip;
		$xmlResponse=file_get_contents($url);
		$data=simplexml_load_string($xmlResponse);
	
		if($data && isset($data->geoplugin_city) && isset($data->geoplugin_region) && isset($data->geoplugin_countryName)){
			$ville = $data->geoplugin_city;
			$region = $data->geoplugin_region;
			$pays = $data->geoplugin_countryName;
			return "<span>Votre pays est : ".$pays." ,votre région est : ".$region." ,votre ville est : ".$ville."</span>";
		}		
		else{
			return "<span>Erreur lors du chargement de la recherche de vos informations</span>";
		}
	}	
	
	function getGeopluginJson():string{
		$ip= $_SERVER['REMOTE_ADDR'];
		$url ="https://ipinfo.io/".$ip."/geo";
		$json = file_get_contents($url);
		$data = json_decode($json, true);
		if($data && isset($data["city"]) && isset($data["region"]) && isset($data["country"]) ){
			$ville=$data["city"];
			$region=$data["region"];
			$pays=$data["country"];
			return "<span>Votre pays est : ".$pays." ,votre région est : ".$region." ,votre ville est : ".$ville."</span>";			
		}
		else{
			return "<span>Erreur lors du chargement de la recherche de vos informations</span>";
		}
	}
	
	function getGeoWhatIsMyIpXml():string{
		$ip=$_SERVER['REMOTE_ADDR'];
		$keyApi="8872f90a511280dd9187c1f7ed2bc72d";
		$url="https://api.whatismyip.com/ip-address-lookup.php?key=".$keyApi."&input=".$ip."&output=xml";
		$xmlResponse=file_get_contents($url);
		$data=simplexml_load_string($xmlResponse);
		if($data && isset($data->server_data->country) && isset($data->server_data->region) && isset($data->server_data->city)){
			$pays=$data->server_data->country;
			$region=$data->server_data->region;
			$ville=$data->server_data->city;
			return "<span>Votre pays est : ".$pays." ,votre région est : ".$region." ,votre ville est : ".$ville."</span>";
		}
		else{
			return "<span>Erreur lors du chargement de la recherche de vos informations</span>";
		}
	
	}
	
	function mapFrance():string{
	$img="<img usemap='#mapFrance' src='images/carteFrance.png' alt='MDN infographic' />";
	$img.="\n<map name='mapFrance'>";
	$img.="\n\t<area  alt='Bretagne' title='Bretagne-53' href='?region=53' coords='115,292,126,295,134,280,145,283,156,276,160,280,170,265,169,253,168,242,153,236,140,230,132,233,120,234,114,236,109,226,104,222,96,220,86,222,76,224,64,223,55,224,49,227,44,234,58,242,53,235,55,250,42,255,53,262,66,262,71,268,78,271,86,275,94,281,103,282' shape='poly'>";
	$img.="\n\t<area  alt='Normandie' title='Normandie-28' href='?region=28' coords='234,263,237,256,240,247,239,239,246,234,252,233,260,230,260,220,266,215,272,210,268,202,269,192,269,182,266,174,261,170,253,172,248,176,242,177,232,181,224,184,217,189,223,196,219,201,212,204,204,206,194,202,183,199,173,200,167,192,168,184,160,181,150,178,150,186,152,194,156,202,159,209,159,217,159,223,160,230,164,237,173,239,179,244,190,242,198,240,206,242,208,248,216,248,224,254' shape='poly'>";	
	$img.="\n\t<area alt='Hauts-de-France' title='Hauts-de-France-32' href='?region=32'  coords='266,164,271,156,271,148,270,140,273,131,281,129,290,128,297,128,304,128,310,132,315,137,321,134,327,138,328,144,335,148,341,153,349,156,356,161,358,168,357,175,357,182,350,196,347,205,341,209,336,214,335,222,333,228,327,230,322,223,314,219,308,219,300,218,292,214,287,213,279,212,272,213,273,202,274,192,274,184,273,175,268,172' shape='poly'>";
	$img.="\n\t<area  alt='Grand Est' title='Grand Est-44' href='?region=44' coords='361,177,369,179,380,166,380,173,380,182,384,188,391,191,396,195,399,200,406,202,413,202,419,206,427,204,436,207,440,214,444,220,452,221,459,224,468,223,477,226,487,229,495,231,491,239,487,245,483,252,483,260,480,266,477,273,474,280,474,286,473,293,472,300,472,306,466,311,458,306,456,292,448,290,441,283,433,283,426,283,418,278,412,285,406,292,402,297,395,302,386,297,383,289,378,282,371,278,364,280,359,281,348,283,342,276,337,269,334,263,330,256,336,245,332,237,340,222,343,213,351,208,354,199' shape='poly'>";
	$img.="\n\t<area  alt='Ile-de-France' title='Ile-de-France-11' href='?region=11' coords='270,214,277,217,285,216,292,218,298,221,305,222,314,224,322,225,326,233,329,241,333,247,327,252,325,258,314,262,312,269,305,269,298,270,293,261,286,259,280,260,278,253,271,249,268,242,267,233,263,222' shape='poly'>";
	$img.="\n\t<area  alt='Pays de la Loire' title='Pays de la Loire-52' href='?region=52'  coords='172,245,180,248,188,248,193,246,201,244,204,250,209,253,216,250,218,255,224,259,229,263,235,267,234,274,231,281,227,287,222,291,215,294,208,298,206,306,201,310,202,317,194,319,187,320,180,320,175,324,169,328,173,333,175,339,178,345,176,350,175,356,167,359,161,355,154,358,145,354,137,349,134,342,130,335,126,329,131,319,125,311,136,307,132,303,125,302,119,302,113,302,117,296,127,295,133,285,140,285,149,282,157,280,165,277,170,270,171,254,171,263' shape='poly'>";
	$img.="\n\t<area  alt='Centre-Val de Loire' title='Centre-Val de Loire-24' href='?region=24' coords='227,331,219,331,214,325,207,322,205,314,209,305,215,298,222,295,230,289,236,281,238,270,238,260,242,255,242,247,242,239,249,237,257,237,264,233,264,242,267,248,270,254,274,260,279,265,288,265,292,271,298,274,306,275,313,277,312,287,307,291,306,299,307,306,308,314,309,322,311,330,312,337,309,343,304,345,298,348,294,352,289,357,283,358,277,362,271,362,262,362,256,363,248,364,240,361,235,351,235,344,231,338' shape='poly'>";
	$img.="\n\t<area  alt='Bourgogne-Franche-Comté' title='Bourgogne-Franche-Comté-27' href='?region=27' coords='330,349,322,352,313,347,314,340,315,333,314,324,311,316,310,308,313,301,309,294,314,290,318,283,316,276,315,268,320,264,328,264,332,269,337,274,342,279,347,285,354,285,361,286,367,284,373,282,378,287,380,294,383,300,390,304,396,305,403,301,409,298,411,291,416,286,423,285,431,286,437,288,444,291,450,295,453,301,454,309,451,314,454,320,450,325,446,329,441,334,435,338,432,344,429,351,423,355,421,361,418,367,415,374,406,375,397,372,392,367,385,363,379,366,376,373,371,379,367,374,360,373,356,379,347,378,342,375,347,369,347,361,339,357' shape='poly'>";
	$img.="\n\t<area  alt='Nouvelle-Aquitaine' title='Nouvelle-Aquitaine-75' href='?region=75' coords='167,546,169,536,175,532,182,526,181,518,179,509,174,506,175,497,177,489,185,485,191,487,199,484,206,482,212,482,219,480,221,470,227,462,232,456,236,451,243,444,245,435,251,432,256,436,260,441,266,437,272,431,275,424,281,419,286,413,288,402,282,395,288,389,289,381,288,374,280,364,271,363,263,363,253,365,244,365,237,359,230,349,228,342,224,335,216,331,211,328,205,326,202,320,196,322,190,321,185,322,180,324,173,328,178,338,181,346,179,351,179,357,174,360,165,363,159,362,155,369,161,374,160,380,157,385,153,389,158,395,163,402,168,407,170,416,169,425,163,417,158,408,155,402,153,413,151,420,149,426,150,433,146,442,153,443,152,450,147,452,144,458,143,466,141,474,140,483,137,488,134,494,133,500,132,505,128,511,118,515,127,518,130,529,138,532,144,539,152,537,156,542,160,548,170,546' shape='poly'>";
	$img.="\n\t<area alt='Auvergne-Rhônes-Alpes-84' title='Auvergne-Rhônes-Alpes-84' href='?region=84' coords='305,460,301,449,297,443,291,447,287,452,284,458,275,457,274,450,272,441,276,434,280,426,287,419,290,410,290,400,290,391,296,385,293,377,289,369,283,362,289,359,296,357,300,348,307,346,314,349,323,353,329,353,335,356,341,362,344,367,340,374,344,380,353,381,359,381,363,376,369,379,375,379,380,372,382,366,391,368,395,374,402,377,411,377,418,375,416,381,425,382,430,377,437,368,445,371,446,378,449,385,452,391,451,398,446,404,450,410,455,416,459,423,456,428,449,433,441,435,434,437,425,440,429,446,424,449,418,452,412,454,407,458,402,464,399,471,394,477,403,482,402,487,394,488,389,484,381,481,383,473,377,475,370,477,363,478,354,476,348,477,344,470,339,460,338,454,331,449,325,444,318,443,312,445' shape='poly'>";
	$img.="\n\t<area alt='Occitanie' title='Occitanie-76' href='?region=76' coords='246,436,253,437,259,444,266,440,271,446,272,453,274,459,283,459,288,452,294,448,300,453,302,459,307,465,312,458,312,452,316,446,321,451,332,453,336,458,338,467,342,476,342,482,349,483,356,482,362,483,368,489,372,495,370,502,366,506,363,511,358,516,353,523,348,523,342,519,336,522,331,525,326,529,321,531,315,535,310,538,306,542,303,548,301,554,300,559,300,567,301,573,304,578,296,576,290,577,284,581,278,580,270,577,263,579,256,575,251,570,249,563,242,562,236,559,228,557,223,554,215,551,209,549,208,555,203,556,195,555,188,554,178,553,173,547,174,539,183,533,185,527,188,520,185,513,177,504,181,496,185,489,194,491,201,489,210,487,223,482,226,472,229,461,236,457,241,453,246,445' shape='poly'>";
   $img.="\n\t<area  alt='Provence-Alpes-Côte d'Azur-93' title='Provence-Alpes-Côte d'Azur' href='?region=93' coords='357,524,362,516,368,511,372,502,377,496,371,490,372,484,380,484,387,487,397,493,405,493,407,487,406,480,399,478,404,471,408,464,416,459,424,455,432,452,431,446,438,439,442,445,445,451,452,457,452,468,450,474,450,482,458,491,469,496,476,494,475,503,474,509,468,512,464,516,459,519,454,524,448,528,441,531,438,537,433,542,427,543,418,543,408,542,400,539,394,533,388,531,381,531,374,525,371,531,365,529' shape='poly'>";
   $img.="\n\t<area  alt='Corse' title='Corse-94' href='?region=94' coords='506,536,508,545,506,552,507,558,508,566,509,572,510,581,506,587,505,594,504,600,503,609,498,619,494,614,486,609,490,603,484,602,483,595,477,590,484,586,478,582,474,576,480,575,476,569,480,561,486,555,492,553,499,550,502,544' shape='poly'>";
	$img.="\n</map>";
	return $img;


	}
	

function tableauFrance() {
    $regionFile = "CSV/v_region_2024.csv";
    $departementFile = "CSV/v_departement_2024.csv";
    $villeFile = "CSV/v_commune_2024.csv";

    $regions = [];

    // Lire les régions
    if (($handle = fopen($regionFile, "r")) !== FALSE) {
        fgetcsv($handle, 1000, ","); // Ignorer l'en-tête
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $codeRegion = $data[0];
            $nomRegion = $data[3];
            $regions[$codeRegion] = [
                "nom" => $nomRegion,
                "departements" => []
            ];
        }
        fclose($handle);
    }

    if (($handle = fopen($departementFile, "r")) !== FALSE) {
        fgetcsv($handle, 1000, ",");
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $codeDep = $data[0];
            $nomDep = $data[5];
            $codeRegion = $data[1];

            if (isset($regions[$codeRegion])) {
                $regions[$codeRegion]["departements"][$codeDep] = [
                    "nom" => $nomDep,
                    "villes" => []
                ];
            }
        }
        fclose($handle);
    }

    if (($handle = fopen($villeFile, "r")) !== FALSE) {
        fgetcsv($handle, 1000, ",");
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $codeDep = $data[3];
            $codeRegion = $data[2];
            $nomVille = $data[9];

            if (isset($regions[$codeRegion]["departements"][$codeDep])) {
                $regions[$codeRegion]["departements"][$codeDep]["villes"][] = $nomVille;
            }
        }
        fclose($handle);
    }

    return $regions;
}

 
function getFormDepartement(string $codeReg) {
    $tab = tableauFrance()[$codeReg]["departements"];


    $form = "<form autocomplete='off' action='" . $_SERVER['PHP_SELF'] . "' method='get'>\n"; 
    $form .= "<input type='hidden' name='region' value='$codeReg'>\n"; // Champ caché pour region
    $form .= "<label for='dep'>Choisir un département :</label>\n";
    $form .= "<input list='departements' name='dep' id='dep'>\n";
    $form .= "<datalist id='departements'>\n";

    foreach ($tab as $code => $value) {
        $nomdep = $value['nom'];
        $form .= "<option value='$code'>$nomdep</option>\n"; // Ajout du nom du département comme texte
    }

    $form .= "</datalist>\n";
    $form .= "<input type='submit' value='Rechercher' >\n";
    $form .= "</form>";

    return $form; 
}
function getFormVille(string $codeReg, string $codeDep) {
    $tab = tableauFrance()[$codeReg]["departements"][$codeDep]["villes"];

 
    $form = "<form autocomplete='off' action='" . $_SERVER['PHP_SELF'] . "' method='get'>\n";
    $form .= "<input type='hidden' name='region' value='$codeReg'>\n"; 
    $form .= "<input type='hidden' name='dep' value='$codeDep'>\n";    
    $form .= "<label for='ville'>Choisir une ville :</label>\n";
    $form .= "<input list='villes' name='ville' id='ville'>\n";
    $form .= "<datalist id='villes'>\n";

    foreach ($tab as $ville) {
        $form .= "<option value='$ville'>$ville</option>\n";  
    }

    $form .= "</datalist>\n";
    $form .= "<input type='submit' value='Afficher météo'>\n";
    $form .= "</form>";

    return $form; 
}

function getMeteo($ville,$longitude,$latitude){
	$urlMeteo = "https://api.open-meteo.com/v1/forecast?latitude=".$latitude."&longitude=".$longitude."&current_weather=true";
	$meteoData = json_decode(file_get_contents($urlMeteo), true);

	if (isset($meteoData['current_weather'])) {
		$temperature = $meteoData['current_weather']['temperature'];
		$meteo = "<span>Il fait $temperature C° à $ville  ";
		return $meteo;

	}


}

function getLatitude($ville){
	$url = "https://geo.api.gouv.fr/communes?nom=" . urlencode($ville) . "&fields=centre&format=json";
	$reponse = file_get_contents($url);
	$data = json_decode($reponse,true);
	if(!empty($data)){
		return $data[0]['centre']['coordinates'][1];
	}
}

function getLongitude($ville){
	$url = "https://geo.api.gouv.fr/communes?nom=" . urlencode($ville) . "&fields=centre&format=json";
	$reponse = file_get_contents($url);
	$data = json_decode($reponse,true);
	if(!empty($data)){
		return $data[0]['centre']['coordinates'][0];
	}
}

function putVillesConsultees($ville){
	$villesConsulteFile = "CSV/VillesConsultes.csv";
	if (($handle = fopen($villesConsulteFile, "a")) !== FALSE) {
   	fputcsv($handle, [$ville]);
    	fclose($handle);
   } 
}

function getNombreVillesConsultees(){
	$villesConsulteFile = "CSV/VillesConsultes.csv";
	$villes = [];
	if(($handle = fopen($villesConsulteFile,"r")) !== FALSE){
		fgetcsv($handle, 1000, ",");
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			
			$ville = $data[0];
			if($ville != ''){
				if(array_key_exists($ville, $villes)){
					$villes[$ville] = $villes[$ville] + 1;
				}
				else{
					$villes[$ville] = 1;			
				}	
			}
		}
		fclose($handle);
		return $villes;
	}

}




function getDerniereVilleCons(){
	if(isset($_COOKIE['DerniereVilleCons'])){
		$ville = $_COOKIE['DerniereVilleCons'];
		return "<span> La dernière ville que vous avez consulté est $ville ";	
	}
	else{
		return "<span> Vous n'avez consulté aucune récemment";	
	}
}

function modifCookie(){
	if(isset($_GET['ville'])){
		$ville = $_GET['ville'];
		setcookie('DerniereVilleCons',$ville);	
	}
}

function villesPlusConsultees(){
	$tab = getNombreVillesConsultees();
	$villeTop5 = [];
	//prendre les 10 villes les plus consultées
	$i = 0;
	if(!empty($tab)){
		while($i<5 && max($tab)!=0) {
			$max =  max($tab);
			$ville = array_search($max,$tab);
			unset($tab[$ville]);//supprime la ville avec le plus de consultations
			$villeTop5[$ville] = $max;
			$i++;
		}
	}
	return $villeTop5;
}

function histogrammeAffichage(){
	$villes = villesPlusConsultees();
	$max = max($villes);
	$histogramme = "<div id='histogramme'>";
	foreach($villes as $ville => $nb){
		$height = ($nb/$max)*100;
		$histogramme.= "\n<div class='bar' style='height: {$height}%;'>";
		$histogramme.="\n\t<span>$ville</span>\n</div>";
	}
	return $histogramme."</div>";
}

	
?>
		