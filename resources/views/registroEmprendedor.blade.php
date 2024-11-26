<x-app-layout>
    <x-slot name="header">
        <div class="row">

            <div class="col">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Registro de Emprendedor') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="table-responsive-lg">
                        <form action="/emprendedor/registro" method="POST">
                            @csrf
                            <div class="text-start">
                                <p class="h3">Datos del Emprendedor</p>
                            </div>
                            <div class="row mt-3">
                                <div class="col col-lg-6">
                                    <x-input-label for="apellido">Apellido</x-input-label>
                                    <x-text-input name="apellido" placeholder="Apellido" id="apellido" required></x-text-input>
                                </div>
                                <div class="col col-lg-6">
                                    <x-input-label for="nombre">Nombre</x-input-label>
                                    <x-text-input name="nombre" placeholder="Nombre" id="nombre" required></x-text-input>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-4">
                                    <x-input-label for="telefono">Teléfono</x-input-label>
                                    <x-text-input type="number" name="telefono" placeholder="Teléfono" id="telefono" required></x-text-input>
                                </div>
                                <div class="col-4">
                                    <x-input-label for="email">Email</x-input-label>
                                    <x-text-input type="email" name="email" placeholder="Email" id="email" class="validacion" required>
                                    </x-text-input>
                                </div>
                                <div class="col-4">
                                    <x-input-label for="venc_carnet">Venc. Carnet </x-input-label>
                                    <x-text-input type="date" name="venc_carnet" id="venc_carnet" required>
                                    </x-text-input>
                                </div>
                            </div>
                            <div class="mt-5">
                                <p class="h3">Datos del Emprendimiento</p>
                            </div>
                            <div class="row mt-3">
                                <div class="col col-lg-6">
                                    <x-input-label for="nombre_emprendimiento">Nombre del emprendimiento</x-input-label>
                                    <x-text-input name="nombre_emprendimiento" placeholder="Nombre del Emprendimiento"
                                        id="nombre_emprendimiento" required>
                                    </x-text-input>
                                </div>
                                <div class="col col-lg-6">
                                    <x-input-label for="habilitacion">Habilitación</x-input-label>
                                    <x-text-input type="date" name="habilitacion" placeholder="Habilitación" id="habilitacion" required>
                                    </x-text-input>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-success">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="activo" id="activo" value="0">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
    <script src="{{ asset('/js/emprendedor/events.js') }}"></script>
    <script src="{{ asset('/js/emprendedor/functions.js') }}"></script>
    @endsection
</x-app-layout>