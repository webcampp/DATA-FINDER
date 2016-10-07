<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Buscador de Datos</title>
<link href="css/reset.css" rel="stylesheet" style="text/css" />
<link href="css/main.css" rel="stylesheet" style="text/css" media="screen" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
</head>
<body class="bg_home">
	<div id="container" class="center_home">
		<div class="buscando">
			<h1>Buscando resultados ...</h1>
			<img src="images/load3.gif" alt="load" title="load">
		</div>
		<form action="busca.php" method="post" id="form">
			<fieldset>
				<h1 class="h1_home">Buscador de Datos</h1>
				<input type="text" name="palabra" placeholder="Inserta la lapabra a buscar" required>
				<br>
				<span style="color:red;margin-bottom:10px" class="vacio">Rellena el campo por favor</span>
				<br>
				<ul class="filter">
					<li>
						<span>Ocultar resultados de:</span>
						<input type="checkbox" id="solo_img" name="soloImg">
						<label for="solo_img">im&aacute;genes</label>
					</li>
					<li>
						<input type="checkbox" id="solo_wiki" name="soloWiki">
						<label for="solo_wiki">Wikipedia</label>
					</li>
					<li>
						<input type="checkbox" id="solo_apps" name="soloApps">
						<label for="solo_apps">aplicaciones</label>
					</li>
					<li>
						<input type="checkbox" id="solo_amazon" name="soloAmazon">
						<label for="solo_amazon">Amazon</label>
					</li>
					<li>
						<input type="checkbox" id="solo_youtube" name="soloYoutube">
						<label for="solo_youtube">Youtube</label>
					</li>
				</ul>
				<br>
				<input type="submit" value="Buscar">
			</fieldset>
		</form>
		<footer>&copy; Webcamp.es</footer>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			//miramos que no este el campo vacío
			/*$('.vacio').hide();
			$('.buscando').hide();
			$('input[type="submit"]').click(function(){
				if($('imput[type="text"]').val() == ""){
					$('.vacio').slideDown();
					return false;
				}
				else{
					$('#container form').hide();
					$('body').css('background-color','#fff');
					$('.buscando').show();
				}
			});*/
			$('.vacio').hide();
			$('.buscando').hide();
			$('#form').submit(function(){
				$('#container form').hide();
				$('body').css('background-color','#fff');
				$('.buscando').show();
			});
		});
	</script>
</body>
</html>