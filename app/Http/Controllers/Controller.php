<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use App\Models\Modulo;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('permission:gestionar-usuarios', ['only' => ['index', 'store', 'update', 'destroy']]);
    }

    public function index()
    {
        $users = User::with(['roles', 'modulos'])->get();
        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        return new UserResource($user->load(['roles', 'modulos']));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'nombre_completo' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => 'error',
                'mensaje' => 'Validación fallida',
                'errores' => $validator->errors()
            ], 422);
        }

        $user->update($request->only(['nombre_completo', 'email']));

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        return response()->json([
            'estado' => 'éxito',
            'mensaje' => 'Perfil actualizado exitosamente',
            'usuario' => new UserResource($user)
        ]);
    }

    public function getRoles()
    {
        $this->authorize('viewAny', Role::class);
        return Role::all();
    }

    public function getModulos()
    {
        return Modulo::all();
    }
}