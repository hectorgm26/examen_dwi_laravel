<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>País de Origen</th>
            <th>Nacionalidad</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($nacionalidades as $nacionalidad)
            <tr>
                <td>{{ $nacionalidad->id }}</td>
                <td>{{ $nacionalidad->pais_origen }}</td> 
                <td>{{ $nacionalidad->nacionalidad_nombre }}</td> 
                <td class="text-center">
                        @if ($nacionalidad->activo == 1)
                            <span class="text-success">Activo</span>
                        @else
                            <span class="text-danger">Desactivado</span>
                        @endif
                    </td>
                    <td class="text-center">
{{--                         ver
                        actualizar --}}
                        @if ($nacionalidad->activo == 1)
                            <form action="{{ route($datos['mantenedor']['routes']['down'], $nacionalidad->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"><i
                                        class="icon-base ti tabler-arrow-down"></i></button>
                            </form>
                        @endif
                        @if ($nacionalidad->activo == 0)
                            <form action="{{ route($datos['mantenedor']['routes']['up'], $nacionalidad->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary"><i
                                        class="icon-base ti tabler-arrow-up btn-sm"></i></button>
                            </form>
                        @endif
                        {{-- <form action="{{ route($datos['mantenedor']['routes']['destroy'], $nacionalidad->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger"><i
                                    class="icon-base ti tabler-trash"></i></button>
                        </form> --}}
                    </td>
                </tr>
        @endforeach
    </tbody>
</table>
