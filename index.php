<?php
// GENERADOR DE LA IMAGEN
$text = @preg_replace("/[^a-zA-Z0-9ñÑ\s\-\,\.]+/", "", $_POST["name"]);
//$twitter = $_POST["twitteo"];
$transparent = @preg_replace("/[^a-zA-Z]+/", "", $_POST["transparente"]);
$font = __DIR__."/fonts/aldo.ttf";
$size = 48;
$bbox = imageftbbox($size, 0, $font, $text);

$width  = ($bbox[2] - $bbox[6]) + 18;
$height = 98;

$img   = imagecreatetruecolor($width, $height);
$trans = imagecolorallocatealpha($img, 0, 0, 0, 127);
$white = imagecolorallocate($img, 255, 255, 255);
$blue = imagecolorallocate($img, 14, 45, 110);

if(isset($transparent) && $transparent == "TRUE"){
	imagealphablending($img, false);
	imagefill($img, 0, 0, $trans);
	imagecolortransparent($img, $trans);
	
}else{
	imagealphablending($img, true);
	imagefill($img, 0, 0, $white);
}

// Guardamos los cambios del alpha blending
imagesavealpha($img, true);

// Creamos el texto a partir del parametro recibido en POST
imagettftext($img, $size, 0, 0.5, 72, $blue, $font, $text);

// EL GLOBITO DEL LOGO DE ANTEL
$globo = imagecreatefrompng("globo.png");
$globoWidth = imagesx($globo);
$globoHeigth = imagesy($globo);

// Juntamos el globito con el texto
imagecopy($img, $globo, 23, 16, 0, 0, $globoWidth, $globoHeigth);

// MOSTRAR LA IMAGEN FINAL
ob_start();
imagepng($img);
imagedestroy($img);
$imgbase64 = "data:image/png;base64,".base64_encode(ob_get_clean());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="Antel la empresa de comunicaciones de los uruguayos estrena imagen, ahora tu tambien podes tener un logo feo" /> 
		<meta name="keywords" content="logofeo, logo feo, imagen antel, antel, ancel, anteldata" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Antelizate como el logo feo de Antel</title>
	</head>
	<body>
		<div id="contenedor">
		<div id="header">
			<img src="encabezado.jpg" alt="Logofeo"/>
		</div>
		<a href=""/><img src="logofeo.png" alt="logofeo"/></a>
		<h1>Ahora podes tener el mismo logo feo que ANTEL</h1>
		<p>Tener tu logofeo nunca fue tan fácil como ahora, con nuestro antelizador.</p>
	
		<div id="formulario">
		<form id="formfondo" method="post" action="index.php">
			<p class="formlabel">Introduzca su texto
			<input type="text" name="name" />
			<input type="submit" value="Antelizalo" /><br />
			<!--<input type="checkbox" name="twitteo" value="1" />Twittear mi logo! (Con la cuenta @logofeo, no necesitas tu usuario)-->
			<p class="formlabel"><input type="checkbox" name="transparente" id="transparente" value="TRUE" />Clic si desea que tenga fondo transparente</p></p>
		</form>
		</div>
		
		<div id="logofeo">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<img src="<?php echo (isset($_POST['name'])) ? $imgbase64 : "logofeo.png" ?>" />
		</div>
		
		<p>Reconstrucción hecha por MatyGamingHD</p>
	</body>
</html>