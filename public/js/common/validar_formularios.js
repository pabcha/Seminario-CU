/*
 * [validar_correo validar que el correo sea correcto]
 * @param  {object} input_obj       [objeto input]
 * @param  {boolean} requerido=false [si el campo es requerido]
 * @return {string}                 [retorna una cadena con el mensaje de error o no]
 */

/*function sayHola(texto){
	alert(texto);
	return texto +' evaluado';
}

function sayHola2 (argument,requerido) {
	requerido = (requerido) ? requerido : false;
	requerido || (requerido = false);//definiendo parametro opcional
	return argument + ' ' + String(requerido);
}*/

function validar_correo(input_obj, requerido){
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;

	if ( input_obj.val().length == 0 && requerido == true ) {
		string = string + 'El correo es un campo requerido.';
		flag   = true;
	} else if ( requerido || input_obj.val().length != 0 ) {
		if( !input_obj.val().match(/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i) ){//NO es mail valido
			string = string + 'Debe ingresar un correo valido.';
			flag   = true;
		};
		string = string + '</li>';
	}
	
	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}
function validar_pass( input_obj, requerido) {
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag = false;
	
	if (requerido == true || input_obj.val().length > 0) {
		if ( input_obj.val().length < 4 || input_obj.val().length > 12 ) {
			flag = true;
			string = string + 'El password debe contener minimo 4 caracteres, máximo 12 caracteres.';				
		}else if ( !input_obj.val().match(/^[0-9a-zA-Z]+$/) ) {
			flag   = true;
			string = string + 'El password debe contener minimo 4 caracteres, máximo 12 caracteres. Letras y números.';
		}		
	};
	string = string + '</li>';	

	if (flag == true) {//Hubo errores		
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}
function validar_texto (input_obj, campo, requerido) {
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;

	if ( input_obj.val().length == 0 && requerido == true ) {
		string = string + 'El '+ String(campo) +' es un campo requerido.';
		flag   = true;
	} else if ( requerido || input_obj.val().length != 0 ) {
		if( !input_obj.val().match(/^[a-zA-Z ]+$/) ){//NO es nombre valido
			string = string + 'Debe ingresar un '+ String(campo) +' valido.';
			flag   = true;
		};
		string = string + '</li>';
	}

	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}
function validar_DNI (input_obj, requerido) {
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;

	if ( input_obj.val().length == 0 && requerido == true ) {
		string = string + 'El DNI es un campo requerido.';
		flag   = true;
	} else if ( requerido || input_obj.val().length != 0 ) {
		if( input_obj.val().length < 0 && input_obj.val().length > 8 ){//NO es DNI valido
			string = string + 'Debe ingresar un DNI valido.';
			flag   = true;
		};
		string = string + '</li>';
	}

	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}
function validar_domicilio (input_obj, requerido) {
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;

	if ( input_obj.val().length == 0 && requerido == true ) {
		string = string + 'El domicilio es un campo requerido.';
		flag   = true;
	} else if ( requerido || input_obj.val().length != 0 ) {
		if( !input_obj.val().match(/^[a-zA-Z ]+[0-9]+$/) ){
			string = string + 'Debe ingresar un domicilio valido.';
			flag   = true;
		};
		string = string + '</li>';
	}

	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}
function validar_CP(input_obj, requerido) {
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;

	if ( input_obj.val().length == 0 && requerido == true ) {
		string = string + 'El codigo postal es un campo requerido.';
		flag   = true;
	} else if ( requerido || input_obj.val().length != 0 ) {
		if( !input_obj.val().match(/^[0-9]{4}$/) ){
			string = string + 'Debe ingresar un codigo postal valido.';
			flag   = true;
		};
		string = string + '</li>';
	}

	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}
function validar_telefono (input_obj, requerido) {
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;

	if ( input_obj.val().length == 0 && requerido == true ) {
		string = string + 'El telefono es un campo requerido.';
		flag   = true;
	} else if ( requerido || input_obj.val().length != 0 ) {
		if( !input_obj.val().match(/^(\d{2,4} )?(\d{6,10})$/) ){
			string = string + 'Debe ingresar un telefono valido. xxxx xxxxxx o telefono movil: xxxx 15xxxxxx. El codigo de area opcional.';
			flag   = true;
		};
		string = string + '</li>';
	}

	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}
function validar_url (input_obj, requerido) {
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;

	if ( input_obj.val().length == 0 && requerido == true ) {
		string = string + 'La url es un campo requerido.';
		flag   = true;
	} else if ( requerido || input_obj.val().length != 0 ) {
		if( !input_obj.val().match(/^(ht|f)tp(s?)\:\/\/[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*(:(0-9)*)*(\/?)( [a-zA-Z0-9\-\.\?\,\'\/\\\+&%\$#_]*)?$/) ){
			string = string + 'Debe ingresar una url valida.http://www.xxxx.com';
			flag   = true;
		};
		string = string + '</li>';
	}

	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}
function validar_igual (input_obj,input_obj2) {
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;

	if( input_obj.val().length != 0 || input_obj2.val().length != 0 ) {
		if ( input_obj.val() != input_obj2.val() ) {
			string = string + 'Los passwords deben coincidir.';
			flag   = true;
		}
	}
	
	string = string + '</li>';

	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}
function validar_departamento (input_obj, requerido) {
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;

	if ( input_obj.val().length == 0 && requerido == true ) {
		string = string + 'El departamento es un campo requerido.';
		flag   = true;
	} else if ( requerido || input_obj.val().length != 0 ) {
		if( !input_obj.val().match(/^[a-zA-Z0-9 ]+$/) ){
			string = string + 'Debe ingresar un departamento valido.';
			flag   = true;
		};
		string = string + '</li>';
	}

	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}
function validar_descripcion (input_obj, descripcion, requerido) {
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;

	if ( input_obj.val().length == 0 && requerido == true ) {
		string = string + 'El campo ' +descripcion+' es un campo requerido.';
		flag   = true;
	} else if ( requerido || input_obj.val().length != 0 ) {
		if( !input_obj.val().match(/^[^<>{}\[\]\/]+$/) ){
			string = string + 'Sin caracteres especiales.';
			flag   = true;
		};
		string = string + '</li>';
	}

	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}
function validar_num ( input_obj, campo, requerido) {
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;
	
	if ( input_obj.val().length == 0 && requerido == true ) {
		string = string + 'El ' +campo+ ' es un campo requerido.';
		flag   = true;
	} else if ( requerido || input_obj.val().length != 0 ) {
		if( !input_obj.val().match(/^[0-9]$/) ){
			string = string + 'Debe ingresar un/a '+campo+' valido.';
			flag   = true;
		};
		string = string + '</li>';
	}

	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}
function validar_precio ( input_obj, requerido) {
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;
	
	if ( input_obj.val().length == 0 && requerido == true ) {
		string = string + 'El precio es un campo requerido.';
		flag   = true;
	} else if ( requerido || input_obj.val().length != 0 ) {
		if( !input_obj.val().match(/^[0-9]+.[0-9]+$/) ){
			string = string + 'Debe ingresar un precio valido. Ejemplo: 10.00,150,875.75';
			flag   = true;
		};
		string = string + '</li>';
	}

	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}

function validar_texto_numeros (input_obj, campo, requerido) {
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;

	if ( input_obj.val().length == 0 && requerido == true ) {
		string = string + 'El '+ String(campo) +' es un campo requerido.';
		flag   = true;
	} else if ( requerido || input_obj.val().length != 0 ) {
		if( !input_obj.val().match(/^[a-zA-Z0-9 ]+$/) ){//NO es nombre valido
			string = string + 'Debe ingresar un '+ String(campo) +' valido.';
			flag   = true;
		};
		string = string + '</li>';
	}

	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}
function validar_radio_buttons (input_obj, campo, requerido) {
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;

	if ( input_obj.val().length == 0 && requerido == true ) {
		string = string + 'El/La '+ String(campo) +' es un campo requerido.';
		flag   = true;
	}
	string = string + '</li>';
	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}
function validar_select (input_obj, campo, requerido) {
	requerido || (requerido = false );
	var string = '<li><i class="icon-remove"></i>';
	var flag   = false;

	if ( input_obj.val().length == 0 && requerido == true ) {
		string = string + 'El/La '+ String(campo) +' es un campo requerido.';
		flag   = true;
	}
	string = string + '</li>';
	if (flag==true) {//Hubo errores
		return string;
	}else {//No hubo errores
		string = '';
		return string;
	};
}