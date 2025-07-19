<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Modulo;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Limpiar tablas pivotantes primero
        DB::table('modulo_user')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        Permission::query()->delete();
        Role::query()->delete();
        Modulo::query()->delete();
        User::query()->delete();

        // Crear módulos
        $modulos = [
            ['codigo' => 'SISTEMA', 'nombre' => 'Sistema', 'descripcion' => 'Módulo de administración del sistema'],
            ['codigo' => 'ASES.CONTAB.', 'nombre' => 'Asesoría Contable', 'descripcion' => 'Módulo de asesoría contable'],
            ['codigo' => 'TESORERIA', 'nombre' => 'Tesorería', 'descripcion' => 'Módulo de tesorería']
        ];

        $modulosCreados = [];
        foreach ($modulos as $modulo) {
            $modulosCreados[] = Modulo::create($modulo);
        }

        // Crear roles
        $adminRole = Role::create(['name' => 'administrador']);
        $supervisorRole = Role::create(['name' => 'supervisor']);
        $usuarioRole = Role::create(['name' => 'usuario']);

        // Permisos básicos
        $permisos = [
            'ver-dashboard',
            'gestionar-usuarios',
            'gestionar-roles',
            'gestionar-modulos',
            'acceso-sistema',
            'acceso-asesoría-contable',
            'acceso-tesorería',
            'editar-perfil',
            'ver-reportes'
        ];

        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }

        // Asignar todos los permisos al administrador
        $adminRole->givePermissionTo(Permission::all());

        // Permisos para supervisor
        $supervisorRole->givePermissionTo([
            'ver-dashboard',
            'gestionar-usuarios',
            'editar-perfil',
            'ver-reportes'
        ]);

        // Permisos para usuario
        $usuarioRole->givePermissionTo([
            'ver-dashboard',
            'editar-perfil'
        ]);

        // Crear usuario administrador
        $admin = User::create([
            'username' => 'ADMINISTRADOR',
            'nombre_completo' => 'ADMINISTRADOR DEL SISTEMA',
            'email' => 'jefatura.montevideo@minterior.gub.uy',
            'password' => Hash::make('12345678'),
            'activo' => true
        ]);

        $admin->assignRole('administrador');

        // Asignar módulos al administrador
        foreach ($modulosCreados as $modulo) {
            $admin->modulos()->attach($modulo->id);
        }

        // Crear usuario de ejemplo para cada rol
        $this->crearUsuarioEjemplo('SUPERVISOR1', 'Supervisor Contable', 'supervisor.contable@ejemplo.gub.uy', 'supervisor', ['ASES.CONTAB.']);
        $this->crearUsuarioEjemplo('USUARIO1', 'Usuario Tesorería', 'usuario.tesorería@ejemplo.gub.uy', 'usuario', ['TESORERIA']);
    }

    protected function crearUsuarioEjemplo($username, $nombre, $email, $rol, $modulos)
    {
        $user = User::create([
            'username' => $username,
            'nombre_completo' => $nombre,
            'email' => $email,
            'password' => Hash::make('Password123!'),
            'activo' => true
        ]);

        $user->assignRole($rol);

        foreach ($modulos as $codigoModulo) {
            $modulo = Modulo::where('codigo', $codigoModulo)->first();
            if ($modulo) {
                $user->modulos()->attach($modulo->id);
            }
        }
    }
}