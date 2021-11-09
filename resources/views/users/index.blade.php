@extends('layouts.index')

@section('title')
<div class="container pt-4">
    <div class="pt-4"></div>
    <div class="row">
        <div class="col-lg-8">
            <h3>Mis Usuarios</h3>
        </div>
        <div class="col-lg-4" style="text-align: right;">
            <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#create">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
</div>
<hr>
@endsection

@section('content')
<div class="container">
    <div class="row">

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Empresas</label>
                        <div id="getCompany"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Categorías</label>
                        <div id="getCategories"></div>
                    </div>
                </div>
                <div class="col-lg-4 pt-4">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-block" onclick="search()">
                            <i class="fa fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div id="getUsers"></div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"
                    onclick="cleanEdit()"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="companyId">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="nameEdit" class="form-control" id="name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Apellidos</label>
                            <input type="text" name="nameEdit" class="form-control" id="lastname">
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Correo</label>
                            <input type="text" name="description" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Género</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Empresas</label>
                            <div id="getCompanyNew"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Categorías</label>
                            <div id="getCategoriesNew"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal" id="closeModal"
                    onclick="cleanEdit()">
                    Cerrar
                </button>
                <button type="button" class="btn btn-primary" onclick="create()">Guardar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="users.js"></script>
@endsection