const URI           = window.location.origin;
const company       = "/api/empresas/";
const categories    = "/api/categorias/";
const users         = "/api/usuarios/";

const getAll = () => {
    const companyId = document.getElementById('companyId').value;
    if (companyId != "") {
        const id    = parseInt(companyId);
        const URL   = URI + categories + "getAll/" + id;
        fetch(URL)
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    const result = data.result;
                    document.getElementById('getCategories').innerHTML = `
                        <div class="row">
                            ${result.map(e => `
                                <div class="col-lg-4 pt-4">
                                    <div class="card card-body text-center"
                                        style="border: 1px solid gray; border-radius: 15px">
                                        <h5>${e.name}</h5>
                                        <hr>
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-info"
                                                        data-mdb-toggle="modal" data-mdb-target="#categoryEdit"
                                                        onclick="edit(${e.category_id})">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="deletes(${e.category_id})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    `;
                } else {
                    document.getElementById('getCategories').innerHTML = `
                        <div class="text-center pt-4">
                            <h5>No tiene categorías asignadas</h5>
                        </div>
                    `;
                }
            });
    } else {
        document.getElementById('getCategories').innerHTML = `
            <div class="text-center pt-4">
                <h5>Seleccione una empresa</h5>
            </div>
        `;
    }
}

const getCompany = () => {
    const URL = URI + company + "getAll";
    fetch(URL)
        .then(response => response.json())
        .then(data => {
            const result = data.result;
            document.getElementById('getCompany').innerHTML = `
                <select class="form-control" id="companyId" onchange="getAll()">
                    <option value="0">Seleccionar</option>
                    ${result.map(e => `
                        <option value="${e.company_id}">${e.name}</option>
                    `).join('')}
                </select>
                `;
            getAll();
        });
}

const create = () => {
    const name      = document.getElementById('name').value;
    const companyId = document.getElementById('companyId').value;

    if (name === "" || companyId === "") {
        toastr.info('Complete los campos por favor');
    } else {
        const URL   = URI + categories + "create";
        const json  = { name, company_id: companyId }
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
                toastr.success('Nueva categoría agregado');
                document.getElementById('name').value = "";
                getAll();
            } else {
                toastr.info(response.message);
            }
        });
    }
}

const deletes = (categoryId) => {
    const URL = URI + categories + "delete/" + categoryId;
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
            toastr.success('Categoría eliminada');
            getAll();
        } else {
            toastr.error(response.message);
        }
    });
}

const edit = (categoryId) => {
    const URL       = URI + categories + "get/" + categoryId;
    const select    = document.getElementById('companyId');
    const value     = select.options[select.selectedIndex];
    const innerHTML = value.innerHTML;
    fetch(URL)
        .then(response => response.json())
        .then(data => {
            console.log(data.result);
            if (data.status) {
                document.getElementById('categoryId').value     = data.result[0].category_id;
                document.getElementById('nameEdit').value       = data.result[0].name;
                document.getElementById('companyEdit').value    = innerHTML;
            }
        });
}

const update = () => {
    const categoryId    = document.getElementById('categoryId').value;
    const name          = document.getElementById('nameEdit').value;
    const companyId     = parseInt(document.getElementById('companyId').value);
    console.log(companyId);

    if (name === "") {
        toastr.info('Complete los campos por favor');
    } else {
        const URL   = URI + categories + "update/" + categoryId;
        const json  = { name, company_id : companyId };
        fetch(URL, {
            method: 'PUT',
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
                toastr.success('Categoría actualizada');
                document.getElementById('nameEdit').value       = "";
                document.getElementById('companyEdit').value    = "";
                document.getElementById('closeModal').click();
                getAll();
            } else {
                toastr.info(response.message);
            }
        });
    }
}

const cleanEdit = () => {
    document.getElementById('nameEdit').value       = "";
    document.getElementById('companyEdit').value    = "";
}

getCompany();