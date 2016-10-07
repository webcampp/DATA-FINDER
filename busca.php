<?php
// Desactivar toda notificación de error
error_reporting(0);
//incluimos simple html dom
require_once('simple_html_dom.php');
//variable a buscar
$palabra = ucwords($_POST['palabra']);
//variables apra sustituir espacios en la palabra de búsqueda
$espacio = " ";
$guion = "_";
$porciento = "%20";
$plus = "+";
//comprobamos si hay más de una palabra
if (strpos($palabra," ") != false) {
	//si existe un espacio, crea:
	$palabraWiki = str_replace($espacio, $guion, $palabra);
	$palabraPlay = str_replace($espacio, $porciento, $palabra);
	$palagraGoogle = str_replace($espacio, $plus, $palabra);
}
else {
	$palabraWiki = $palabra;
	$palabraPlay = $palabra;
	$palagraGoogle = $palabra;
}
//buscamos el resultado en google imagenes
$image = file_get_html("https://www.google.es/search?q=$palagraGoogle&biw=1366&bih=667&source=lnms&tbm=isch&sa=X&ei=Q79MVL6dLIuvadeugeAF&sqi=2&ved=0CAYQ_AUoAQ");
//wikipedia
if(!isset($_POST["soloWiki"])):
$wiki = file_get_html("http://es.wikipedia.org/wiki/$palabraWiki");
endif;
//google play
if(!isset($_POST["soloApps"])):
$play = file_get_html("https://play.google.com/store/search?q=$palabraPlay&c=apps");
endif;
//app store
//$app = file_get_html("https://itunes.apple.com/es/app/$palabra/");
//amazon
if(!isset($_POST["soloAmazon"])):
$amazon = file_get_html("http://www.amazon.es/s/ref=nb_sb_noss?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&url=search-alias%3Daps&field-keywords=$palagraGoogle");
endif;
//youtube
if(!isset($_POST["soloYoutube"])):
$youtube = file_get_html("https://www.youtube.com/results?search_query=$palagraGoogle");
endif;
//facebook
//$facebook = file_get_html("https://www.facebook.com/$palabra");
//twitter
//$twitter = file_get_html("https://twitter.com/$palabra");

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
<?php
//creamos el fondo de pantalla
foreach($image->find('img') as $imga)
	$imagen = $imga->src;
?>
<body style='background-image:url("<?php echo $imagen; ?>");width:100%;height:100%'>
	<div id="container">
		<h1 class="h1">Resultados de <b><?php echo $palabra; ?></b></h1>
		<p class="volver">
			<a href="index.php">Buscar de nuevo >></a>
		</p>
		<div class="content">
			<?php
				//comprobamos que no exista filtro de búsqueda
				if(!isset($_POST["soloImg"])):
			?>
			<div class="content_in img">
				<h1>Im&aacute;genes:</h1>
				<ul>
					<?php 
						foreach($image->find('img') as $img)
						//$element es el resultado
							if ($img != "") {
								echo "<li class='hidden'><img src='".$img->src."'></li>";
							}
							else
							{
								echo "Sin resultados ...";
							}
					?>
				</ul>
			</div>
			<?php endif; ?>
			<?php
				//comprobamos que no exista filtro de búsqueda
				if(!isset($_POST["soloWiki"])):
			?>
			<div class="content_in wiki">
				<h1>Wikipedia:</h1>
				<?php 
					foreach($wiki->find('div[class=mw-content-ltr] p') as $wikiResult)
					//$element es el resultado
						if ($wikiResult != "") {
							echo $wikiResult;
						}
						else
						{
							echo "Sin resultados ...";
						}
				?>
			</div>
			<?php endif; ?>
			<?php
				//comprobamos que no exista filtro de búsqueda
				if(!isset($_POST["soloApps"])):
			?>
			<div class="content_in play">
				<h1>Google Play:</h1>
				<ul>
					<?php 
						foreach($play->find('img[class=cover-image]') as $playResult)
						//$element es el resultado
							if ($playResult != "") {
								echo "<li><img src='".$playResult->src."'></li>";
							}
							else
							{
								echo "Sin resultados ...";
							}
					?>
				</ul>
			</div>
			<?php endif; ?>
			<?php
				//comprobamos que no exista filtro de búsqueda
				if(!isset($_POST["soloAmazon"])):
			?>
			<div class="content_in amazon">
				<h1>Amazon:</h1>
				<ul>
					<?php 
						foreach($amazon->find('h3[class=newaps] a') as $amazonResult)
						//$element es el resultado
							if ($amazonResult != "") {
								echo $amazonResult.'<br>';
							}
							else
							{
								echo "Sin resultados ...";
							}
					?>
				</ul>
			</div>
			<?php endif; ?>
			<?php
				//comprobamos que no exista filtro de búsqueda
				if(!isset($_POST["soloYoutube"])):
			?>
			<div class="content_in tube">
				<h1>Youtube:</h1>
				<ul>
					<?php 
						foreach($youtube->find('div[class=yt-lockup-thumbnail] a') as $youtubeResult)
						//$element es el resultado
							//$v = $youtubeResult->href;
							//$rest = substr("abcdef", -3, -1); // devuelve "de"
							//$rest = substr($v, -9, 0);
							//$vid = substr($youtubeResult->href, -11);
							if ($youtubeResult != "") {
								echo '<li><iframe width="200" height="130" src="//www.youtube.com/embed/'.substr($youtubeResult->href, -11).'" frameborder="0" allowfullscreen></iframe></li>';
							}
							else
							{
								echo "Sin resultados ...";
							}
					?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
	</div>
</body>
</html>