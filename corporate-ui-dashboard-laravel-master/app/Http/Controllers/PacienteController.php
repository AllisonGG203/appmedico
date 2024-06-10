<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Expediente;

class PacienteController extends Controller
{
    public function index(){
        $pacientes = Paciente::paginate(6);
        $expedientes = Expediente::all();

        return view('tables', compact('pacientes', 'expedientes'));
    }

    public function storeOrUpdate(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'sexo' => 'required|string|in:M,F',
            'telefono' => 'required|string|max:15',
        ]);

        if ($request->paciente_id) {
            // Si hay un ID de paciente, actualizar el paciente existente
            $paciente = Paciente::findOrFail($request->paciente_id);
            $paciente->update([
                'nombre' => $request->nombre,
                'edad' => $request->edad,
                'sexo' => $request->sexo,
                'telefono' => $request->telefono,
            ]);

            return redirect()->route('tables')->with('success', 'Paciente actualizado exitosamente');
        } else {
            // Si no hay ID de paciente, crear uno nuevo
            $paciente = Paciente::create([
                'nombre' => $request->nombre,
                'edad' => $request->edad,
                'sexo' => $request->sexo,
                'telefono' => $request->telefono,
            ]);

            Expediente::create([
                'id_paciente' => $paciente->id,
                'fecha_reg' => now(),
                'fecha_act' => now()
            ]);

            return redirect()->route('tables')->with('success', 'Paciente registrado exitosamente');
        }
    }

    public function destroy($id)
    {
        $paciente = Paciente::where('id', $id)->firstOrFail();
        $expediente = Expediente::where('id_paciente', $id)->firstOrFail();
        $expediente->delete();
        $paciente->delete();

        return redirect()->route('tables')->with('success', 'Paciente eliminado exitosamente');
    }

    public function edit($id)
    {
        // Obtener los datos del paciente a editar y pasar a la vista
        $paciente = Paciente::findOrFail($id);
        return view('edit', compact('paciente'));
    }
}

