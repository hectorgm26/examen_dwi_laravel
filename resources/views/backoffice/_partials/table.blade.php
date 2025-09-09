<table class="datatables-users table border-top">
    <thead>
        <tr>
            <th>ID</th>
            @if ($datos['mantenedor']['fields'][0]['label'] == 'Abreviatura')
                <th>Abreviatura</th>
            @endif
            <th>Nombre</th>
            {{-- Directiva para mostrar la columna Ubicación condicionalmente --}}
            @if (isset($datos['mantenedor']['has_ubicacion']) && $datos['mantenedor']['has_ubicacion'])
                <th>Ubicación</th>
            @endif

            @if (isset($datos['mantenedor']['has_entrenador']) && $datos['mantenedor']['has_entrenador'])
                <th>Entrenador</th>
            @endif

            @if (isset($datos['mantenedor']['has_jugador']) && $datos['mantenedor']['has_jugador'])
                <th>Jugador</th>
            @endif

            @if (isset($datos['mantenedor']['has_hora_inicio']) && $datos['mantenedor']['has_hora_inicio'])
                <th>Hora Inicio</th>
            @endif

            @if (isset($datos['mantenedor']['has_hora_fin']) && $datos['mantenedor']['has_hora_fin'])
                <th>Hora Fin</th>
            @endif
            
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if (count($lista) == 0)
            <tr>
                <td colspan="4" class="text-center">Sin Registros</td>
            </tr>
        @else
            @foreach ($lista as $item)
                <tr>
                    <td class="text-center">{{ $item->id }}</td>
                    @if ($item->abreviatura)
                        <td class="text-center">{{ $item->abreviatura }}</td>
                    @endif
                    <td class="text-center">{{ $item->nombre }}</td>
                    {{-- Directiva para mostrar la celda Ubicación condicionalmente --}}
                    @if (isset($datos['mantenedor']['has_ubicacion']) && $datos['mantenedor']['has_ubicacion'])
                        <td class="text-center">{{ $item->ubicacion }}</td>
                    @endif
                    {{-- Mstrar la celda Entrenador --}}
                    @if (isset($datos['mantenedor']['has_entrenador']) && $datos['mantenedor']['has_entrenador'])
                        <td class="text-center">{{ $item->entrenador }}</td>
                    @endif
                    {{-- Mostrar la celda Jugador --}}
                    @if (isset($datos['mantenedor']['has_jugador']) && $datos['mantenedor']['has_jugador'])
                        <td class="text-center">{{ $item->jugador }}</td>
                    @endif
                    {{-- Mostrar la celda Hora Inicio/Fin --}}
                    @if (isset($datos['mantenedor']['has_hora_inicio']) && $datos['mantenedor']['has_hora_inicio'])
                        <td class="text-center">{{ $item->hora_inicio }}</td>
                    @endif
                    @if (isset($datos['mantenedor']['has_hora_fin']) && $datos['mantenedor']['has_hora_fin'])
                        <td class="text-center">{{ $item->hora_fin }}</td>
                    @endif
                    <td class="text-center">
                        @if ($item->activo == 1)
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
                        {{-- <form action="{{ route($datos['mantenedor']['routes']['destroy'], $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger"><i
                                    class="icon-base ti tabler-trash"></i></button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
