<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;

class MedicoController extends Controller
{
    public function index(){
        $medicos = Medico::paginate(6);

        return view('wallet', compact('medicos'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:medico',
            'telefono' => 'required|string|max:15|unique:medico',
            'profesion' => 'required|string|max:255',
            'tipo_profesion' => 'required|string|max:255',
        ]);

        Medico::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'profesion' => $request->profesion,
            'tipo_profesion' => $request->tipo_profesion,
        ]);

        return redirect()->route('wallet')->with('success', 'Medico registrado exitosamente');
    }

    public function getMedico($id)
    {
        $medico = Medico::findOrFail($id);
        return response()->json($medico);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:medico,correo,' . $id,
            'telefono' => 'required|string|max:15|unique:medico,telefono,' . $id,
            'profesion' => 'required|string|max:255',
            'tipo_profesion' => 'required|string|max:255',
        ]);

        $medico = Medico::findOrFail($id);
        $medico->update($request->all());

        return redirect()->route('wallet')->with('success', 'Medico actualizado exitosamente');
    }

    public function destroy($id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();

        return redirect()->route('wallet')->with('success', 'Medico eliminado exitosamente');
    }
}