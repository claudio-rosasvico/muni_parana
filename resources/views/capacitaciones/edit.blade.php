<x-app-layout>
    <x-slot name="header">
        <div class="row">

            <div class="col">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Editar Capacitación') }}
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
                    <div class="table-responsive-lg">
                        <form action="{{ route('capacitacion.update', $capacitacion->id) }} " method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mt-3">
                                <div class="col">
                                    <x-input-label for="nombre">Nombre</x-input-label>
                                    <x-text-input name="nombre" placeholder="Nombre" id="nombre" class="validacion" value="{{ $capacitacion->nombre }}" required>
                                    </x-text-input>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col col-lg-4">
                                    <x-input-label for="ubicacion">Lugar</x-input-label>
                                    <x-text-input name="ubicacion" placeholder="Lugar"
                                        id="ubicacion" value="{{ $capacitacion->ubicacion }}" required></x-text-input>
                                </div>
                                <div class="col col-lg-4">
                                    <x-input-label for="docente">Docente</x-input-label>
                                    <x-text-input name="docente" placeholder="Docente" id="docente" value="{{ $capacitacion->docente }}" required></x-text-input>
                                </div>
                                <div class="col col-lg-2">
                                    <x-input-label for="fecha">Fecha</x-input-label>
                                    <x-text-input type="date" name="fecha" placeholder="Fecha" id="fecha" value="{{ $capacitacion->fecha }}" required></x-text-input>
                                </div>
                                <div class="col col-lg-2">
                                    <x-input-label for="hora">Hora</x-input-label>
                                    <x-text-input type="time" name="hora" placeholder="Hora" id="hora" value="{{ $capacitacion->hora }}" required></x-text-input>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <x-input-label for="observaciones">Observaciones</x-input-label>
                                    <x-text-input name="observaciones" placeholder="Observaciones" id="observaciones" class="validacion" value="{{ isset($capacitacion->observacion) ? $capacitacion->observacion : '' }}" >
                                    </x-text-input>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-success">
                                        Actualizar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')
    {{-- <script src="{{ asset('/js/emprendedor/events.js') }}"></script>
    <script src="{{ asset('/js/emprendedor/functions.js') }}"></script> --}}
    @endsection
</x-app-layout>