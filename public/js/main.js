const API_URL = 'http://127.0.0.1:8000/api'; // puerto por defecto que usa laravel cuando se ejecuta php artisan serve

var table = document.getElementById('workersTable');
const paginationContainer = document.getElementById('paginator');
const perPage = 5;
let currentPage = 1;
let originalRows = Array.from(table.querySelectorAll('tbody tr'));

function displayPage(table, itemPerPage, currentPage) {
    const rows = table.querySelectorAll('tbody tr');
    const totalRows = rows.length;
    const startIndex = (currentPage - 1) * itemPerPage;
    const endIndex = Math.min(startIndex + itemPerPage, totalRows);

    for (let i = 0; i < totalRows; i++) {
        rows[i].style.display = 'none';
    }

    for (let i = startIndex; i < endIndex; i++) {
        rows[i].style.display = 'table-row';
    }
}

function generatePagination(table, itemPerPage, currentPage, paginationContainer) {
    const rows = table.querySelectorAll('tbody tr');
    const totalRows = rows.length;
    const totalPages = Math.ceil(totalRows / itemPerPage);
    let paginationHTML = '';
    paginationHTML += `<ul class="pagination">`;

    if (totalPages >= 1) {
        const disabled = (currentPage != 1) ? '' : 'disabled';
        paginationHTML += `<li class="page-item "><a class="page-link ${disabled}" onclick="goToPage(${currentPage - 1})">Anterior</a></li>`;
    }

    for (let i = 1; i <= totalPages; i++) {
        paginationHTML += ` <li class="page-item"><a class="page-link ${i === currentPage ? 'active' : ''}"  onclick="goToPage(${i})">${i}</a></li>`;
    }

    if (totalPages >= 1) {
        const disabled = (currentPage != totalPages) ? '' : 'disabled';
        paginationHTML += `<li class="page-item"><a class="page-link ${disabled}" onclick="goToPage(${currentPage + 1})">Siguiente</a></li>`;
    }

    paginationHTML += `</ul>`;
    paginationContainer.innerHTML = paginationHTML;
}

function goToPage(page) {
    effectLoadingScreen();
    currentPage = page;
    displayPage(table, perPage, currentPage);
    generatePagination(table, perPage, currentPage, paginationContainer);
}

function resetTable() {
    while (table.rows.length > 1) {
        table.deleteRow(1);
    }
    originalRows.forEach((row) => {
        table.tBodies[0].appendChild(row);
    });

    currentPage = 1;
    generatePagination(table, perPage, currentPage, paginationContainer);
}

function filterContent(input, idFilter) {
    const text = document.getElementById(input).value;
    const filter = document.getElementById(idFilter).value;

    resetTable();

    if (filter != null && filter != -1 && text != '') {
        effectLoadingScreen();
        const rows = Array.from(table.querySelectorAll('tbody tr'));
        const filteredRows = rows.filter((row) => {

            let shouldDisplay = false;
            for (let j = 0; j < row.cells.length; j++) {
                const element = row.cells[j].innerHTML;

                if (j != 5 && j != 6) {
                    if (filter === 'nombre' && j == 0 && element.toLowerCase().includes(text.toLowerCase()) === true) {
                        shouldDisplay = true;
                    } else if (filter === 'email' && j == 1 && element.toLowerCase().includes(text.toLowerCase()) === true) {
                        shouldDisplay = true;
                    } else if (filter === 'sexo' && j == 2 && element.toLowerCase().includes(text.toLowerCase()) === true) {
                        shouldDisplay = true;
                    } else if (filter === 'boletin' && j == 4 && element.toLowerCase().includes(text.toLowerCase()) === true) {
                        shouldDisplay = true;
                    } else if (filter === 'area' && j == 3 && element.toLowerCase().includes(text.toLowerCase()) === true) {
                        shouldDisplay = true;
                    }
                }

                if (shouldDisplay) {
                    break;
                }
            }

            return shouldDisplay;
        });

        if (filteredRows.length > 0) {
            while (table.rows.length > 1) {
                table.deleteRow(1);
            }

            filteredRows.forEach((row) => {
                row.style.display = 'table-row';
                table.tBodies[0].appendChild(row);
            });
        } else {
            resetTable();
        }
        currentPage = 1;
        generatePagination(table, perPage, currentPage, paginationContainer);
    } else {
        resetTable();
    }
}

function showLoading() {
    document.getElementById('loading').style.display = 'flex';
}

function hideLoading() {
    document.getElementById('loading').style.display = 'none';
}

