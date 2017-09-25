var lib = {

	Evento : function(elemento, nomevento, fnc) {

		if (elemento.addEventListener) {

			elemento.addEventListener(nomevento, fnc, false);

		} else if (elemento.attachEvent) {

			elemento.attachEvent('on' + nomevento, fnc);
		}
	},


	EventoEliminar : function(elemento, nomevento, fnc) {

		if (elemento.removeEventListener) {

			elemento.removeEventListener(nomevento, fnc, false);

		} else if (elemento.detachEvent) {

			elemento.detachEvent('on' + nomevento, fnc);
		}
	},


	cssComputado : function(obj, styleProp, psElem) {

	    if (obj == null) { return 0; }

	    if (window.getComputedStyle) {

	        var pseudoElem = psElem || null;
	        var valor = window.getComputedStyle(obj, pseudoElem)[styleProp];

	    } else if (obj.currentStyle) {

	        var valor = (/(em|%)/.test(obj.currentStyle[styleProp])) ? lib.cssComputadoIE8Pixel(obj, styleProp) : obj.currentStyle[styleProp];
	    }

	    return valor;
	},


	cssComputadoIE8Pixel : function(elem, prop) {

	    var value = elem.currentStyle[prop] || 0;
	    var Copy = elem.style.left;
	    var runtimeCopy = elem.runtimeStyle.left;

	    elem.runtimeStyle.left = elem.currentStyle.left;
	    elem.style.left = (prop === "fontSize") ? "1em" : value;
	    value = elem.style.pixelLeft + "px";

	    elem.style.left = Copy;
	    elem.runtimeStyle.left = runtimeCopy;

	    return value;
	},


	posicionScroll : function() {

		var scrollHorizontal = (window.pageXOffset !== undefined) ? window.pageXOffset : (document.documentElement || document.body.parentNode || document.body).scrollLeft;
		var scrollVertical = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;

		return {topScroll : scrollVertical, leftScroll : scrollHorizontal};
	}

};



