<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?= App\Helpers\Vista::loadTitle($this->titulo) ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="<?= $roots['css'] ?>vendor/bootstrap.min.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>vendor/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?= $roots['css'] ?>vendor/font-awesome/font-awesome.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
	<link href="<?= $roots['css'] ?>front/estilos_comercio.css" rel="stylesheet">

	<?= App\Helpers\Vista::loadCss( $styles ) ?>
	
	<script src="<?= $roots['js'] ?>vendor/jquery-1.8.2.min.js"></script>
	<script src="<?= $roots['js'] ?>vendor/bootstrap.min.js"></script>
	<?= App\Helpers\Vista::loadJs( $scripts ) ?>
</head>
<body>