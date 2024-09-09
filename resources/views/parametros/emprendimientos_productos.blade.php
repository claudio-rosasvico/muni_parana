<x-app-layout>
    <x-slot name="header">
        <div class="row">

            <div class="col">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Emprendedores que hacen {{ $producto->nombre }}
                </h2>
            </div>
            <div class="col text-end">
                <a href="/parametros/productos" class="btn btn-primary">
                    Volver a tabla de Producos
                </a>
            </div>
        </div>
    </x-slot>
    @inject('carbon', 'Carbon\Carbon')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <div class="table-responsive-lg">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Nombre del F.T.</th>
                                    <th scope="col">Habilitación</th>
                                    <th scope="col">Vencimiento Carnet</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($count = 1)
                                @if($emprendimientos->count() > 0)
                                
                                @foreach ($emprendimientos as $emprendimiento)
                                @if ($emprendimiento->emprendimiento->count() > 0)
                                <tr class="">
                                    <td scope="row">{{ $count }}</td>
                                    <td>{{ $emprendimiento->emprendimiento->emprendedor->nombre }} {{ $emprendimiento->emprendimiento->emprendedor->apellido }}</td>
                                    
                                    <td>{{ $emprendimiento->emprendimiento->emprendedor->emprendimiento->first()->nombre }}</td>
                                    <td>{{ isset($emprendimiento->emprendimiento->habilitacion)? (date( 'd-m-Y', strtotime($emprendimiento->emprendimiento->habilitacion))) : 'Sin Habilitación' }}
                                    </td>
                                    <td>
                                        @php($diasRestantes = $carbon::now()->diffInDays($emprendimiento->emprendimiento->emprendedor->venc_carnet, false))
                                        @if($diasRestantes < 10)
                                        <p class="badge text-bg-danger">{{ date( 'd-m-Y', strtotime($emprendimiento->emprendimiento->emprendedor->venc_carnet)) }}</p>
                                        @elseif(($diasRestantes < 30))
                                        <p class="badge text-bg-warning">{{ date( 'd-m-Y', strtotime($emprendimiento->emprendimiento->emprendedor->venc_carnet)) }}</p>
                                        @else
                                        <p class="badge text-bg-success">{{ date( 'd-m-Y', strtotime($emprendimiento->emprendimiento->emprendedor->venc_carnet)) }}</p>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/emprendedor/{{ $emprendimiento->emprendimiento->emprendedor->id }}"><i
                                                class="fa-solid fa-magnifying-glass me-2"></i></a>
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
</x-app-layout>