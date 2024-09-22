<x-app-layout>
    <x-slot name="header">
        <div class="row">

            <div class="col">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tabla de Usuarios') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <div class="table-responsive-lg">
                        <table class="table table-striped" id="usuarios">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Mail</th>
                                    <th scope="col">Tipo de Usuario</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($count = 1)
                                @if($users->count() > 0)
                                @foreach ($users as $user)
                                <tr class="">
                                    <td scope="row">{{ $count }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }} </td>
                                    <td>
                                        <div class="mb-3">
                                            <select class=" rounded" name="role" id="role" data-id="{{ $user->id }}" {{ ($user->id == auth()->user()->id) ? 'disabled' : '' }}> 
                                                @php($roleUser = $user->getRoleNames()->first())
                                                @foreach ($roles as $role)
                                                <option
                                                    value="{{ $role->name }}" {{ ($roleUser == $role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($user->id != auth()->user()->id)
                                        <form action="/user/destroy" method="POST">
                                            @csrf
                                            <input type="hidden" name="idUser" value="{{ $user->id }}">
                                            <button type="submit" class="eliminar_user" data-id="{{ $user->id }}"><i
                                                    class="fa-regular fa-trash-can"></i></button>
                                        </form>
                                        @endif
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
    <script src="{{ asset('/js/user/events.js') }}"></script>
    @endsection
</x-app-layout>