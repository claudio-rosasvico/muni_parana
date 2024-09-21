<x-app-layout>
    <x-slot name="header">
        <div class="row">

            <div class="col">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Productos') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="">
                            <h3><strong>Crear Producto</strong></h3>
                        </div>
                        <form class="form-control mt-2" action="/parametros/productos/store" method="post">
                            <div class="row">
                                @csrf
                                <div class="col-12 col-lg-5">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Nombre</label>
                                        <input type="text" class="form-control rounded" name="nombre" id="nombre"
                                            aria-describedby="helpId" placeholder="" style="border-color: #B2BABB"/>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Observación</label>
                                        <input type="text" class="form-control rounded" name="observaciones" id="observaciones"
                                            aria-describedby="helpId" placeholder="" style="border-color: #B2BABB"/>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2 align-content-center text-center mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <div class="container">
                        <div class="table-responsive">
                            <table class="table" id="tabla-productos">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Observación</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($count = 1)
                                    @foreach ($productos as $producto)
                                    <tr>
                                        <th scope="row">{{ $count }}</th>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>{{ $producto->observaciones }}</td>
                                        <td>
                                            <a href="/parametros/emprendimientoByProducto/{{ $producto->id }}">
                                                {{ $producto->emprendimientos->count() }}</td>
                                            </a>
                                        <td>
                                            <a class="deleteProducto" data-id="{{ $producto->id }}">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php($count++)
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @section('js')
    <script src="{{ asset('/js/producto/events.js') }}"></script>
    @endsection
</x-app-layout>