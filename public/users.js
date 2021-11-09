const URI           = window.location.origin;
const company       = "/api/empresas/";
const categories    = "/api/categorias/";
const users         = "/api/usuarios/";

const getAllCompany = () => {
    const URL = URI + company + "getAll";
    fetch(URL)
        .then(response => response.json())
        .then(data => {
            const result = data.result;
            document.getElementById('getCompany').innerHTML = `
                <select class="form-control" id="companyId" onclick="getAllCategories()">
                    <option value="0">Seleccionar</option>
                    ${result.map(e => `
                        <option value="${e.company_id}">${e.name}</option>
                    `).join('')}
                </select>
                `;
        });
}

const getAllCompanyCreate = () => {
    const URL = URI + company + "getAll";
    fetch(URL)
        .then(response => response.json())
        .then(data => {
            const result = data.result;
            document.getElementById('getCompanyNew').innerHTML = `
                <select class="form-control" id="companyIdNew" onclick="getAllCategoriesCreate()">
                    <option value="0">Seleccionar</option>
                    ${result.map(e => `
                        <option value="${e.company_id}">${e.name}</option>
                    `).join('')}
                </select>
                `;
        });
}

const getAllCategories = () => {
    const companyId = document.getElementById('companyId').value;
    if (companyId != "") {
        const id    = parseInt(companyId);
        if (id != 0) {
            const URL = URI + categories + "getAll/" + id;
            fetch(URL)
                .then(response => response.json())
                .then(data => {
                    const result = data.result;
                    document.getElementById('getCategories').innerHTML = `
                        <select class="form-control" id="categoryId">
                            <option value="0">Seleccionar</option>
                            ${result.map(e => `
                                <option value="${e.category_id}">${e.name}</option>
                            `).join('')}
                        </select>
                        `;
                });
        } else {
            document.getElementById('getCategories').innerHTML = `
                <select class="form-control" id="categoryId">
                    <option value="0">Seleccionar</option>
                </select>
                `;
        }
    } else {
        document.getElementById('getCategories').innerHTML = `
            <select class="form-control" id="categoryId">
                <option value="0">Seleccionar</option>
            </select>
            `;
    }
}

const getAllCategoriesCreate = () => {
    const company = document.getElementById('companyIdNew');
    if (company) {
        const companyId = document.getElementById('companyIdNew').value;
        if (companyId != "") {
            const id    = parseInt(companyId);
            if (id != 0) {
                const URL = URI + categories + "getAll/" + id;
                fetch(URL)
                    .then(response => response.json())
                    .then(data => {
                        const result = data.result;
                        document.getElementById('getCategoriesNew').innerHTML = `
                            <select class="form-control" id="categoryIdNew">
                                <option value="0">Seleccionar</option>
                                ${result.map(e => `
                                    <option value="${e.category_id}">${e.name}</option>
                                `).join('')}
                            </select>
                            `;
                    });
            } else {
                document.getElementById('getCategoriesNew').innerHTML = `
                    <select class="form-control" id="categoryIdNew">
                        <option value="0">Seleccionar</option>
                    </select>
                    `;
            }
        } else {
            document.getElementById('getCategoriesNew').innerHTML = `
                <select class="form-control" id="categoryIdNew">
                    <option value="0">Seleccionar</option>
                </select>
                `;
        }
    } else {
        document.getElementById('getCategoriesNew').innerHTML = `
            <select class="form-control" id="categoryIdNew">
                <option value="0">Seleccionar</option>
            </select>
            `;
    }
}

const search = () => {
    const companyId     = document.getElementById('companyId').value;
    const categoriesId  = document.getElementById('categoryId').value;

    if (companyId != "" || categoriesId != "") {
        const company_id    = parseInt(companyId);
        const categories_id = parseInt(categoriesId);
        if (company_id != 0 && categories_id != 0) {
            const URL = URI + users + "getAll/" + categories_id;
            fetch(URL)
                .then(response => response.json())
                .then(data => {
                    const result = data.result;
                    document.getElementById('getUsers').innerHTML = `
                        <div class="table-responsive pt-4">
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Usuarios</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col" colspan="1">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${result.map(e => `
                                        <tr>
                                            <th scope="row" class="">
                                                ${ e.gender === "M" ? `
                                                <img src="https://www.kindpng.com/picc/m/78-786207_user-avatar-png-user-avatar-icon-png-transparent.png" width="40px" style="border-radius: 50%">` : `
                                                <img src="https://www.pngkit.com/png/full/115-1150342_user-avatar-icon-iconos-de-mujeres-a-color.png" width="40px" style="border-radius: 50%">` }
                                            </th>
                                            <td>${e.name} ${e.lastname}</td>
                                            <td><span class="badge bg-success">${e.email}</span></td>
                                            <td>
                                                <a href="javascript:void(0);" onclick="deletes(${e.user_id})">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                        `;
                });
        } else {
            toastr.info('Complete los campos por favor');
        }
    } else {
        toastr.info('Complete los campos por favor');
    }

}

const create = () => {
    const name          = document.getElementById('name').value;
    const lastname      = document.getElementById('lastname').value;
    const email         = document.getElementById('email').value;
    const gender        = document.getElementById('gender').value;
    const categoryId    = document.getElementById('categoryIdNew').value;

    if (name === "" || lastname === "" || email === "" || gender === "" || categoryId === "") {
        toastr.info('Complete los campos por favor');
    } else {
        const URL   = URI + users + "create";
        const json  = { name, lastname, email, gender, categoryId };
        fetch(URL, {
            method: 'POST',
            body: JSON.stringify(json),
            headers:{
              'Content-Type': 'application/json'
            }
        }).then(res => res.json())
        .catch(error => {
            toastr.error(error);
        })
        .then(response => {
            if (response.status) {
                toastr.success('Nueva usuario agregado');
                document.getElementById('name').value           = "";
                document.getElementById('lastname').value       = "";
                document.getElementById('email').value          = "";
                document.getElementById('gender').value         = "";
                search();
            } else {
                toastr.info(response.message);
            }
        });
    }
}

const deletes = (userId) => {
    const URL = URI + users + "delete/" + userId;
    fetch(URL, {
        method: 'DELETE',
        headers:{
          'Content-Type': 'application/json'
        }
    }).then(response => response.json())
    .catch(error => {
        toastr.error(error);
    })
    .then(response => {
        if (response.status) {
            toastr.success('Usuario eliminado');
            search();
        } else {
            toastr.error(response.message);
        }
    });
}

getAllCompany();
getAllCategories();

getAllCompanyCreate();
getAllCategoriesCreate();