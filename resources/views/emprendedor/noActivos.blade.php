<x-app-layout>
    @section('css')
    <link rel="stylesheet" href="/datatable/datatables.min.css">
    @endsection
    <style>
        /* Este CSS lo hago para dar estilo al input de datatable */
        #dt-search-0 {
            border-radius: 10px !important;
            padding: 5px;
        }
    </style>
    <x-slot name="header">
        <div class="row">

            <div class="col">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tabla de Emprendedores NO ACTIVOS') }}
                </h2>
            </div>
            <div class="col text-end">
                <a href="{{ route('emprendedor.index') }}" class="btn btn-primary">
                    Ver activos
                </a>
            </div>
        </div>
    </x-slot>
    
    @inject('carbon', 'Carbon\Carbon')
    <div class="mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <div class="table-responsive-lg">
                        <table class="table table-striped" id="tabla_emprendedores">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Expediente</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Nombre del F.T.</th>
                                    <th scope="col">Habilitación</th>
                                    <th scope="col">Vencimiento Carnet</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($count = 1)
                                @if($emprendedores->count() > 0)

                                @foreach ($emprendedores as $emprendedor)
                                @if ($emprendedor->emprendimiento->count() > 0)
                                <tr class="">
                                    <td scope="row">{{ $count }}</td>
                                    <td class="text-center">{{ $emprendedor->nro_expediente }}/{{ $emprendedor->anio_expediente }}</td>
                                    <td>{{ $emprendedor->nombre }} {{ $emprendedor->apellido }}</td>

                                    <td>{{ $emprendedor->emprendimiento->first()->nombre }}</td>
                                    <td>{{ isset($emprendedor->emprendimiento->first()->habilitacion)? (date( 'd-m-Y', strtotime($emprendedor->emprendimiento->first()->habilitacion))) : 'Sin Habilitación' }}
                                    </td>
                                    <td>
                                        @php($diasRestantes = $carbon::now()->diffInDays($emprendedor->venc_carnet,
                                        false))
                                        @if($diasRestantes < 10) <p class="badge text-bg-danger">
                                            {{ date( 'd-m-Y', strtotime($emprendedor->venc_carnet)) }}</p>
                                            @elseif(($diasRestantes < 30)) <p class="badge text-bg-warning">
                                                {{ date( 'd-m-Y', strtotime($emprendedor->venc_carnet)) }}</p>
                                                @else
                                                <p class="badge text-bg-success">
                                                    {{ date( 'd-m-Y', strtotime($emprendedor->venc_carnet)) }}</p>
                                                @endif
                                    </td>
                                    <td>
                                        <a href="/emprendedor/{{ $emprendedor->id }}"><i
                                                class="fa-solid fa-magnifying-glass me-2"></i></a>
                                        <a href="/emprendedor/{{ $emprendedor->id }}/edit"><i
                                                class="fa-regular fa-pen-to-square me-2"></i></a>
                                        <a class="eliminar_emprendedor" data-id="{{ $emprendedor->id }}"><i
                                                class="fa-regular fa-trash-can"></i></a>
                                    </td>
                                </tr>
                                @php($count++)
                                @endif
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @section('js')
    <script src="/datatable/datatables.min.js"></script>
    <script src="{{ asset('/js/emprendedor/events.js') }}" defer></script>
    <script src="{{ asset('/js/emprendedor/functions.js') }}"></script>
    <script>
        let table = new DataTable('#tabla_emprendedores', {
        language: {
            url: '/datatable/lang.json'
        },
        layout: {
            bottomEnd: {
                paging: {
                    firstLast: false
                }
            }
        },
        columnDefs: [{
            "className": "dt-center",
            "targets": "_all"
        }
        ]
    });
    </script>
    @endsection
</x-app-layout>