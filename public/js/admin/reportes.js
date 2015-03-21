var reporte = {
	chartOptions: {
	    chart: {
	        renderTo: 'graphic',
	        type: 'line'
	    },

	    credits: {
            enabled: false
        },

	    title: {
	        text: ''
	    },

	    tooltip: {
			useHTML: true,
	        formatter: function () {
	        	var y = this.y.format(2, 3, '.', ',');

	            return '<small>'+this.x+'</small><table>' 
	            	+ '<tr><td style="color: ' + this.series.color + '">'
	            	+ this.series.name + ': </td>'
	            	+ '<td style="text-align: right"><b>$'
	            	+ y + '</b></td></tr>'
	            	+ '</table>';
	        }
	    },

	    xAxis: {
	    },

	    yAxis: {
	        title: {
	            text: ''
	        },
	        labels: {
	            formatter: function () {					
	            	return '$ ' + this.value.format(2, 3, '.', ',');
	            }
	        },
	        min: 0
	    },

	    plotOptions: {
	    	line: {
	    		lineWidth: 3,
	    	}
	    },

	    legend: {
            enabled: false
        },

	    exporting: {
	    	enabled: false,
	    	chartOptions: {
	    		sourceWidth: 650,
                sourceHeight: 400
	    	}
	    },

	    series: [{
	        name: 'Ventas'
	    }]
	},
	urls: {
		day7: help.baseUrl + '/admin/day7',
		month: help.baseUrl + '/admin/month',
		last_month: help.baseUrl + '/admin/last_month',
		year: help.baseUrl + '/admin/year',
	},
	showStatics : function (url) {
		$.getJSON(url, function(data) {

			var fechas = [],
				total_ventas = [],
				cantidad_ordenes = [],
				cantidad_vendida = [],
				result,
				avg;

			$.map(data, function (value) {
				fechas.push( value.fecha.toDDMM() );
				total_ventas.push( parseFloat(value.total_ventas) );
				cantidad_ordenes.push( parseInt(value.cantidad_ordenes) );
				cantidad_vendida.push( parseInt(value.cantidad_vendida) );
			});

			reporte.captureData('.cantidadOrdenes', cantidad_ordenes);//para armar los reportes
			reporte.captureData('.cantidadVendida', cantidad_vendida);

			var totalD = total_ventas.sum();
			var avg = (totalD / data.length);
			var cantOrdenesD = cantidad_ordenes.sum();
			var cantVendidaD = cantidad_vendida.sum();

			reporte.printResults(totalD, avg, cantOrdenesD, cantVendidaD);
			reporte.toForm(totalD, avg, cantOrdenesD, cantVendidaD);

			reporte.chartOptions.xAxis.categories = fechas;
			reporte.chartOptions.series[0].data = total_ventas;

		    var chart = new Highcharts.Chart(reporte.chartOptions);
		});
	},
	showStaticsByYear: function (url) {
		$.getJSON(url, function(data) {

			var fechas = [],
				total_ventas = [],
				cantidad_ordenes = [],
				cantidad_vendida = [];

			$.map(data, function (value) {
				fechas.push(help.mmToEsp( value.fecha ));
				total_ventas.push( parseFloat(value.total_ventas) );
				cantidad_ordenes.push( parseInt(value.cantidad_ordenes) );
				cantidad_vendida.push( parseInt(value.cantidad_vendida) );
			});

			reporte.captureData('.cantidadOrdenes', cantidad_ordenes);
			reporte.captureData('.cantidadVendida', cantidad_vendida);

			var totalD = total_ventas.sum();
			var avg = (totalD / data.length);
			var cantOrdenesD = cantidad_ordenes.sum();
			var cantVendidaD = cantidad_vendida.sum();

			reporte.printResults(totalD, avg, cantOrdenesD, cantVendidaD);
			reporte.toForm(totalD, avg, cantOrdenesD, cantVendidaD);

			reporte.chartOptions.xAxis.categories = fechas;
			reporte.chartOptions.series[0].data = total_ventas;

		    var chart = new Highcharts.Chart(reporte.chartOptions);
		});
	},
	init: function () {

		$('#7day').click(function (e) {
			e.preventDefault();
			reporte.activeMe( $(this) );

			$('.title').val("Ultimos 7 dias");
			reporte.showStatics( reporte.urls.day7 );
		});

		$('#month').click(function (e) {
			e.preventDefault();
			reporte.activeMe( $(this) );

			$('.title').val("Este mes");
			reporte.showStatics( reporte.urls.month );
		});

		$('#last_month').click(function (e) {
			e.preventDefault();
			reporte.activeMe( $(this) );

			$('.title').val("Ultimo mes");
			reporte.showStatics( reporte.urls.last_month );
		});

		$('#year').click(function (e) {
			e.preventDefault();
			reporte.activeMe( $(this) );

			$('.title').val("Del año");
			reporte.showStaticsByYear( reporte.urls.year );
		});

		$("#pdfBtn").click(function (e) {
			var chart = $("#graphic").highcharts();

			var canvas = document.createElement('canvas'); // Create an empty canvas
			var svg = chart.getSVG();
			var options = chart.get();
           	var categories = options.categories.join();
           	var seriesY = reporte.getSeries(options).join();

           	window.canvg(canvas, chart.getSVG()); // Render the SVG on the canvas
            var href = canvas.toDataURL('image/png');
          
           	$('#imgSrc').attr('value', href);
            $(".categories").attr("value", categories);
			$(".seriesY").attr("value", seriesY);

			$('#sendImage').submit();
		});

		$('#csvBtn').click(function(e) {
			var chart = $("#graphic").highcharts();
			var options = chart.get();
           	var categories = options.categories.join();
           	var seriesY = reporte.getSeries(options).join();

			$(".categories").attr("value", categories);
			$(".seriesY").attr("value", seriesY);

			$('#getCsv').submit();
		});

		$('.title').val("Ultimos 7 dias");
		reporte.showStatics( reporte.urls.day7 );
	},
	activeMe : function (that) {
		that.parent()
			.addClass('active')
			.siblings()
			.removeClass();
	},
	printResults: function (total, avg, cantOrdenes, cantVendida) {

		$("#ventasT").text( '$ ' + total.format(2, 3, '.', ',') );
		$("#ventasProm").text( '$ '+ avg.format(2, 3, '.', ',') );
		$("#ordersT").text( cantOrdenes );
		$("#productT").text( cantVendida );
	},
	captureData: function (domId, data) {
		var string = data.join();
		$(domId).attr('value', string);
	},
	toForm: function (total, avg, cantOrdenes, cantVendida) {
		$("#totalD").val( total );
		$("#avg").val( avg );
		$("#cantidadOrdenesD").val( cantOrdenes );
		$("#cantidadVendidaD").val( cantVendida );
	},
	getSeries: function (options) {
		var values = [];

		for (var i = 0; i < options.series[0].data.length; i++) 
		{
			values.push( options.series[0].data[i].y );
		};

		return values;
	}
};

$(document).ready( reporte.init );