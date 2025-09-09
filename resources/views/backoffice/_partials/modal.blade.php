<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="role-title">{{ $titulo }}</h4>
                    <p class="text-body-secondary">{{ $instruccion }}</p>
                </div>
                <hr>
                <form action="{{ route($ruta) }}" method="post">
                    @csrf
                    @foreach ($campos as $campo)
                        @switch($campo['control']['element'])
                            @case('input')
                                <div class="form-floating mb-3">
                                    <input type="{{ $campo['control']['type'] }}"
                                        class="@foreach ($campo['control']['classList'] as $class){{ $class }} @endforeach"
                                        name="{{ $campo['name'] }}" placeholder="{{ $campo['control']['placeholder'] }}"
                                        minlength="{{ $campo['control']['min'] }}" maxlength="{{ $campo['control']['max'] }}">
                                    <label for="floatingInput">{{ $campo['label'] }}</label>
                                </div>
                            @break

                            @case('select')
                                <label class="form-label">{{ $campo['label'] }}</label>
                                <select name="{{ $campo['name'] }}@if ($campo['control']['type'] == 'multiple')[]@endif"
                                    class="@foreach ($campo['control']['classList'] as $class){{ $class }} @endforeach"
                                    @if ($campo['control']['type'] == 'multiple') multiple @endif>
                                    @foreach ($campo['control']['options'] as $opciones)
                                        @php
                                            try {
                                                @endphp
                                                <option value="{{ $opciones['id'] }}">{{ $opciones['nombre'] }}</option>
                                                @php
                                            } catch (\Throwable $th) {
                                                echo '<option>Error :( en option</option>';
                                            }
                                        @endphp
                                    @endforeach
                                </select>
                                {{-- @php
                                    $isMultiple =
                                        isset($campo['control']['multiple']) && $campo['control']['multiple'] === true;
                                    $selectName = $campo['name'] . ($isMultiple ? '[]' : '');
                                @endphp
                                <label class="form-label">{{ $campo['label'] }}</label>
                                <select name="{{ $selectName }}"
                                    class="form-select @foreach ($campo['control']['classList'] as $class){{ $class }} @endforeach"
                                    {{ $isMultiple ? 'multiple' : '' }}
                                    @if (isset($campo['control']['attributes'])) @foreach ($campo['control']['attributes'] as $attrKey => $attrVal)
                                            {{ $attrKey }}="{{ $attrVal }}"
                                        @endforeach @endif>
                                    @foreach ($campo['control']['options'] as $option)
                                        @php
                                            $optionValue = $option['value'] ?? null;
                                            $optionLabel = $option['label'] ?? 'Sin nombre';
                                            $isSelected = false;

                                            if (isset($campo['value']) && $optionValue !== null) {
                                                if (
                                                    is_array($campo['value']) &&
                                                    in_array($optionValue, $campo['value'])
                                                ) {
                                                    $isSelected = true;
                                                } elseif ($campo['value'] == $optionValue) {
                                                    $isSelected = true;
                                                }
                                            }
                                        @endphp

                                        @if ($optionValue !== null)
                                            <option value="{{ $optionValue }}" {{ $isSelected ? 'selected' : '' }}>
                                                {{ $optionLabel }}
                                            </option>
                                        @endif
                                    @endforeach

                                </select>
                                --}}
                            @break

                            @default
                        @endswitch
                    @endforeach
                    <hr>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
