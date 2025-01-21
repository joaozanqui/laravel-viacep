<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Lista todos os endereços salvos.
     */
    public function index()
    {
        $addresses = Address::all();
        return response()->json($addresses);
    }

    /**
     * Salva um novo endereço no banco de dados.
     */
    public function store(Request $request)
    {
        // Validação simples
        $data = $request->validate([
            'cep'        => 'required',
            'logradouro' => 'nullable|string',
            'bairro'     => 'nullable|string',
            'localidade' => 'nullable|string',
            'uf'         => 'nullable|string|max:2'
        ]);

        // Cria o Address
        $address = Address::create($data);

        return response()->json($address, 201);
    }

    /**
     * Exclui um endereço do banco de dados.
     */
    public function destroy($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['error' => 'Endereço não encontrado.'], 404);
        }

        $address->delete();

        return response()->json(['message' => 'Endereço excluído com sucesso.']);
    }
}
