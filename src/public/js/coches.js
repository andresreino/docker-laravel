const API_URL = '/api/coches';
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Función para obtener todos los productos y mostrarlos en la vista
async function obtenerCoches() {
    try {
        const respuesta = await fetch(API_URL, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
            },
            credentials: 'same-origin',
        });

        if (!respuesta.ok) {
            throw new Error(`Error: ${respuesta.status} ${respuesta.statusText}`);
        }

        const coches = await respuesta.json();
        mostrarCoches(coches);
    } catch (error) {
        document.getElementById('coches-contenedor').innerHTML = '<p>Error al cargar los coches.</p>';
    }
    irAListado();
}

// Función para mostrar los coches en el contenedor
function mostrarCoches(coches) {
    const contenedor = document.getElementById('coches-contenedor');
    contenedor.innerHTML = `
        <div class="d-flex justify-content-center my-4">
            <div class="spinner-grow text-primary" role="status">
                <span class="visually-hidden">Cargando coches...</span>
            </div>
        </div>
    `;

    if (coches.length === 0) {
        contenedor.innerHTML = '<p class="text-center">No hay coches disponibles.</p>';
        return;
    }

    /// Contenedor con clases de Bootstrap para mostrar cartas en filas
    const fila = document.createElement('div');
    fila.classList.add('row', 'g-3');

    coches.forEach(coche => {
        const columna = document.createElement('div');
        columna.classList.add('col-md-4');

        const carta = document.createElement('div');
        carta.classList.add('card', 'h-100', 'shadow-sm', 'position-relative');

        const cuerpo = document.createElement('div');
        cuerpo.classList.add('card-body');
        cuerpo.style.cursor = 'pointer';
        // Al hacer click sobre esta tarjeta de un Coche rellena los campos del form
        cuerpo.addEventListener('click', () => mostrarDetallesCoche(coche));

        const marca = document.createElement('h5');
        marca.classList.add('card-title');
        marca.textContent = `Marca: ${coche.marca}`;

        const modelo = document.createElement('p');
        modelo.classList.add('card-text');
        modelo.textContent = `Modelo: ${coche.modelo}`;

        const matricula = document.createElement('p');
        matricula.classList.add('card-text');
        matricula.textContent = `Matrícula: ${coche.matricula}`;

        // Icono de papelera sin botón
        const iconoEliminar = document.createElement('i');
        iconoEliminar.classList.add('bi', 'bi-trash', 'text-danger', 'position-absolute');
        iconoEliminar.style.top = '0.5rem';
        iconoEliminar.style.right = '0.5rem';
        iconoEliminar.style.cursor = 'pointer';
        iconoEliminar.title = 'Eliminar coche';

        iconoEliminar.addEventListener('click', (e) => {
            e.stopPropagation(); // Evita que se active el clic en la carta
            borrarCoche(coche.id);
        });

        cuerpo.appendChild(marca);
        cuerpo.appendChild(modelo);
        cuerpo.appendChild(matricula);
        carta.appendChild(cuerpo);
        carta.appendChild(iconoEliminar);
        columna.appendChild(carta);
        fila.appendChild(columna);
    });

    contenedor.innerHTML = '';
    contenedor.appendChild(fila);

}

// Función para mostrar los detalles de un coche en el contenedor de detalles
function mostrarDetallesCoche(coche) {
    // Rellenar el formulario para actualizar y mostrar
    document.getElementById('coche_id').value = coche.id;
    document.getElementById('marca').value = coche.marca;
    document.getElementById('modelo').value = coche.modelo;
    document.getElementById('matricula').value = coche.matricula;
    irACoche();
}

// Función para manejar el envío del formulario (crear o actualizar coche)
document.getElementById('coche-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const id = document.getElementById('coche_id').value;
    const marca = document.getElementById('marca').value;
    const modelo = document.getElementById('modelo').value;
    const matricula = document.getElementById('matricula').value;

    const datos = { marca, modelo, matricula };

    try {
        const respuesta = await fetch(id ? `${API_URL}/${id}` : API_URL, {
            method: id ? 'PUT' : 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
            },
            credentials: 'same-origin',
            body: JSON.stringify(datos),
        });

        if (!respuesta.ok) {
            throw new Error(`${respuesta.status} ${respuesta.statusText}`);
        }
        // Limpiar div-error por si había error anterior guardado en él
        document.getElementById('div-error').innerText = '';

        // Reiniciar el formulario y recargar los productos
        document.getElementById('coche-form').reset();
        document.getElementById('coche_id').value = '';
        obtenerCoches();
    } catch (error) {
        const divError = document.getElementById('div-error');
        divError.innerHTML = '<p class="text-center">Error al guardar el coche-> ' + error + '</p>';
    }
});

// Función para borrar un coche
async function borrarCoche(id) {
    if (!confirm('¿Estás seguro de que deseas eliminar este coche?')) return;

    try {
        const respuesta = await fetch(`${API_URL}/${id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
            },
            credentials: 'same-origin',
        });

        if (!respuesta.ok) {
            throw new Error(`Error: ${respuesta.status} ${respuesta.statusText}`);
        }

        console.log(`Coche con ID ${id} eliminado.`);
        obtenerCoches();
    } catch (error) {
        const divError = document.getElementById('div-error');
        divError.innerHTML = '<p class="text-center">Error al eliminar el coche-> ' + error + '</p>';
    }
}

// Hace scroll hasta la sección indicada para que usuario la vea
function irACoche() {
    const seccion = document.getElementById('detalles-coche');
    if (seccion) {
        seccion.scrollIntoView({ behavior: 'smooth' });
    }
}

// Hace scroll hasta la sección indicada para que usuario la vea
function irAListado() {
    const seccion = document.getElementById('coches-contenedor');
    if (seccion) {
        seccion.scrollIntoView({ behavior: 'smooth' });
    }
}

// Llama a la función para cargar la página
document.addEventListener('DOMContentLoaded', init);

function init()
{
    obtenerCoches();
    document.getElementById('limpiar-formulario').addEventListener('click', () => {
        document.getElementById('coche-form').reset();
        document.getElementById('coche_id').value = '';
    });
}