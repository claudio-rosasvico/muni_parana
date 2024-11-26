<x-app-layout>
    @section('css')
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    @endsection
    <x-slot name="header">
        <div class="row">

            <div class="col">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Ver Capacitación') }}
                </h2>
            </div>
            <div class="col text-end">
                <a href="{{ route('capacitacion.index') }}" type="submit" class="btn btn-primary">
                    Volver a la Tabla
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="card  mb-3">
                        <div class="card-header text-bg-dark">{{ $capacitacion->nombre }}</div>
                        <div class="card-body">
                            <input type="hidden" name="idCapacitacion" id="idCapacitacion" value="{{ $capacitacion->id }}">
                            <h5 class="card-title"><strong>Lugar:</strong> {{ $capacitacion->ubicacion }}</h5>
                            <h5 class="card-title"><strong>Capacitador:</strong> {{ $capacitacion->docente }}</h5>
                            <h5 class="card-title"><strong>Día:</strong> {{ $capacitacion->fecha }} /
                                <strong>Hora:</strong> {{ $capacitacion->hora }}
                            </h5>
                            @if($capacitacion->observaciones)
                            <h5 class="card-title"><strong>Observaciones:</strong> {{ $capacitacion->observaciones }}
                            </h5>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Asistentes
                    </h2>
                    <div class="input-group mb-3">
                        <select type="text" id="emprendedor" class="form-control select-emprendedor"
                            placeholder="Buscar emprendedor" aria-label="Recipient's username"
                            aria-describedby="button-addon2">
                            <option value="null"> - Seleccione Emprendedor - </option>
                            @foreach ($emprendedores as $emprendedor)
                            <option value="{{ $emprendedor->id }}">{{ $emprendedor->nombre }}
                                {{ $emprendedor->apellido }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="sumarEmprendedor">Asistió</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table" id="tabla_emprendedores">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre y Apellido</th>
                                    <th scope="col">Emprendimiento</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @section('js')
    <script src="/datatable/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script src="{{ asset('/js/capacitacion/events.js') }}"></script>
    <script src="{{ asset('/js/capacitacion/function.js') }}"></script>
    @endsection
</x-app-layout>