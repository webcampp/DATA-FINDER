<?php
// Desactivar toda notificación de error
//error_reporting(0);
//incluimos simple html dom
require_once('simple_html_dom.php');
//creeamos la clase result
class Search{

	public $palabra;

	//construct
	function __construct($p){
		$this->palabra = $p;
	}

}
class Searcher extends Search{

	public $image;
	public $wiki;
	public $play;
	public $amazon;
	public $youtube;

	//construct
	function __construct($i,$w,$pl,$a,$y){
		$this->image = $i;
		$this->wiki = $w;
		$this->play = $pl;
		$this->amazon = $a;
		$this->youtube = $y;
	}

	//función para saber si existe más de una palabra
	public function spacer(){

		//variables apra sustituir espacios en la palabra de búsqueda
		$espacio = " ";
		$guion = "_";
		$porciento = "%20";
		$plus = "+";
		//comprobamos si hay más de una palabra
		if (strpos($p," ") != false) {
			//si existe un espacio, crea:
			$palabraWiki = str_replace($espacio, $guion, $p);
			$palabraPlay = str_replace($espacio, $porciento, $p);
			$palagraGoogle = str_replace($espacio, $plus, $p);
		}

	}

}

//creamos el objeto
$word = new Search($_POST['palabra']);
//
$MyArray = array(
		file_get_html("https://www.google.es/search?q=$palagraGoogle&biw=1366&bih=667&source=lnms&tbm=isch&sa=X&ei=Q79MVL6dLIuvadeugeAF&sqi=2&ved=0CAYQ_AUoAQ"),
		file_get_html("http://es.wikipedia.org/wiki/$palabraWiki"),
		file_get_html("https://play.google.com/store/search?q=$palabraPlay&c=apps"),
		file_get_html("http://www.amazon.es/s/ref=nb_sb_noss/276-0346087-1295903?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&url=search-alias%3Daps&field-keywords=$p"),
		file_get_html("https://www.youtube.com/results?search_query=$palagraGoogle")
	);
$imagenes = new Searcher($MyArray);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Resultados de: <?php echo $palabra; ?></title>
<link href="css/reset.css" rel="stylesheet" style="text/css" />
<link href="css/main.css" rel="stylesheet" style="text/css" media="screen" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="container">
		<h1 class="h1">Resultados de <b><?php echo $palabra; ?></b></h1>
		<div class="content">
			<div class="content_in img">
				<h1>Im&aacute;genes:</h1>
				<ul>
					<?php 
						foreach($i->find('img') as $img)
						//$element es el resultado
							echo "<li class='hidden'><img src='".$img->src."'></li>";
					?>
				</ul>
			</div>
			<div class="content_in wiki">
				<h1>Wikipedia:</h1>
					<?php 
						foreach($w->find('div[class=mw-content-ltr] p') as $wikiResult)
						//$element es el resultado
							echo $wikiResult;
					?>
				</div>
			<div class="content_in play">
				<h1>Google Play:</h1>
				<ul>
					<?php 
						foreach($pl->find('img[class=cover-image]') as $playResult)
						//$element es el resultado
							echo "<li><img src='".$playResult->src."'></li>";
					?>
				</ul>
			</div>
			<div class="content_in amazon">
				<h1>Amazon:</h1>
				<ul>
					<?php 
						foreach($a->find('h3[class=newaps] a') as $amazonResult)
						//$element es el resultado
							echo $amazonResult.'<br>';
					?>
				</ul>
			</div>
			<div class="content_in tube">
				<h1>Youtube:</h1>
				<ul>
					<?php 
						foreach($y->find('div[class=yt-lockup-thumbnail] a') as $youtubeResult)
						//$element es el resultado
							//$v = $youtubeResult->href;
							//$rest = substr("abcdef", -3, -1); // devuelve "de"
							//$rest = substr($v, -9, 0);
							//$vid = substr($youtubeResult->href, -11);
							echo '<li><iframe width="200" height="130" src="//www.youtube.com/embed/'.substr($youtubeResult->href, -11).'" frameborder="0" allowfullscreen></iframe></li>';
					?>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>