<x-app-layout>
    @section('css')
    <link rel="stylesheet" href="/datatable/datatables.min.css">
    @endsection
    <style>
        <style>.file-drop-area {
            position: relative !important;
            display: flex !important;
            align-items: center !important;
            padding: 25px !important;
            border: 2px dashed cadetblue !important;
            border-radius: 3px !important;
            transition: 0.2s !important;
        }

        .choose-file-button {
            flex-shrink: 0 !important;
            background-color: bisque;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 3px !important;
            padding: 8px 15px !important;
            margin-right: 10px !important;
            font-size: 12px !important;
            text-transform: uppercase !important;
        }

        .file-message {
            font-size: small !important;
            font-weight: 300 !important;
            line-height: 1.4 !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }

        .file-input {
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            height: 100% !important;
            width: 100% !important;
            cursor: pointer !important;
            opacity: 0 !important;
        }
    </style>
    
    <x-slot name="header">
        <div class="row">

            <div class="col">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Exportar/Importar Emprendedores') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <div class="container mt-4">
                        <form action="{{route('importar_partida')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group col-12">
                                <div class="file-drop-area card mt-2 ml-2 mr-2">
                                    <span class="choose-file-button btn btn-warning">Seleccionar archivo</span>
                                    <span class="file-message mt-2">o arrastrar archivo aquí</span>
                                    <div id="file_loaded" class="file-message"></div>
                                    <input type="file" name='partida_importar' id="partida_importar" class="file-input"
                                        placeholder="Seleccione el archivo" required>
                                </div>
                            </div>
                            <div class="form-group col-12 text-right">

                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
    <script src="{{ asset('/js/emprendedor/events.js') }}" defer></script>
    <script src="{{ asset('/js/emprendedor/functions.js') }}"></script>
    @endsection
</x-app-layout>