<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenido/a') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @hasanyrole('administrador|editor')
                <div class="p-6 text-gray-900 text-center">
                    {{ __("Bienvenido al Sistema de Gestión de Emprendedores de la Subsecretaría de Producción") }}
                </div>
                @endhasanyrole
                @role('visitante')
                <div class="p-6 text-gray-900 text-center">
                    {{ __("No tiene lo permisos correspondientes. Comuniquese con el Administrador") }}
                </div>
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>