var scrllInfinite = {

// ===============valores que se pueden editar=================

	peticionURL : 'infiniteScroll.php',
	<?php $registrosInicio = 6;?> // cantidad de registros a mostrar de inicio
	registrosAtraer : 8s c, // cantidad de registros que se mostrarán a cada limite de scroll
	velocidadScroll : 0.6, // velocidad con la que se realizará el scroll automático - rango de valores (0.1 - 1.5). siendo 0.1 la velocidad más alta
	empiezaDeceleracion : 400, // px que restan hasta alcanzar el objeto en el scroll automático. una vez que la diferencia es menor a la indicada, empieza la deceleración

// ================================

	h_client : document.documentElement.clientHeight,
	nuevaPeticion : 0,



	inicia : function() {

		scrllInfinite.cargar();
		lib.Evento(window, 'scroll', scrllInfinite.posScroll);
		lib.Evento(window, 'unload', scrllInfinite.posScrollBack);
	},






	cargar : function() {

		if (sessionStorage.getItem('inicio') == null) {

	<?php
	$mysqli = @new mysqli("localhost", "root", "", "CatBank");


	if ($mysqli->connect_errno) {
	 
	    die();
	}


	$cadena = "SELECT Descripcion FROM Alerta ORDER BY Id ASC LIMIT $registrosInicio";
        $cadena2 = "SELECT COUNT(Id) AS cantidad FROM Alerta";

	$cantidad_registros = $mysqli->query($cadena2);
	$filas = $cantidad_registros->fetch_array(MYSQLI_ASSOC);
	$total_registros = intval($filas['cantidad']);

	$resultado = $mysqli->query($cadena);
	$i = 0;
	while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) {

		$n_data["imgThumb"][$i] = '<div><img src="'.$row["imgThumb"].'" alt="" /></div>';
		$i++;
	}

	$resultado->free();
	$mysqli->close();
	?>

			imgInicio = <?php echo json_encode($n_data); ?>;

			for (i in imgInicio['imgThumb']) {

				document.getElementById('contenedorImagenes').innerHTML += imgInicio['imgThumb'][i];
			}

			sessionStorage.setItem('totalRegistros', parseInt(<?php echo $total_registros; ?>, 10));

			sessionStorage.setItem('inicio', parseInt(imgInicio['imgThumb'].length, 10));

			scrllInfinite.nuevaPeticion = scrllInfinite.h_client + (parseInt(lib.cssComputado(document.getElementById('contenedorImagenes').childNodes[0], 'height'), 10) * 2);

		} else {

			var listartodos = parseInt(sessionStorage.getItem('inicio'), 10);
			sessionStorage.setItem('inicio', 0);

			scrllInfinite.peticionRegistros(listartodos);
			lib.EventoEliminar(window, 'scroll', scrllInfinite.posScroll);
					
		}

	},





	posScroll : function() {

		var pos = lib.posicionScroll();
		var posicionY = pos.topScroll;

		scrllInfinite.iniciaPeticionRegistros(posicionY);
	},






	posScrollBack : function() {

		var pos = lib.posicionScroll();
		var posicionY = pos.topScroll;

		if (posicionY != 0) {
			sessionStorage.setItem('posicionScroll', posicionY);
		}
	},






	iniciaPeticionRegistros : function(posicionTop) {

		var h_scroll = document.documentElement.scrollHeight;

		if (scrllInfinite.nuevaPeticion >= parseInt(h_scroll - posicionTop, 10)) {

			if (sessionStorage.getItem('posicionScroll') == null) {

				lib.EventoEliminar(window, 'scroll', scrllInfinite.posScroll);
				scrllInfinite.peticionRegistros(scrllInfinite.registrosAtraer);

			} 

		}
	},






	peticionRegistros : function(r) {

		if (parseInt(sessionStorage.getItem('inicio'), 10) >= parseInt(sessionStorage.getItem('totalRegistros'), 10)) {

			sessionStorage.setItem('posicionScroll', sessionStorage.getItem('posicionScroll'));
			return;
		}

		var peticion = 'inicia=' + parseInt(sessionStorage.getItem('inicio'), 10) + '&cuantos=' + parseInt(r, 10);

		var ajax = new XMLHttpRequest();

		ajax.open('POST', scrllInfinite.peticionURL, true);
		ajax.onreadystatechange = function() {

			if (ajax.readyState == 4) {

				if(ajax.status == 200) {

					var datos = ajax.responseText.replace(/<(?=!-|script)[^>]+>/g,'');

					document.getElementById('contenedorImagenes').innerHTML += datos;

					if (parseInt(sessionStorage.getItem('inicio'), 10) == 0 && parseInt(sessionStorage.getItem('posicionScroll'), 10) >= 1) {

						scrllInfinite.scroleaPagina();
					}


					sessionStorage.setItem('inicio', parseInt(sessionStorage.getItem('inicio'), 10) + parseInt(r, 10));
					lib.Evento(window, 'scroll', scrllInfinite.posScroll);
					ajax.abort();
					ajax=null;
				}
			}
		}
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded", true);	
		ajax.send(peticion);
	    return;
	},






	scroleaPagina : function() {

		var empieza = new Date().getTime();
		var actT = 0;
		var offsetTop = parseInt(sessionStorage.getItem('posicionScroll'), 10);
		sessionStorage.removeItem('posicionScroll');
		var controlaVelocidad =  parseInt(offsetTop * scrllInfinite.velocidadScroll, 10);
		var intervalo = false;
		var scrll = 0;
		var scrll2 = 0;


		(function scrolea() {

			setTimeout(function() {

				var ahora = new Date().getTime();

				if ((ahora - empieza) < controlaVelocidad && (offsetTop - scrll) > scrllInfinite.empiezaDeceleracion) {

					var avance = ((ahora - empieza) / controlaVelocidad);
					scrll = Math.ceil(actT + ((offsetTop - actT) * avance));
					window.scrollTo(0, scrll);
					scrolea();

				} else {

					var empieza2 = new Date().getTime();

					(function decelera() {

						setTimeout(function() {

							var ahora2 = new Date().getTime();

							if ((ahora2 - empieza2) < (scrllInfinite.empiezaDeceleracion * 3)) {

								var avance2 = ((ahora2 - empieza2) / (scrllInfinite.empiezaDeceleracion * 3));
								scrll2 = Math.ceil(scrll + ((offsetTop - scrll) * avance2));
								window.scrollTo(0, scrll2);
								decelera();

							} else {

								var avance2 = 1;
								scrll2 = Math.ceil(scrll + ((offsetTop - scrll) * avance2));
								window.scrollTo(0, scrll2);

							}

						}, 1)

					})();

				}


			}, 1);

		})();

	}

};

lib.Evento(window, 'load', scrllInfinite.inicia); // para ie8