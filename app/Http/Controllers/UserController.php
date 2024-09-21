<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){

        $users = User::all();
        $roles = Role::all();

        return view ('user.index', ['users' => $users, 'roles' => $roles]);
    }

    public function updateRole(Request $request){

        $user = User::find($request->idUser);
        $rol = $user->getRoleNames()->first();
        $user->removeRole($rol);

        $user->assignRole($request->rolUser);
        return response()->json(['user' => $user, 'rolUser' => $request->rolUser]);
    }

    public function destroy(Request $request){

        $user = User::find($request->idUser);

        $user->delete();

        return redirect('/user');
    }
}
