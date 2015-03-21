var Catalogo = (function (w) {

	var tableOpt = {
		"oLanguage" : {
			"sLengthMenu" : "Mostrar _MENU_ registros",
			"sZeroRecords" : "No se ha encontrado registros.",
			"sInfo" : "Mostrando _START_ - _END_ de _TOTAL_ registros",
			"sInfoEmpty" : "Mostrando 0 - 0 de 0 registros",
			"sInfoFiltered" : "(de _MAX_ registros)",
			"sSearch": "Buscar:",
			oPaginate : {
				"sLast"		: 		"Ultimo",
				"sFirst"	: 		"Primero",
				"sPrevious"	: 		"Anterior",
				"sNext"		: 		"Siguiente"
			} 						
		},
		"fnDrawCallback": function() {
			$('#tabla-result_length').hide();//entradas por tabla 10/25/50
            $('#tabla-result_info').hide();//cantidad de registros

            if ( $('.dataTables_paginate > ul > li').size() < 4) 
            {
            	$('.dataTables_paginate').hide();
            }
        },
		"sPaginationType": "bootstrap"
	};

	var deleter = function (target, href) {
		$(target).click(function(e)
		{
			e.preventDefault();
			if(confirm("¿Esta seguro de que desea borrar este elemento?"))
			{
				window.location.replace(help.baseUrl + href + $(this).attr('href'));
			}
		});
	};
	
	return {
		tableOpt: tableOpt,
		deleter: deleter
	};
})(window);