// Constantes para establecer las rutas y parámetros de comunicación con la API.
const API_PRODUCTOS = '../../app/api/dashboard/productos.php?action=';
const ENDPOINT_CATEGORIAS = '../../app/api/dashboard/categorias.php?action=readAll';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_PRODUCTOS);
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se establece un icono para el estado del producto.
        (row.estado_producto) ? icon = 'visibility' : icon = 'visibility_off';
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td><img src="../../resources/img/productos/${row.imagen_producto}" class="materialboxed" height="100"></td>
                <td>${row.nombre_producto}</td>
                <td>${row.precio_producto}</td>
                <td>${row.nombre_categoria}</td>
                <td>${row.cantidad}</td>
                <td><i class="material-icons">${icon}</i></td>
                <td style="display: flex;">
                    <a href="#" onclick="openUpdateDialog(${row.id_producto})" class="btn waves-effect blue tooltipped" data-tooltip="Actualizar"><i class="material-icons">mode_edit</i></a>
                    <a href="#" onclick="openDeleteDialog(${row.id_producto})" class="btn waves-effect red tooltipped" data-tooltip="Eliminar"><i class="material-icons">delete</i></a>
                    <a href="#" onclick="updateQuantityDialog(${row.id_producto}, ${row.cantidad})" class="btn waves-effect cyan lighten-1 tooltipped" data-tooltip="Agregar Cantidad"><i class="material-icons">exposure_plus_1</i></a>
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
    // Se inicializa el componente Material Box asignado a las imagenes para que funcione el efecto Lightbox.
    M.Materialbox.init(document.querySelectorAll('.materialboxed'));
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_PRODUCTOS, 'search-form');
});

// Función para preparar el formulario al momento de insertar un registro.
function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Crear producto';
    // Se establece el campo de archivo como obligatorio.
    document.getElementById('archivo_producto').required = true;
    // Se llama a la función que llena el select del formulario. Se encuentra en el archivo components.js
    fillSelect(ENDPOINT_CATEGORIAS, 'categoria_producto', null);
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Actualizar producto';
    // Se establece el campo de archivo como opcional.
    document.getElementById('archivo_producto').required = false;

    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_producto', id);

    fetch(API_PRODUCTOS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_producto').value = response.dataset.id_producto;
                    document.getElementById('nombre_producto').value = response.dataset.nombre_producto;
                    document.getElementById('precio_producto').value = response.dataset.precio_producto;
                    document.getElementById('descripcion_producto').value = response.dataset.descripcion_producto;
                    document.getElementById('cantidad').value = response.dataset.cantidad;
                    fillSelect(ENDPOINT_CATEGORIAS, 'categoria_producto', response.dataset.id_categoria);
                    if (response.dataset.estado_producto) {
                        document.getElementById('estado_producto').checked = true;
                    } else {
                        document.getElementById('estado_producto').checked = false;
                    }
                    // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
                    M.updateTextFields();
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

// Función para preparar el formulario al momento de modificar la cantidad de un producto.
function updateQuantityDialog(id, cantidad){
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('cantidad-modal'));
    instance.open();

    //Asignando valores para poder funcionar
    document.getElementById('id_producto2').value = id;
    document.getElementById('contador').textContent = 1;
    document.getElementById('cantidadOriginal').value = cantidad;

}

//Metodo que se ejecuta al presionar el boton menos.
document.getElementById('menos').addEventListener('click',function(event){
    //Se evita recargar la pagina
    event.preventDefault();
    //Se convierte a entero el valor del contador.
    var contador = parseInt(document.getElementById('contador').textContent);
    //Se resta una unidad
    contador--;

    //Se valida que el contador no llegue hasta 0;
    if (contador == 0) {
        sweetAlert(2, 'El contador no puede llegar a 0.',null);
        document.getElementById('contador').textContent = 1;
    } else {
        document.getElementById('contador').textContent = contador;
    }
});

//Metodo que se ejecuta al presionar el boton mas.
document.getElementById('mas').addEventListener('click',function(event){
    //Se evita recargar la pagina
    event.preventDefault();
    //Se convierte a entero el valor del contador.
    var contador = parseInt(document.getElementById('contador').textContent);
    //Se suma una unidad
    contador++;
    //Se asigna el valor al contador.   
    document.getElementById('contador').textContent = contador;

});

// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    if (document.getElementById('id_producto').value) {
        action = 'update';
    } else {
        action = 'create';
    }
    saveRow(API_PRODUCTOS, action, 'save-form', 'save-modal');
});

// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('cantidad-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Calculos
    var nuevaCantidad = parseInt(document.getElementById('contador').textContent);
    var cantidadActual = parseInt(document.getElementById('cantidadOriginal').value);
    var suma = nuevaCantidad + cantidadActual;
    //Asignando el resultado a un input invisible para hacer la actualización.
    document.getElementById('cantidadNueva').value = suma;
    //Actualización
    saveRow(API_PRODUCTOS, 'updateCantidad', 'cantidad-form', 'cantidad-modal');
});

// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_producto', id);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_PRODUCTOS, data);
}