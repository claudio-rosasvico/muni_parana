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
                    {{ __('Tabla de Capacitaciones') }}
                </h2>
            </div>
            <div class="col text-end">
                <a href="{{ route('capacitacion.create') }}" class="btn btn-primary">
                    Crear Capacitacion
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
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Lugar</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Docente</th>
                                    <th scope="col">Inscriptos</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($count = 1)
                                @if($capacitaciones->count() > 0)

                                @foreach ($capacitaciones as $capacitacion)
                                <tr class="">
                                    <td scope="row">{{ $count }}</td>
                                    <td class="text-center">{{ $capacitacion->nombre }}</td>
                                    <td>{{ $capacitacion->ubicacion }}</td>
                                    <td>{{ date( 'd-m-Y', strtotime($capacitacion->fecha)) }}</td>
                                    <td>{{ date('H:i', strtotime($capacitacion->hora)) }}</td>
                                    <td>{{ $capacitacion->docente }}</td>
                                    <td class="text-center">{{ $capacitacion->emprendedores->count() }}</td>
                                    <td>
                                        <a href="/capacitacion/{{ $capacitacion->id }}"><i
                                                class="fa-solid fa-magnifying-glass me-2"></i></a>
                                        <a href="/capacitacion/{{ $capacitacion->id }}/edit"><i
                                                class="fa-regular fa-pen-to-square me-2"></i></a>
                                        <form action="{{ route('capacitacion.destroy', $capacitacion->id) }}" style="display: inline" method="post">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit"><i class="fa-regular fa-trash-can"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @php($count++)
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