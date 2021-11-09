const URI           = window.location.origin;
const company       = "/api/empresas/";
const categories    = "/api/categorias/";
const users         = "/api/usuarios/";

const create = () => {
    const name          = document.getElementById('name').value;
    const description   = document.getElementById('description').value;

    if (name === "" || description === "") {
        toastr.info('Complete los campos por favor');
    } else {
        const URL   = URI + company + "create";
        const json  = { name, description };
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
                toastr.success('La empresa se ha creado satisfactoriamente');
                document.getElementById('name').value           = "";
                document.getElementById('description').value    = "";
                getAll();
            } else {
                toastr.info(response.message);
            }
        });
    }
}

const getAll = () => {
    const URL = URI + company + "getAll";
    fetch(URL)
        .then(response => response.json())
        .then(data => {
            const result = data.result;
            document.getElementById('getCompany').innerHTML = `
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Empresa</th>
                                <th scope="col">Descripción</th>
                                <th scope="col" colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${result.map(e => `
                                <tr>
                                    <th scope="row">${e.company_id}</th>
                                    <td>${e.name}</td>
                                    <td>${e.description}</td>
                                    <td>
                                        <a href="javascript:void(0);" data-mdb-toggle="modal" data-mdb-target="#companyEdit" onclick="edit(${e.company_id})">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="deletes(${e.company_id})">
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
}

const deletes = (companyId) => {
    const URL = URI + company + "delete/" + companyId;
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
            toastr.success('La empresa se ha eliminado');
            getAll();
        } else {
            toastr.error(response.message);
        }
    });
}

const edit = (companyId) => {
    const URL = URI + company + "get/" + companyId;
    fetch(URL)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                document.getElementById('companyId').value          = data.result.company_id;
                document.getElementById('nameEdit').value           = data.result.name;
                document.getElementById('descriptionEdit').value    = data.result.description;
            }
        });
}

const update = () => {
    const companyId     = document.getElementById('companyId').value;
    const name          = document.getElementById('nameEdit').value;
    const description   = document.getElementById('descriptionEdit').value;

    if (name === "" || description === "") {
        toastr.info('Complete los campos por favor');
    } else {
        const URL   = URI + company + "update/" + companyId;
        const json  = { name, description };
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
                toastr.success('La empresa se actualizó satisfactoriamente');
                document.getElementById('nameEdit').value           = "";
                document.getElementById('descriptionEdit').value    = "";
                document.getElementById('closeModal').click();
                getAll();
            } else {
                toastr.info(response.message);
            }
        });
    }
}

const cleanEdit = () => {
    document.getElementById('nameEdit').value           = "";
    document.getElementById('descriptionEdit').value    = "";
}

getAll();