help = (function(window) {
	/**
	 * Number.prototype.format(n, x, s, c)
	 * 
	 * @param integer n: length of decimal
	 * @param integer x: length of whole part
	 * @param mixed   s: sections delimiter
	 * @param mixed   c: decimal delimiter
	 */
	Number.prototype.format = function(n, x, s, c) {
	    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
	        num = this.toFixed(Math.max(0, ~~n));
	    
	    return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
	};

	/**
	 * Transformar Date yyyy-mm-dd a dd-mm
	 *
	 */
	String.prototype.toDDMM = function () {
		var ddmm = this.split('-');
		return ddmm[2]+'-'+ddmm[1];
	};

	Array.prototype.sum = function () {
		var total = 0;
			
		$.map(this, function (value) {
			total += parseFloat(value);
		});

		return total;
	};

	Array.prototype.pluck = function (property){
		var arr = []
		
		$.map(this, function (value) {
			arr.push( value[property] );
		});

		return arr;
	};


	var mmToEsp = function (mm) {

		switch (mm) {
		    case 1:
		        return "Enero";
		        break;
		    case 2:
		        return "Febrero";
		        break;
		    case 3:
		        return "Marzo";
		        break;
		    case 4:
		        return "Abril";
		        break;
		    case 5:
		        return "Mayo";
		        break;
		    case 6:
		        return "Junio";
		        break;
		    case 7:
		        return "Julio";
		        break;
		    case 8:
		        return "Agosto";
		        break;
		    case 9:
		        return "Septiembre";
		        break;
		    case 10:
		        return "Octubre";
		        break;
		    case 11:
		        return "Noviembre";
		        break;
		    case 12:
		        return "Diciembre";
		        break;
		}
	};

	

	var baseUrl = location.origin + '/saltaShop';

	return {
		baseUrl: baseUrl,
		mmToEsp: mmToEsp
	};

})(window);	
	