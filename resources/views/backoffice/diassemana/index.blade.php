@extends('backoffice._partials.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="mb-1">Días de la Semana</h4>
    <p class="mb-6">Gestión de días (Lunes a Domingo).</p>

    @include('backoffice._partials.messages')

    {{-- Acceso rápido para abrir el modal --}}
<div class="card mb-6">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>Nuevo día</span>
    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addRoleModal">
      Agregar día
    </button>
  </div>
  <div class="card-body">
    <p class="mb-0">Usa el botón “Agregar día” para abrir el formulario.</p>
  </div>
</div>


{{-- Tabla reutilizable (mismo parcial que usan Roles/Cargos) --}}
    <div class="col-12">
      <div class="card">
        <div class="card-datatable">
          @component('backoffice._partials.table', [
              'lista' => $lista,
              'datos' => $datos,
          ])
          @endcomponent
        </div>
      </div>
    </div>
  </div>

  {{-- Modal reutilizable (usa $datos['mantenedor']['fields']) --}}
  @component('backoffice._partials.modal', [
      'titulo'      => $datos['mantenedor']['titulo'],
      'instruccion' => $datos['mantenedor']['instruccion'],
      'accion'      => 'new',
      'ruta'        => $datos['mantenedor']['routes']['new'],
      'campos'      => $datos['mantenedor']['fields'],
  ])
  @endcomponent
</div>
@endsection
