<?php

namespace App\Http\Controllers;


use App\Contracts\PermissionRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userCreateController extends Controller
{

    public function index(PermissionRepositoryInterface $permissionRepo)
    {
        $permissions = $permissionRepo->getAllPermission();
        return view('users.create', ['permissions' => $permissions]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {
        // Obtener los permisos seleccionados como un array
        $permisosSeleccionados = $request->input('permisos', []);
        $correo = $request->email;

        // Validar que el correo sea válido
        if ($correo !== null) {
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                // Verificar si el correo ya está registrado
                $validar = DB::table('users')->where('email', $correo)->count();
                if ($validar == 0) {
                    // Crear el usuario
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $correo,
                        'password' => Hash::make($request->password),
                    ]);

                    // Asignar permisos seleccionados
                    if (!empty($permisosSeleccionados)) {
                        
                        foreach ($permisosSeleccionados as $permisoId) {
                            DB::table('model_has_permissions')->insert([
                                'permission_id' => $permisoId,
                                'model_type' => 'App\Models\User',
                                'model_id' => $user->id,
                            ]);
                        }
                    }

                    return back()->with('message', 'Registrado correctamente');
                } else {
                    return back()->with('error', 'Este email ya ha sido registrado');
                }
            } else {
                return back()->with('error', 'El campo correo no es una dirección de correo electrónico válida');
            }
        } else {
            return back()->with('error', 'El correo es obligatorio');
        }
    }
}
