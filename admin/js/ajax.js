function nuevoAjax() {
	var xmlhttp = false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (E) {
			if (!xmlhttp && typeof XMLHttpRequest != 'undefined') xmlhttp = new XMLHttpRequest();
		}
	}
	return xmlhttp;
}

var listadoSelects = new Array();
listadoSelects[0] = "select1";
listadoSelects[1] = "select2";

function buscarEnArray(array, dato) {
	var x = 0;
	while (array[x]) {
		if (array[x] == dato) return x;
		x++;
	}
	return null;
}

function cargaContenido(idSelectOrigen, tablaActual) {
	var posicionSelectDestino = buscarEnArray(listadoSelects, idSelectOrigen) + 1;
	var selectOrigen = document.getElementById(idSelectOrigen);
	var opcionSeleccionada = selectOrigen.options[selectOrigen.selectedIndex].value;
	if (opcionSeleccionada == 0) {
		var x = posicionSelectDestino, selectActual = null;
		while (listadoSelects[x]) {
			selectActual = document.getElementById(listadoSelects[x]);
			selectActual.length = 0;

			var nuevaOpcion = document.createElement("option"); nuevaOpcion.value = 0; nuevaOpcion.innerHTML = "Selecciona Opci&oacute;n...";
			selectActual.appendChild(nuevaOpcion); selectActual.disabled = true;
			x++;
		}
	}
	else if (idSelectOrigen != listadoSelects[listadoSelects.length - 1]) {
		var idSelectDestino = listadoSelects[posicionSelectDestino];
		var selectDestino = document.getElementById(idSelectDestino);
		var ajax = nuevoAjax();
		ajax.open("GET", "select_process.php?select=" + idSelectDestino + "&tabla=" + tablaActual + "&opcion=" + opcionSeleccionada, true);
		ajax.onreadystatechange = function () {
			if (ajax.readyState == 1) {
				selectDestino.length = 0;
				var nuevaOpcion = document.createElement("option"); nuevaOpcion.value = 0; nuevaOpcion.innerHTML = "Cargando...";
				selectDestino.appendChild(nuevaOpcion); selectDestino.disabled = true;
			}
			if (ajax.readyState == 4) {
				selectDestino.parentNode.innerHTML = ajax.responseText;
			}
		}
		ajax.send(null);
	}
}