function effectLoadingScreen() {
    showLoading();
    setTimeout(() => {
        hideLoading();
    }, 500);
}

function openModal(option, obj = null) {

    if (option == 'modify') {
        document.getElementById("modalTitle").innerHTML = 'Modificar Empleado';
        document.getElementById("inputName").value = obj.nombre;
        document.getElementById("inputEmail").value = obj.email;

        if (genreM.value == obj.sexo) {
            document.getElementById("genreM").checked = true;
        } else {
            document.getElementById("genreF").checked = true;
        }
        document.getElementById("selectArea").value = obj.foreign_area.id;
        document.getElementById("inputDescription").value = obj.descripcion;

        if (obj.boletin == 1) {
            document.getElementById("sw_boletin").checked = true;
        } else {
            document.getElementById("sw_boletin").checked = false;

        }
        const totalRoles = document.querySelectorAll(".roles").length;

        for (let i = 0; i < totalRoles; i++) {
            const element = document.getElementById("rol_" + i);
            element.checked = false;
            for (let j = 0; j < obj.roles.length; j++) {
                const rol_id = obj.roles[j].rol_id;
                if (element.value == rol_id) {
                    element.checked = true;
                }
            }
        }

    } else {
        document.getElementById("modalTitle").innerHTML = 'Crear Empleado';
        document.getElementById("inputName").value = '';
        document.getElementById("inputEmail").value = '';
        document.getElementById("genreM").checked = false;
        document.getElementById("genreF").checked = false;
        document.getElementById("selectArea").value = '';
        document.getElementById("inputDescription").value = '';
        document.getElementById("sw_boletin").checked = false;
        const totalRoles = document.querySelectorAll(".roles").length;

        for (let i = 0; i < totalRoles; i++) {
            const element = document.getElementById("rol_" + i);
            element.checked = false;
        }
    }

    const existingButton = document.getElementById('btnSaveMWorker');
    const newButton = existingButton.cloneNode(true);
    newButton.addEventListener('click', function () {
        processData(option, obj);
    });

    existingButton.parentNode.replaceChild(newButton, existingButton);

}

async function fillAreaSelect() {
    const response = await fetch(`${API_URL}/showAreas`, {
        method: 'GET',
    });

    const dataResponse = await response.json();
    if (dataResponse.status === 200) {
        const data = dataResponse.data;

        let html = `<option value="-1">Seleccione</option>`;
        for (let i = 0; i < data.length; i++) {
            const element = data[i];
            html += `<option value="${element.id}">${element.nombre}</option>`;
        }
        document.getElementById("selectArea").innerHTML = html;
    }
}

async function showRoles() {
    const response = await fetch(`${API_URL}/showRoles`, {
        method: 'GET',
    });

    const dataResponse = await response.json();
    // console.log(dataResponse);
    if (dataResponse.status === 200) {
        const data = dataResponse.data;
        let html = '';
        for (let i = 0; i < data.length; i++) {
            const element = data[i];
            html += `
            <div class=" form-check">
                <input class="form-check-input roles" type="checkbox" value="${element.id}" id="rol_${i}">
                <label class="form-check-label fw-bold" for="roles[]">${element.nombre}</label>
            </div>`;
        }
        document.getElementById("roles").innerHTML = html;
    }
}



const validateEmail = (email) => {
    const emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
    const isValidEmail = emailRegex.test(email);
    if (!isValidEmail)
        return false;
    return true;
};

const validateText = (text) => {
    if (!text)
        return false;
    return true;
};

