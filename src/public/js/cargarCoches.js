// Script que recupera dinámicamente datos de los coches del usuario seleccionado en el select haciendo petición a la API

document.addEventListener('DOMContentLoaded', function () {
    const clienteSelect = document.getElementById('cliente_id');
    const cocheSelect = document.getElementById('coche_id');

    const cargarCoches = (clienteId, cocheSeleccionado = null) => {
        cocheSelect.innerHTML = '<option value="">Cargando...</option>';

        if (!clienteId) {
            cocheSelect.innerHTML = '<option value="">Selecciona un coche</option>';
            return;
        }

        // Petición de coches de usuario a la API
        // OJO: como petición es a API hay que poner delante de la ruta prefijo /api
        fetch(`/api/coches-de-cliente/${clienteId}`)
            .then(response => response.json())
            .then(data => {
                let options = '';
                if (data.length === 0) {
                    options = '<option value="">Este cliente no tiene coches registrados</option>';
                } else {
                    options = '<option value="">Selecciona un coche</option>';
                    data.forEach(coche => {
                        const selected = coche.id == cocheSeleccionado ? 'selected' : '';
                        options += `<option value="${coche.id}" ${selected}>${coche.marca} ${coche.modelo} - ${coche.matricula}</option>`;
                    });
                }
                cocheSelect.innerHTML = options;
            })
            .catch(() => {
                cocheSelect.innerHTML = '<option value="">Error al cargar coches</option>';
            });
    };

    // Detectar cambios en el select de clientes
    clienteSelect.addEventListener('change', function () {
        cargarCoches(this.value);
    });

    // Cargar automáticamente si hay cliente y coche preseleccionados
    const clienteIdInicial = clienteSelect.value;
    const cocheIdSeleccionado = cocheSelect.dataset.selected;

    if (clienteIdInicial) {
        cargarCoches(clienteIdInicial, cocheIdSeleccionado);
    }
});









document.addEventListener('DOMContentLoaded', function () {
    const clienteSelect = document.getElementById('cliente_id');
    const cocheSelect = document.getElementById('coche_id');

    if (!clienteSelect || !cocheSelect) return;

    function cargarCoches(clienteId) {
        cocheSelect.innerHTML = '<option value="">Cargando...</option>';
            
            // Petición de coches de usuario a la API
            // OJO: como petición es a API hay que poner delante de la ruta prefijo /api
            fetch(`/api/coches-de-cliente/${clienteId}`)
                .then(response => response.json())
                .then(data => {
                    let options = '';
                    if (data.length === 0) {
                        options = '<option value="">Este cliente no tiene coches registrados</option>';
                    } else {
                        options = '<option value="">Selecciona un coche</option>';
                        data.forEach(coche => {
                            options += `<option value="${coche.id}">${coche.marca} ${coche.modelo} - ${coche.matricula}</option>`;
                        });
                    }
                    cocheSelect.innerHTML = options;

                    // Si hay un valor anterior (por ejemplo, en edit), seleccionarlo
                    const cocheActual = cocheSelect.getAttribute('data-selected');
                    if (cocheActual) {
                        cocheSelect.value = cocheActual;
                    }
                })
                .catch(() => {
                    cocheSelect.innerHTML = '<option value="">Error al cargar coches</option>';
                });
    }

    clienteSelect.addEventListener('change', function () {
        const clienteId = this.value;
        if (clienteId) {
            cargarCoches(clienteId);
        } else {
            cocheSelect.innerHTML = '<option value="">Selecciona un coche</option>';
        }
    });

    // Si ya hay un cliente seleccionado (por ejemplo en edit), cargar sus coches
    if (clienteSelect.value) {
        cargarCoches(clienteSelect.value);
    }
});
