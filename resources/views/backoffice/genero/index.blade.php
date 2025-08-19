@extends('backoffice._partials.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="mb-1">{{ $datos['mantenedor']['titulo'] }}</h4>
    <p class="mb-6">{{ $datos['mantenedor']['instruccion'] }}</p>

    @include('backoffice._partials.messages')

    <!-- Botón para agregar género -->
    <div class="d-flex justify-content-start mb-3">
        <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
            class="btn btn-primary">
            + Agregar Género
        </button>
    </div>

    <!-- Tabla de Géneros -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Icono</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($lista->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">Sin Registros</td>
                        </tr>
                    @else
                        @foreach ($lista as $item)
                            <tr>
                                <td class="text-center">{{ $item->id }}</td>
                                <td class="text-center">{{ $item->icono }}</td>
                                <td class="text-center">{{ $item->nombre }}</td>
                                <td class="text-center">
                                    @if ($item->activo == 1)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-danger">Desactivado</span>
                                    @endif
                                </td>
                                <td class="text-center">
    @if ($item->activo == 1)
        <!-- Botón desactivar -->
        <form action="{{ route($datos['mantenedor']['routes']['down'], $item->id) }}" 
              method="POST" class="d-inline-block">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger"
                onclick="this.disabled=true; this.innerHTML='<i class=\'ti ti-loader spin\'></i>'; this.form.submit();">
                <i class="icon-base ti tabler-arrow-down"></i>
            </button>
        </form>
    @else
        <!-- Botón activar -->
        <form action="{{ route($datos['mantenedor']['routes']['up'], $item->id) }}" 
              method="POST" class="d-inline-block">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary"
                onclick="this.disabled=true; this.innerHTML='<i class=\'ti ti-loader spin\'></i>'; this.form.submit();">
                <i class="icon-base ti tabler-arrow-up"></i>
            </button>
        </form>
    @endif

    <!-- Botón eliminar -->
    <form action="{{ route($datos['mantenedor']['routes']['delete'], $item->id) }}" 
          method="POST" class="d-inline-block"
          onsubmit="return confirm('¿Está seguro de eliminar este género?')">
        @csrf
        <button type="submit" class="btn btn-sm btn-danger">
            Eliminar
        </button>
    </form>
</td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Tabla de Géneros -->

    <!-- Modal para agregar género -->
    @component('backoffice._partials.modal', [
        'titulo' => $datos['mantenedor']['titulo'],
        'instruccion' => $datos['mantenedor']['instruccion'],
        'accion' => 'new',
        'ruta' => $datos['mantenedor']['routes']['new'],
        'campos' => $datos['mantenedor']['fields'],
    ])
    @endcomponent
</div>
@endsection

@push('scripts')
<script>
    const rutaCrear = "{{ route('backoffice.genero.store') }}";

    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.btn-edit-genero');
        const form = document.getElementById('form-detalles');
        const methodContainer = document.getElementById('method-edit');
        const submitBtn = document.getElementById('btn-submit-detalle');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                form.querySelector('[name="icono"]').value = this.dataset.icono;
                form.querySelector('[name="nombre"]').value = this.dataset.nombre;

                form.action = `/backoffice/genero/${this.dataset.id}`;
                methodContainer.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                submitBtn.textContent = 'Actualizar';
            });
        });

        document.querySelector('[data-bs-target="#addRoleModal"]').addEventListener('click', function () {
            form.reset();
            form.action = rutaCrear;
            methodContainer.innerHTML = '';
            submitBtn.textContent = 'Guardar';
        });
    });
</script>
@endpush
