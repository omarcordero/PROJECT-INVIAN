@extends('layouts.index')

@section('title')
    <div class="container pt-4">
        <div class="pt-4"></div>
        <h3>Mis Categorías</h3>
    </div>
    <hr>
@endsection

@section('content')
<div class="container pt-4">
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Empresa</label>
                                <div id="getCompany"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group pt-4">
                                <button type="button" class="btn btn-primary btn-block" onclick="create()">
                                    <i class="fa fa-save"></i>
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 pt-4">
            <div id="getCategories"></div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="categoryEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Empresa</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close" onclick="cleanEdit()"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="categoryId">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="nameEdit" class="form-control" id="nameEdit">
                </div>
                <div class="form-group">
                    <label for="">Empresa</label>
                    <input type="text" name="companyEdit" class="form-control" id="companyEdit" disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal" id="closeModal" onclick="cleanEdit()">
                    Cerrar
                </button>
                <button type="button" class="btn btn-primary" onclick="update()">Editar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="categories.js"></script>
@endsection