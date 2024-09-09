const verificaProducto = (idProducto, productos) => { 
    let verifica = false;
    productos.forEach(producto => {
        producto == idProducto && (verifica = true);
    });
    console.log(verifica)
    return verifica;
}

const tablaEmprendedores = (response) => {
    // ACA GUARDO LOS EMPRENDIMIENTOS EN BASE A SU ID
    const emprendimientos = {};
    response.emprendimientos.forEach(elem => {
        emprendimientos[elem.emprendedor_id] = elem;
    });
    
    $('#tabla_emprendedores tbody').empty();

    response.emprendedores.forEach(emprendedor => {
        let count = 1
        let emprendimiento = emprendimientos[emprendedor.id];
        let fechaActual = new Date()
        let fechaVencCarnet = new Date(emprendedor.venc_carnet)
        let difFecha = (fechaVencCarnet - fechaActual) / (1000 * 60 * 60 * 24) 
        let fila = `
            <tr class="">
                        <td scope="row">${count}</td>
                        <td>${emprendedor.nombre} ${emprendedor.apellido}</td>
                        
                        <td>${emprendimiento.nombre}</td>
                        <td>${emprendimiento.habilitacion ? emprendimiento.habilitacion : 'Sin Habilitación'}
                        </td>
                        <td>
                            ${ (difFecha < 10) ? `<p class="badge text-bg-danger">${emprendedor.venc_carnet}</p>` : (
                            (difFecha < 30) ? `<p class="badge text-bg-warning">${emprendedor.venc_carnet}</p>` : `<p class="badge text-bg-success">${emprendedor.venc_carnet}</p>`)}
                        </td>
                        <td>
                            <a href="/emprendedor/${emprendedor.id}"><i
                                    class="fa-solid fa-magnifying-glass me-2"></i></a>
                            <a href="/emprendedor/${emprendedor.id}/edit"><i
                                    class="fa-regular fa-pen-to-square me-2"></i></a>
                            <a class="eliminar_emprendedor" data-id="${emprendedor.id}"><i class="fa-regular fa-trash-can"></i></button></a>
                        </td>
                    </tr>
        `;
        $('#tabla_emprendedores tbody').append(fila);
    })
}