<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
class ServicioController extends Controller
{
    public function index(){
        $servicios = Servicio::paginate(6);
        return view('RTL', compact('servicios'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
        ]);

        Servicio::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'id_tipo_serv' => 1,
        ]);

        return redirect()->route('RTL')->with('success', 'Servicio registrado exitosamente');
    }

    public function getServicio($id)
    {
        $servicio = Servicio::findOrFail($id);
        return response()->json($servicio);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'id_tipo_serv' => 'required|exists:tipo_servicio,id',
        ]);

        $servicio = Servicio::findOrFail($id);
        $servicio->update($request->all());

        return redirect()->route('RTL')->with('success', 'Servicio actualizado exitosamente');
    }

    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->delete();

        return redirect()->route('RTL')->with('success', 'Servicio eliminado exitosamente');
    }
}