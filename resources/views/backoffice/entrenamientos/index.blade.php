@extends('backoffice._partials.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-1">{{ $datos['mantenedor']['titulo'] }}</h4>
        <p class="mb-6">
            {{ $datos['mantenedor']['instruccion'] }}
        </p>
        @include('backoffice._partials.messages')
        <!-- Role cards -->
        <div class="row g-6">
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="fw-normal mb-0 text-body">Total 4 users</h6>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Vinnie Mostowy" class="avatar pull-up">
                                    <img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Allen Rieske" class="avatar pull-up">
                                    <img class="rounded-circle" src="../../assets/img/avatars/12.png" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Julee Rossignol" class="avatar pull-up">
                                    <img class="rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Kaith D'souza" class="avatar pull-up">
                                    <img class="rounded-circle" src="../../assets/img/avatars/3.png" alt="Avatar" />
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h5 class="mb-1">Administrator</h5>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                                    class="role-edit-modal"><span>Edit Role</span></a>
                            </div>
                            <a href="javascript:void(0);"><i class="icon-base ti tabler-copy icon-md text-heading"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="row h-100">
                        <div class="col-sm-5">
                            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-4">
                                <img src="../../assets/img/illustrations/add-new-roles.png" class="img-fluid" alt="Image"
                                    width="83" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                    class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">
                                    Add New Role
                                </button>
                                <p class="mb-0">
                                    Add new role, <br />
                                    if it doesn't exist.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <!-- Role Table -->
                <div class="card">
                    <div class="card-datatable">
                        @component('backoffice._partials.table', [
                            'lista' => $lista,
                            'datos' => $datos,
                        ])
                        @endcomponent
                    </div>
                </div>
                <!--/ Role Table -->
            </div>
        </div>
        <!--/ Role cards -->

        <!-- Add Role Modal -->
        @component('backoffice._partials.modal', [
            'titulo' => $datos['mantenedor']['titulo'],
            'instruccion' => $datos['mantenedor']['instruccion'],
            'accion' => 'new',
            'ruta' => $datos['mantenedor']['routes']['new'],
            'campos' => $datos['mantenedor']['fields'],
        ])
        @endcomponent
        <!--/ Add Role Modal -->
    </div>
@endsection