async function processData(option, obj) {

    effectLoadingScreen();
    const name = document.getElementById("inputName");
    let email = document.getElementById("inputEmail");
    const genreM = document.getElementById("genreM");
    const genreF = document.getElementById("genreF");
    const selectedArea = document.getElementById("selectArea");
    const description = document.getElementById("inputDescription");
    let boletin = document.getElementById("sw_boletin");
    let roles = [];
    const totalRoles = document.querySelectorAll(".roles").length;

    const formData = new FormData();

    for (let i = 0; i < totalRoles; i++) {
        const element = document.getElementById("rol_" + i);
        if (element.checked == true) {
            roles.push(element.value);
            formData.append('roles_id[]', element.value);

        }
    }

    let message = '';
    if (roles.length == 0) {
        message = 'Por favor seleccione minimo un Rol';
    }

    if (description.value == '' || description.value == null) {
        message = 'Por favor ingrese una Descripción';
        description.focus();
    }

    if (boletin.checked == true) {
        boletin = 1;
    } else {
        boletin = 0;
    }

    if (selectedArea.value == -1 || selectedArea == '') {
        message = 'Por favor seleccione un Área';
        selectedArea.focus();
    }

    if (genreM.checked == false && genreF.checked == false) {
        message = 'Por favor seleccione un genero';
    }

    if (validateEmail(email.value) == false) {
        message = 'Por favor ingrese un email valido';
        email.focus();
    }

    if (validateText(name.value) == false || name.value.length < 3) {
        message = 'Por favor ingrese un nombre valido de minimo 3 caracteres';
        name.focus();
    }

    if (message != '') {
        alertify.error(message);
        return;
    }

    const genre = (genreM.checked) ? genreM.value : genreF.value;
    formData.append('nombre', name.value);
    formData.append('email', email.value);
    formData.append('sexo', genre);
    formData.append('area_id', selectedArea.value);
    formData.append('boletin', boletin);
    formData.append('descripcion', description.value);

    if (option == 'modify') {

        alertify.confirm("Modificar Registro", "¿Estas seguro de Modificar este registro?",
            async function () {

                const id = obj.id;
                const response = await fetch(`${API_URL}/updateWorker/` + id + `?_method=PUT`, {
                    method: 'POST',
                    body: formData
                });

                if (response.status === 200) {
                    effectLoadingScreen();
                    alertify.success("Registro modificado exitosamente");
                    showTable();
                } else {
                    alertify.error("Ha ocurrido un error durante la modificación del registro");
                }

                document.getElementById("CloseModal").click();
            },
            function () {
                document.getElementById("CloseModal").click();
            });

    } else if (option == 'create') {

        alertify.confirm("Crear Nuevo registro", "¿Estas seguro de crear un nuevo registro?",
            async function () {

            const response = await fetch(`${API_URL}/createWorker`, {
                method: 'POST',
                body: formData
            });

                if (response.status === 200) {
                    effectLoadingScreen();
                    alertify.success("Registro guardado exitosamente");
                    showTable();
                } else {
                    alertify.error("Ha ocurrido un Error durante el guardado del registro");
                }

                document.getElementById("CloseModal").click();

            },
            function () {
                document.getElementById("CloseModal").click();
            });
    }
}

async function showTable(){
    const response = await fetch(`${API_URL}/showWorkers`, {
        method: 'GET',
    });

    const dataResponse = await response.json();
    if (dataResponse.status === 200) {
        const data = dataResponse.data;
        let html = '';
        for (let i = 0; i < data.length; i++) {
            const element = data[i];
            html += ` <tr id="${element.id}">
            <th class="text-center" scope="row">${element.nombre}</th>
            <td class="text-center">${element.email}</td>
            <td class="text-center">${element.sexo}</td>
            <td class="text-center">${element.foreign_area.nombre}</td>
            <td class="text-center">${((element.boletin == 1)? 'Si' : 'No') }</td>
            <td class="fs-5 text-center" scope="col" title="Modificar" >
                <i data-bs-toggle="modal" onclick='openModal("modify", ${JSON.stringify(element)})' data-bs-target="#createModal" class="bi bi-pencil-square cursor-pointer"></i>&nbsp;&nbsp;</td>
            <td class="fs-5 text-center" scope="col" title="Eliminar"><i class="bi bi-trash-fill cursor-pointer"
                 onclick="deleteRecord(${element.id})"></i>&nbsp;&nbsp;</td>
        </tr>`;

        }
        document.getElementById("workersRows").innerHTML = html;
        table = document.getElementById('workersTable');
        originalRows = Array.from(table.querySelectorAll('tbody tr'));
        currentPage = 1;
        displayPage(table, perPage, currentPage);
        generatePagination(table, perPage, currentPage, paginationContainer);
    }
}

function deleteRecord(id){

    effectLoadingScreen();
    alertify.confirm("Eliminar Registro", "¿Estas seguro de eliminar este Registro?",
    async function () {

    const response = await fetch(`${API_URL}/deleteWorker/${id}`, {
        method: 'PUT',
    });

        if (response.status === 200) {
            effectLoadingScreen();
            alertify.success("Registro Eliminado Exitosamente");
            showTable();
        } else {
            alertify.error("Ha ocurrido un Error durante la eliminación del registro");
        }

        document.getElementById("CloseModal").click();
    },
    function () {
        document.getElementById("CloseModal").click();
    });
}

displayPage(table, perPage, currentPage);
generatePagination(table, perPage, currentPage, paginationContainer);
effectLoadingScreen();
fillAreaSelect();
showRoles();
