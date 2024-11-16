function cargarBotones() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {

            document.getElementById("menu").innerHTML = this.responseText;

        }
    };
    xhttp.open("GET", "botones.html", true);
    xhttp.send();

    var contenedordeBotones = document.getElementById("principal");


    var nuevoTexto = document.createTextNode("Nombre: Martinez Cabezas Bryan Daniel| 111-389");
    contenedordeBotones.innerHTML = '';

    contenedordeBotones.appendChild(nuevoTexto);


    historial(1);

}


function historial(pregunta) {
    if (pregunta == "menu") {
        document.getElementById('historial').innerHTML += `<div> ${pregunta}</div>`
    }
    else {
        document.getElementById('historial').innerHTML += `<div>Pregunta ${pregunta}</div>`
    }

}

function cargarContenido(contenido) {
    var contenedor = document.getElementById('principal');
    if(contenido=="tablas.html"){
        historial(2);
    }
    if(contenido == "listar.php"){
        historial(4)
    }
    if(contenido == "colores.html"){
        historial(5)
    }
    fetch(contenido)
        .then(response => response.text())
        .then(data => contenedor.innerHTML = data)
        .catch(error => console.error('Error:', error));




}





function crearTabla(){
    var contenedortabla= document.getElementById("tablacargada");
    var numero = parseInt(document.getElementById("tabla1").value);
    var rango = parseInt(document.getElementById("tabla2").value);
    var seleccionada= document.getElementsByName("operacion");
    var resul = "";

    for (var i = 1; i <= rango; i++) {
        if (seleccionada[0].checked) {  
            resul += numero + " + " + i + " = " + (numero + i) + "<br>";
        } if (seleccionada[1].checked) {  
            resul += numero + " - " + i + " = " + (numero - i) + "<br>";
        } if (seleccionada[2].checked) { 
            resul += numero + " * " + i + " = " + (numero * i) + "<br>";
        } if (seleccionada[3].checked) { 
            resul += numero + " / " + i + " = " + (numero / i) + "<br>";
        }
    }

    contenedortabla.innerHTML = resul;


}



function ejercicio3(){
    var contenedor;
	contenedor = document.getElementById('principal');
	var ajax = new XMLHttpRequest() //crea el objetov ajax 
	ajax.open("get", 'cargadoDatos.html', true);
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4) {
			contenedor.innerHTML = ajax.responseText;
            mostrarDatos();
		}
	}
	ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
	ajax.send();

    historial(3);
}
contador=0;



function mostrarDatos() {
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "datos.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var libros = JSON.parse(ajax.responseText); 
            var imagenDiv = document.getElementById("imagen");
            imagenDiv.innerHTML = '';
            if (libros.length > 0) {
                imagenDiv.innerHTML = `<img src="images/${libros[0].imagen}" alt="Imagen de ${libros[0].titulo}" width="100">`;
            }
        }
    };
    ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
    ajax.send();
}



c=0;
function actualizarImagen() {
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "datos.php", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var libros = JSON.parse(ajax.responseText); 
            var imagenDiv = document.getElementById("imagen");
            imagenDiv.innerHTML = '';
            if (libros.length > 0 && c<libros.length)  {
                c=c+1
                imagenDiv.innerHTML = `<img src="images/${libros[c].imagen}" alt="Imagen de ${libros[c].titulo}" width="100">`;
            }
        }
    };
    ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
    ajax.send();
}