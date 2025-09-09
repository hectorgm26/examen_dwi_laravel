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
                            <h6 class="fw-normal mb-0 text-body">Total {{ count($campeonatos) }} campeonatos</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h5 class="mb-1">Campeonatos</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="row h-100">
                        <div class="col-sm-5">
                            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-4">
                                <img src="{{ asset('assets/img/illustrations/add-new-roles.png') }}" class="img-fluid" alt="Image"
                                    width="83" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                    class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">
                                    Añadir nuevo campeonato
                                </button>
                                <p class="mb-0">
                                    Añadir nuevo campeonato, <br />
                                    si no existe.
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
                    @component('backoffice._partials.table_campeonatos', [
                            'campeonatos' => $campeonatos,
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
            'ruta' => 'backoffice.campeonato.store', 
            'campos' => $datos['mantenedor']['fields'],
        ])
        @endcomponent
        <!--/ Add Role Modal -->

        <!-- Ver Equipos Modal -->
        <div class="modal fade" id="verEquiposModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Equipos del Campeonato</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul id="listaEquipos" class="list-group">
                            <!-- Los equipos se cargarán aquí dinámicamente -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Ver Equipos Modal -->
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var verEquiposModal = document.getElementById('verEquiposModal');
        verEquiposModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var campeonatoJson = button.getAttribute('data-campeonato');
            var campeonato = JSON.parse(campeonatoJson);
            var listaEquipos = document.getElementById('listaEquipos');
            listaEquipos.innerHTML = '';

            if (campeonato.equipos && campeonato.equipos.length > 0) {
                campeonato.equipos.forEach(function (equipo) {
                    var li = document.createElement('li');
                    li.className = 'list-group-item';
                    li.textContent = equipo;
                    listaEquipos.appendChild(li);
                });
            } else {
                var li = document.createElement('li');
                li.className = 'list-group-item';
                li.textContent = 'No hay equipos registrados para este campeonato.';
                listaEquipos.appendChild(li);
            }
        });
    });
</script>
@endpush
