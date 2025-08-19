@props(['campeonatos', 'datos'])

<table class="datatables-users table border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Ubicación</th>
            <th>Comuna</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($campeonatos as $campeonato)
            <tr>
                <td class="text-center">{{ $campeonato->id }}</td>
                <td class="text-center">{{ $campeonato->nombre ?? 'N/A' }}</td>
                <td class="text-center">{{ $campeonato->descripcion ?? 'N/A' }}</td>
                <td class="text-center">
                    {{ $campeonato->fecha_inicio ? \Carbon\Carbon::parse($campeonato->fecha_inicio)->format('Y-m-d') : 'N/A' }}
                </td>
                <td class="text-center">
                    {{ $campeonato->fecha_fin ? \Carbon\Carbon::parse($campeonato->fecha_fin)->format('Y-m-d') : 'N/A' }}
                </td>
                <td class="text-center">{{ $campeonato->ubicacion ?? 'N/A' }}</td>
                <td class="text-center">{{ $campeonato->comuna ?? 'N/A' }}</td>
                <td class="text-center">
                @if ($campeonato->activo == 1)
                            <span class="text-success">Activo</span>
                        @else
                            <span class="text-danger">Desactivado</span>
                        @endif
                    </td>
                <td class="text-center">
                    ver
                    actualizar                     
                    @if ($item->activo == 1)
                            <form action="{{ route($datos['mantenedor']['routes']['down'], $item->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
                                    <i class="icon-base ti tabler-arrow-down"></i>
                                </button>
                            </form>
                        @endif
                        @if ($item->activo == 0)
                            <form action="{{ route($datos['mantenedor']['routes']['up'], $item->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
                                    <i class="icon-base ti tabler-arrow-up"></i>
                                </button>
                            </form>
                        @endif
                    @if (isset($datos['mantenedor']['routes']['destroy']))
                    {{-- <form action="{{ route($datos['mantenedor']['routes']['destroy'], $campeonato->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger"><i
                                    class="icon-base ti tabler-trash"></i></button>
                        </form> --}}
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Sin Registros</td>
            </tr>
        @endforelse
    </tbody>
</table>