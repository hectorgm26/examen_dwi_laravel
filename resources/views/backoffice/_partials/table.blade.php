<table class="datatables-users table border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            {{-- Directiva para mostrar la columna Ubicación condicionalmente --}}
            @if (isset($datos['mantenedor']['has_ubicacion']) && $datos['mantenedor']['has_ubicacion'])
                <th>Ubicación</th>
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
                    <td class="text-center">{{ $item->nombre }}</td>
                    {{-- Directiva para mostrar la celda Ubicación condicionalmente --}}
                    @if (isset($datos['mantenedor']['has_ubicacion']) && $datos['mantenedor']['has_ubicacion'])
                        <td class="text-center">{{ $item->ubicacion }}</td>
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
                            <form action="{{ route($datos['mantenedor']['routes']['down'], $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger"><i
                                        class="icon-base ti tabler-arrow-down"></i></button>
                            </form>
                        @endif
                        @if ($item->activo == 0)
                            <form action="{{ route($datos['mantenedor']['routes']['up'], $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary"><i
                                        class="icon-base ti tabler-arrow-up"></i></button>
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
