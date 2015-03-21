<p>Bienvenido estas logeado</p>
<?php 
	echo Session::get('usuario')['nombre'].'   ';
	echo Session::get('usuario')['apellido'].'   ';
	echo Session::get('usuario')['correo'].'   '; 
 ?>

 