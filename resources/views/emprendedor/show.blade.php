<x-app-layout>
    <x-slot name="header">
        <div class="row">

            <div class="col">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Ver Emprendedor') }}
                </h2>
            </div>
            <div class="col text-end">
                <a href="{{ route('emprendedor.index') }}" type="submit" class="btn btn-primary">
                    Volver a la Tabla
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 row">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col me-2">
                <div class="p-6 text-gray-900 col">
                    <div class="card">
                        <div class="card-header text-bg-secondary">Datos Personales</div>
                        <div class="card-body">
                            <h4 class="card-title">Nombre</h4>
                            <p class="card-text">{{ $emprendedor->nombre }} {{ $emprendedor->apellido }}</p>
                            <hr>
                            <h4 class="card-title mt-3">Teléfono</h4>
                            <p class="card-text">{{ $emprendedor->telefono }}</p>
                            <hr>
                            <h4 class="card-title mt-3">Email</h4>
                            <p class="card-text">{{ $emprendedor->email }}</p>
                            <hr>
                            <h4 class="card-title mt-3">Venc. Carnet</h4>
                            <p class="card-text">{{ date( 'd-m-Y', strtotime($emprendedor->venc_carnet)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            @foreach ($emprendedor->emprendimiento as $emprendimiento)
                
            @endforeach
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col ms-2">
                <div class="p-6 text-gray-900 col">
                    <div class="card">
                        <div class="card-header text-bg-secondary">Datos del Emprendimiento</div>
                        <div class="card-body">
                            <h4 class="card-title">Nombre</h4>
                            <p class="card-text">{{ $emprendimiento->nombre }}</p>
                            <hr>
                            <h4 class="card-title mt-3">Productos</h4>
                            @foreach ($emprendimiento->productos as $producto)
                            <p class="card-text" style="display: inline">{{ $producto->producto->nombre }} - </p>
                            @endforeach
                            <hr>
                            <h4 class="card-title mt-3">Habilitación</h4>
                            <p class="card-text">{{ date( 'd-m-Y', strtotime($emprendimiento->habilitacion)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>