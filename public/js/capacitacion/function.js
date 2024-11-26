const tablaEmprendedores = (response) => {

    $('#tabla_emprendedores tbody').empty();

    let count = 1
    response.emprendedores.forEach(emprendedor => {
        let emprendimiento = emprendedor.emprendimiento[0];
        let fila = `
            <tr class="">
                        <td scope="row">${count}</td>
                        <td>${emprendedor.nombre} ${emprendedor.apellido}</td>
                        <td>${emprendimiento.nombre}</td>
                        <td>
                            <a class="eliminar_emprendedor" data-id="${emprendedor.id}"><i class="fa-regular fa-trash-can"></i></button></a>
                        </td>
                    </tr>
        `;
        $('#tabla_emprendedores tbody').append(fila);
        count++
    }) 
}