<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cliente::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email|unique:clientes',
            'telefono' => 'required',
            'direccion' => 'required',
        ]);

        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->correo = $request->correo;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->save();
        return $cliente;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
    
        if (!$cliente) {
            return response()->json([
                'message' => 'no se pudo realizar correctamente la operacion.'
            ], 404);
        }
    
        // Validar los datos. Si la validación falla, automáticamente se devuelve un error 422 y un mensaje de error.
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email|unique:clientes',
            'telefono' => 'required',
            'direccion' => 'required',
        ]);
    
        // Actualizar el cliente con los nuevos datos.
        $cliente->nombre = $request->nombre;
        $cliente->correo = $request->correo;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->update(); // Puedes usar save() en lugar de update() si prefieres.
    
        return $cliente;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json([
                'message' => 'no se pudo realizar correctamente la operacion'
            ], 404);
        }

        $cliente->delete();
        return response()->noContent();
    }
}
