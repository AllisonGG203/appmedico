<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'nombre' => 'Alec',
            'apellido' => 'Thompson',
            'correo' => 'admin@corporateui.com',
            'password' => Hash::make('secret'),
        ]); 

        DB::table('paciente')->insert([
            'nombre' => "Juanito",
            'edad' => 23,
            'sexo' => 'H',
            'telefono' => '+528342764567'
        ]);

        DB::table('expediente')->insert([
            'id_paciente' => 1,
            'fecha_reg' => now(),
            'fecha_act' => now(),
            'seguimiento' => 'Le duele la panza :(',
            'archivos' => 'radiografia1.png'
        ]);

        DB::table('tipo_servicio')->insert([
            'tipo' => 'TipoPro',
        ]);
    }
}
